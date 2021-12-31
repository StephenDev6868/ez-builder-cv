<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Modules\Saas\Entities\Package;
use Modules\User\Entities\User;
use Nwidart\Modules\Facades\Module;
use Response;
class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::query();

        if ($request->filled('search')) {
            $data->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $data = $data->paginate(10);

        return view('user::users.index', compact(
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = [];
        
        if (Module::find('Saas')) {
            $packages = Package::all();
        }

        return view('user::users.create', compact(
            'packages'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'role'            => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:users',
            'password'        => 'required|string|min:6|same:password_confirmation',
            'package_ends_at' => 'nullable|date',
        ]);

        $request->request->add([
            'password' => Hash::make($request->password),
        ]);

        
        $user = User::create($request->all());

        return redirect()->route('settings.users.index')
            ->with('success', __('Created successfully'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $packages = [];
        if (Module::find('Saas')) {
            $packages = Package::all();
        }
        return view('user::users.edit', compact(
            'user',
            'packages'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'role'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'password'        => 'nullable|string|min:6|same:password_confirmation',
            'package_ends_at' => 'nullable|date',

        ]);

        if ($request->filled('password')) {
            $request->request->add([
                'password' => Hash::make($request->password),
            ]);
        } else {
            $request->request->remove('password');
        }

        
        $user->update($request->all());

        return redirect()->route('settings.users.edit', $user)
            ->with('success', __('Updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->user()->id == $user->id) {
            return redirect()->route('settings.users.index')
                ->with('error', __("You can't remove yourself."));
        }
        if ($user->resumecvs()->count() > 0) {
            return redirect()->back()->with('error',"Can't delete because it has resumecvs in it");
        }

        $user->delete();

        return redirect()->route('settings.users.index')
            ->with('success', __('Deleted successfully'));
    }

    public function accountSettings(Request $request)
    {

        $user = $request->user();
        return view('user::auth.profile', compact(
            'user'));
    }

    public function accountSettingsUpdate(Request $request)
    {

        $request->validate([
            'name'     => 'required|max:255',
            'gender'     => 'required|max:20',
            'high_school_name'     => 'required|max:190',
            'grade'     => 'required|max:50',
            'password' => 'same:password_confirmation',
        ]);

        if ($request->filled('password')) {
            $request->request->add([
                'password' => Hash::make($request->password),
            ]);
        } else {
            $request->request->remove('password');
        }

        $request->user()->update($request->all());

        return redirect()->route('accountsettings.index')
            ->with('success', __('Updated successfully'));
    }

    public function exportCsadsasv(Request $request)
    {
        $filename = 'userdata-'.strtotime("now").'.csv';
        $data = User::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'Email', 'Role', 'Gender', 'High school name', 'Grade', 'Created at');

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $item) {
                $row['Name']  = $item->name;
                $row['Email']    = $item->email;
                $row['Role']    = $item->role;
                $row['High school name']  = $item->high_school_name;
                $row['Grade']  = $item->grade;
                $row['Created at']  = $item->created_at;

                fputcsv($file, array($row['Name'],$row['Email'],$row['Role'], ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportcsv(Request $request)
    {
        $data = User::all();
       
        if (count($data) > 0) {
            $filename = 'userdata-'.strtotime("now").'.csv';
            
            $handle = fopen($filename, 'w+');
            
            $columns = ['Name', 'Email', 'Role', 'Gender', 'High_school_name', 'Grade', 'Created_at'];

            fputcsv($handle, $columns);

            foreach($data as $item) {
                $row = [];
                $row['name']  = $item->name ? $item->name : '';
                $row['email']    = $item->email ? $item->email : '';
                $row['role']    = $item->role ? $item->role : '';
                $row['gender']    = $item->gender ? $item->gender : '';
                $row['high_school_name']  = $item->high_school_name ? $item->high_school_name : '';
                $row['grade']  = $item->grade ? $item->grade : '';
                $row['created_at']  = $item->created_at->format('d-m-Y') ? $item->created_at->format('d-m-Y') : '';
                fputcsv($handle, $row);
            }
            
            fclose($handle);

            $headers = array(
                'Content-Type' => 'text/csv',
            );

            return Response::download($filename, $filename, $headers)->deleteFileAfterSend(true);

        }
        return redirect()->back()->with('error', __('Not found any data for export'));
           
    }
}
