<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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
            ->hasMany(Comment::class, 'post_id', 'id')
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


    // 属于某一个作者的文章
    public function scopeAuthorBy(Builder $query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function postTopics()
    {
        return $this->hasMany(PostTopic::class);
    }

    // 不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query, $topic_id)
    {
        return $query->doesntHave(
            'postTopics', 'and', function ($q) use ($topic_id) {
            $q->where('topic_id', $topic_id);
        });
    }

    // 全局scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('available', function (Builder $builder) {
            $builder->whereIn('status', [0, 1]);
        });
    }

}
