<?php


namespace App\Http\Controllers\Admin\Users;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }

    public function store(){
        $this->validate(request(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = request()->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole(request('roles'));

        return redirect()->route('manage.users.index')
            ->with('success','User created successfully');
    }

    public function show(User $user){
        return view('admin.users.show',compact('user'));
    }

    public function edit(User $user){
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.users.edit',compact('user','roles','userRole'));
    }

    public function update(User $user){
        $this->validate(request(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = request()->all();
        if (!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input,array('password'));
        }

        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole(request('roles'));

        return redirect()->route('manage.users.index')->with('success','User updated successfully');

    }
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('manage.users.index')->with('success','User deleted successfully');
    }

}
