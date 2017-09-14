<?php
/**
 * Created by PhpStorm.
 * User: fanxin
 * Date: 2017/9/14
 * Time: 下午11:50
 */

namespace App\Admin\Controllers;


use App\Topic;

class TopicController extends Controller
{

    public function index()
    {
        $topics = Topic::all();
        return view('admin.topic.index', compact('topics'));
    }

    public function create()
    {
        return view('admin.topic.create');

    }

    public function store()
    {
        // 验证
        $this->validate(request(), [
            'name' => 'required|string',
        ]);

        $name = request('name');

        Topic::create(compact('name'));
        // 渲染
        return redirect('/admin/topics');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return [
            'error' => 0, 'msg' => ''
        ];
    }
}