<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard(){
//        $user = Auth::user();
//        $role = Role::find(1);
//        $permissions = Permission::pluck('id','id')->all();
//        $role->syncPermissions($permissions);
//        $user->assignRole([$role->id]);

        return view('admin.dashboard');
    }

    public function switchLanguage($lang){
//        app()->setLocale($lang);

//        return back();
    }

}
