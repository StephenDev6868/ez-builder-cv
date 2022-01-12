<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;
use Modules\Ezinvite\Entities\HistoryInvite;
use Modules\User\Http\Controllers\Controller;
use Modules\User\Entities\User;
use Modules\Ezinvite\Entities\HistoryCredit;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    private $providers = [
        'facebook',
        'twitter',
        'linkedin',
        'google',
        'github',
        'gitlab',
        'bitbucket',
    ];

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('themes::' . config('app.SITE_LANDING') . '.auth.login');
    }

    /**
     * Redirect the user to the authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        if (!in_array($provider, $this->providers)) {
            return redirect()->route('login');
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        if (!in_array($provider, $this->providers)) {
            return redirect()->route('login');
        }
        try {

            $social = Socialite::driver($provider)->user();
            if(!$social->getEmail()){
                return redirect()->route('login')->with('error', __('You need update email on: ').$provider);
            }
            $user = User::where('email',$social->getEmail())->first();
            
            if(!$user){

                $max = User::query()->max('id');
                $user = User::create([
                    'name'          => '',
                    'email'         => $social->getEmail(),
                    'role'          => 'user',
                    'password'      => Hash::make(Str::random(40)),
                    'refcode'       => ($max + 1) . str::random(9),
                    'credit'        => config('app.default_credit'),
                ]);
                // Check referral
                if (Cookie::has('resumecv_invite')) {
                    $refCode = Cookie::get('resumecv_invite');
                    $userR = User::query()
                        ->where('refcode', $refCode)
                        ->first();
                    
                        if ($userR) {
                        $userR->credit = (int) $userR->credit + config('app.credit_refer');
                        $userR->save();
                        // Update history credit of user referral
                        HistoryCredit::query()
                            ->create([
                                'user_id' => $userR->getKey(),
                                'amount'  => config('app.credit_refer'),
                                'type'    => 1,
                                'status'  => 1,
                                'done_at' => now(),
                            ]);
                        HistoryInvite::query()
                            ->create([
                                'user_id'     => $userR->getKey(),
                                'new_user_id' => $user->getKey(),
                            ]);
                    }
                    
                };

                // Update history credit of new user
                HistoryCredit::query()
                    ->create([
                        'user_id' => $user->getKey(),
                        'amount'  => config('app.default_credit'),
                        'type'    => 4,
                        'status'  => 1,
                        'done_at' => now(),
                ]);
            }
            
            Auth::login($user);

            return redirect('/');

        } catch (\Exception $e) {

            return redirect()->route('login')->with('error', $e->getMessage());

        }
    }

}
