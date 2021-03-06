<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = AdminPermission::paginate(10);
        return view('admin.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permission.create');

    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);
        AdminPermission::create(request(['name', 'description']));
        return redirect('/admin/permissions');
    }
}