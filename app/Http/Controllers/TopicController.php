<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Topic;
use Illuminate\Support\Facades\Redirect;
use App\PostTopic;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {

        $topic = Topic::withCount(['postTopics'])->find($topic->id);

        $posts = $topic->posts()->orderBy('created_at', 'desc')->take(10)->get();

        // 属于我的文章，但是未投稿
        $myposts = Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

        return view('topic.show', compact('topic', 'posts', 'myposts'));
    }

    public function submit(Topic $topic)
    {
        // 验证
        $this->validate(request(), [
            'post_ids' => 'required|array',
        ]);

        $post_ids = request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $post_id) {
            PostTopic::firstOrCreate(compact('topic_id', 'post_id'));

        }
//        $comment = new Comment();
//        $comment->user_id = Auth::id();
//        $comment->content = \request('content');
//        $post->comments()->save($comment);

        return back();
    }
}
