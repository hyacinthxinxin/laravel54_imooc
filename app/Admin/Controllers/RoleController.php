<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{

    public function index()
    {
        $roles = AdminRole::paginate(10);

        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);
        AdminRole::create(request(['name', 'description']));
        return redirect('/admin/roles');
    }

    public function permission(AdminRole $role)
    {
        $permissions = AdminPermission::all();
        $myPermissions = $role->permissions;

        return view('admin.role.permission', compact('permissions', 'myPermissions', 'role'));
    }

    public function storePermission(AdminRole $role)
    {
        $this->validate(request(), [
            'permissions' => 'required|array',
        ]);
        $permissions = AdminPermission::findMany(request('permissions'));
        $myPermissions = $role->permissions;
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission) {
            $role->grantPermission($permission);
        }
        $deletePermissions = $myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission) {
            $role->deletePermission($permission);
        }
        return Redirect::back();
    }

}