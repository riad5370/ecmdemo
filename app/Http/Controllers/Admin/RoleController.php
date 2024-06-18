<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleController extends Controller
{
    function role(){
        return view('admin.role.role',[
            'permissions'=>Permission::all(),
            'roles'=>Role::all(),
            'users'=>User::all()
        ]);
    }

    //permission-create
    function storePermission(Request $request){
        Permission::create([
            'name' => $request->permission_name,
            'guard_name' => 'web',
        ]);
        return back();
    }
    
    //role-as-permission
    public function storeRole(Request $request){
        $role = Role::create(['name' =>$request->role_name,'guard_name' => 'web',]);
        $role->givePermissionTo($request->permission);
        return back();
    }
    public function delete_permission($role_id){
        $role = Role::find($role_id);
        $role->syncPermissions([]);
        $role->delete();
        return back();
    }

    //user-as-role-permission
    public function assignRole(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);
        return back();
    }
    function removeRole($id){
        $user = User::find($id);
        $user->syncRoles([]);
        $user->syncPermissions([]);
        return back(); 
    }
    function user_role_permission_edit($id){
        return view('admin.role.edit-user-permission',[
            'users'=>User::find($id),
            'permissions'=>Permission::all()
        ]);
    }
    function permissionUpdate(Request $request){
        $user = User::find($request->id);
        $permissions = $request->permission;
        $user->syncPermissions($permissions);
        return back();
    }
    
}
