<?php

namespace App\Providers;

use App\Topic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \Carbon\Carbon::setLocale('zh');

        \View::composer('layout.sidebar', function ($view) {
            $topics = Topic::all();
            $view->with('topics', $topics);
        });

//        DB::listen(function ($query) {
//            $sql = $query->sql;
//            $bindings = $query->bindings;
//            $time = $query->time;
//            // 只打印查询大于10ms的查询
//            if ($time > 10) {
//                Log::debug(var_export(compact('sql', 'bindings', 'time'), true));
//            }
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
