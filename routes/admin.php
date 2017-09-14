<?php

use Illuminate\Support\Facades\Route;

// 管理后台
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', '\App\Admin\Controllers\LoginController@index');
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');

        // 管理人员模块
        Route::get('/users', '\App\Admin\Controllers\UsersController@index');
        Route::get('/users/create', '\App\Admin\Controllers\UsersController@create');
        Route::post('/users/store', '\App\Admin\Controllers\UsersController@store');

        // 文章审核模块
        Route::get('/posts', '\App\Admin\Controllers\PostController@index');
        Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');

    });
});