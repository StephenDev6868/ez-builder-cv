<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Modules\Ezinvite\Entities\HistoryCredit;
use Modules\Ezinvite\Entities\HistoryInvite;
use Modules\User\Http\Controllers\Controller;
use Modules\User\Entities\User;
use Modules\User\Notifications\UserRegistered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    public function redirectTo(){

        $this->redirectTo = 'dashboard';

        switch (Auth::user()->role) {
            case 'user':
                $this->redirectTo = 'dashboard';
                break;
            case 'admin':
                $this->redirectTo = 'settings';
                break;
            default:
                $this->redirectTo = 'dashboard';
                break;
        }
        return $this->redirectTo;

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**alltemplates
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
        $secret = config('recaptcha.api_secret_key');
        $site_key = config('recaptcha.api_site_key');

        if ($secret && $site_key) {
            $rules['g-recaptcha-response'] = 'recaptcha';
        }
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array   $data    Data
     * @param Request $request Request
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['role'] = 'user';
        $max = User::query()->max('id');
        $user = User::create([
            'name'          => '',
            'email'         => $data['email'],
            'role'          => $data['role'],
            'password'      => Hash::make($data['password']),
            'link_invite'   => config('app.url') . '/?refcode=' . ($max + 1) . str::random(9),
            'credit'        => 100,
        ]);
        $user->notify((new UserRegistered())->onQueue('mail'));

        $parsedUrl = parse_url(URL::previous());
        if (isset($parsedUrl['query']) && strs_contain($parsedUrl['query'], 'refcode=')) {
            $refCode = str_replace('refcode=', '', $parsedUrl['query']);
            if (Cookie::has($refCode)) {
                $userR = User::query()
                    ->where('link_invite', 'like', '%' . $refCode . '%')
                    ->first();
                if (! $userR) {
                    redirect()->route('register')
                        ->with(['error' => 'User referral not found']);
                }

                $userR->credit = (int) $userR->credit + 100;
                $userR->save();

                // Update history credit of user referral
                HistoryCredit::query()
                    ->create([
                        'user_id' => $userR->getKey(),
                        'amount'  => 100,
                        'type'    => 1,
                        'status'  => 1,
                        'done_at' => now(),
                    ]);

                // Update history credit of new user
                HistoryCredit::query()
                    ->create([
                        'user_id' => $user->getKey(),
                        'amount'  => 100,
                        'type'    => 4,
                        'status'  => 1,
                        'done_at' => now(),
                    ]);

                HistoryInvite::query()
                    ->create([
                       'user_id'     => $userR->getKey(),
                       'new_user_id' => $user->getKey(),
                    ]);
            };
        }

        return $user;

    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {

        return view('themes::' . config('app.SITE_LANDING') . '.auth.register');
    }
}
