<?php

namespace App;

use Laravel\Scout\Searchable;

class Post extends BaseModel
{

    use Searchable;

    // 定义索引里面的type
    public function searchableAs()
    {
        return 'post';
    }

    // 有哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    // 关联用户
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // 评论模型
    public function comments()
    {
        return $this
            ->hasMany('App\Comment', 'post_id', 'id')
            ->orderBy('created_at', 'desc');
    }

    // 和用户关联
    public function zan($user_id)
    {
        return $this->hasOne(Zan::class)->where('user_id', $user_id);
    }

    // 文章的所有赞
    public function zans()
    {
        return $this->hasMany(Zan::class);
    }

}
