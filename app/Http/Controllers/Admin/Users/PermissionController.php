<?php


namespace App\Http\Controllers\Admin\Users;


use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::get();
        return view('admin.users.permission.index',compact('permissions'));
    }

    public function show(Permission $permission){
        return view('admin.users.permission.show',compact('permission'));
    }

    public function create(){
        return view('admin.users.permission.create');
    }
    public function store(){

        $this->validate(request(),[
            'name' => 'required'
        ]);

        $permission = Permission::create([
            'name' => request('name')
        ]);

        return redirect()->route('manage.permissions.index')
            ->with('success','Permission created successfully');
    }
    public function edit(Permission $permission){

        return view('admin.users.permission.edit', compact('permission'));
    }
    public function update(Permission $permission){
        $this->validate(request(),[
            'name' => 'required'
        ]);
        $permission->update([
            'name' => request('name')
        ]);

        return redirect()->route('manage.permissions.index')->with('success','Permission updated sucessfully');
    }
    public function destroy(Permission $permission){
        $permission->delete();

        return redirect()->route('manage.permissions.index')->with('success','Permission delete successfully');
    }

}
