<?php
/**
 * Created by PhpStorm.
 * User: fanxin
 * Date: 2017/9/14
 * Time: 下午7:47
 */

namespace App\Admin\Controllers;

use App\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    public function index()
    {
        $users = AdminUser::paginate(2);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store()
    {
        // 验证
        $this->validate(request(), [
            'name' => 'required|min:2',
            'password' => 'required',
        ]);

        $name = request('name');
        $password = bcrypt(request('name'));

        AdminUser::create(compact('name', 'password'));
        // 渲染
        return redirect('/admin/users');
    }
}