<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('post/index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }

    public function create()
    {
        return view('post/create');

    }

    public function store()
    {
        // 验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        // 逻辑
        $post = Post::create(request(['title', 'content']));

        // 渲染
        return redirect('/posts');
    }

    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));

    }

    public function update(Post $post)
    {
        // 验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        // 逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        // 渲染
        return redirect("/posts/{$post->id}");
    }

    public function delete(Post $post)
    {
        // TODO: 用户权限认证
        $post->delete();
        return redirect("/posts");
    }

    public function imageUpload(Request $request)
    {
        $path = $request->file("wangEditorH5File")->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }

}