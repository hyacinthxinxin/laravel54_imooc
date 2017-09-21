<?php
/**
 * Created by PhpStorm.
 * User: fanxin
 * Date: 2017/9/14
 * Time: 下午11:50
 */

namespace App\Admin\Controllers;


use App\Device;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::paginate(10);
        return view('admin.device.index', compact('devices'));
    }

    public function create()
    {
        return view('admin.device.create');

    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'description' => 'required|unique:devices,description'
        ]);
        Device::create(request(['name', 'description']));
        return redirect('/admin/devices')->withErrors();
    }

}