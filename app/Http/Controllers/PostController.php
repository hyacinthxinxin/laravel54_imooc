<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->withCount(['comments', 'zans'])
            ->paginate(6);
        $posts->load('user');
        return view('post/index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('comments');
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
        $user_id = Auth::id();
        $params = array_merge(request(['title', 'content']), compact('user_id'));
        $post = Post::create($params);

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

        $this->authorize('update', $post);
        // 逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        // 渲染
        return redirect("/posts/{$post->id}");
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();
        return redirect("/posts");
    }

    public function imageUpload(Request $request)
    {
        $path = $request->file("wangEditorH5File")->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }

    public function comment(Post $post)
    {
        // 验证
        $this->validate(request(), [
            'content' => 'required|min:3',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = \request('content');
        $post->comments()->save($comment);

        return back();

    }

    public function zan(Post $post)
    {
        $params = [
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ];
        Zan::firstOrCreate($params);
        return back();
    }

    public function unzan(Post $post)
    {
        $post->zan(Auth::id())->delete();
        return back();
    }

    public function search()
    {
        // 验证
        $this->validate(request(), [
            'query' => 'required',
        ]);

        $query = \request('query');
        $posts = Post::search($query)->paginate(2);


        return view("post.search", compact('posts', 'query'));
    }

}
