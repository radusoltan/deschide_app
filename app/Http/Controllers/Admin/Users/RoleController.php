<?php


namespace App\Http\Controllers\Admin\Users;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);

    }

    public function index(){
        $roles = Role::all();
        return view('admin.users.role.index',compact('roles'));
    }

    public function create(){
        $permission = Permission::get();
        return view('admin.users.role.create', compact('permission'));
    }

    public function store(){
        $this->validate(request(),[
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        $role = Role::create([
            'name' => request('name')
        ]);
        $role->syncPermissions(request('permission'));

        return redirect()->route('manage.roles.index')->with('success','Role created successfully');

    }

    public function show(Role $role){
        $rolePermissions = Permission::join('role_has_permissions','role_has_permissions.permission_id','=','permissions.id')
            ->where('role_has_permissions.role_id',$role->id)
            ->get();
        return view('admin.users.role.show',compact('role','rolePermissions'));
    }
    public function edit(Role $role){
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.users.role.edit',compact('role','permission','rolePermissions'));
    }
    public function update(Role $role){

        $this->validate(request(),[
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role->name = request('name');
        $role->save();
        $role->syncPermissions(request('permission'));

        return redirect()->route('manage.roles.index')->with('success','Role updated successfully');

    }
    public function destroy(Role $role){
        $role->delete();
        return redirect()->route('manage.roles.index')->with('success','Role deleted successfully');
    }

}
