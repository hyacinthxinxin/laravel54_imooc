<?php
/**
 * Created by PhpStorm.
 * User: fanxin
 * Date: 2017/9/15
 * Time: 上午12:13
 */

namespace App\Admin\Controllers;


use App\Jobs\SendMessage;
use App\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::all();
        return view('admin.notice.index', compact('notices'));
    }

    public function create()
    {
        return view('admin.notice.create');

    }

    public function store()
    {
        // 验证
        $this->validate(request(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $title = request('title');
        $content = request('content');

        $notice = Notice::create(compact('title', 'content'));

        dispatch(new SendMessage($notice));
        // 渲染
        return redirect('/admin/notices');
    }

}