<?php

namespace App\Jobs;

use App\Notice;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $notice;

    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
    }

    public function handle()
    {
        // 通知每个用户
        $users = User::all();
        foreach ($users as $user) {
            $user->addNotice($this->notice);
        }
    }

}
