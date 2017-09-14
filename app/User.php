<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password'];

    // 用户的文章
    public function posts()
    {
        return $this->hasMany(\App\Post::Class, 'user_id', 'id');
    }

    // 关注我的模型
    public function fans()
    {
        return $this->hasMany(\App\Fan::Class, 'star_id', 'id');
    }

    // 我关注的模型
    public function stars()
    {
        return $this->hasMany(\App\Fan::Class, 'fan_id', 'id');
    }

    // 关注某人
    public function doFan($user_id)
    {
        $fan = new Fan();
        $fan->star_id = $user_id;
        return $this->stars()->save($fan);
    }

    // 取消关注
    public function doUnfan($user_id)
    {
        $fan = new Fan();
        $fan->star_id = $user_id;
        return $this->stars()->delete($fan);
    }

    // 当前用户是否被某人关注
    public function hasFan($user_id)
    {
        return $this->fans()->where('fan_id', $user_id)->count();
    }

    // 当前用户是否关注了某人
    public function hasStar($user_id)
    {
        return $this->stars()->where('star_id', $user_id)->count();
    }

    public function notices()
    {
        return $this->belongsToMany(Notice::class, 'user_notice', 'user_id', 'notice_id')
            ->withPivot('user_id', 'notice_id');
    }

    public function addNotice(Notice $notice)
    {
        return $this->notices()->save($notice);
    }

}
