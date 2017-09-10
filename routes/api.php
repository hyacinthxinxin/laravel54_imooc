<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 接管路由
$api = app('Dingo\Api\Routing\Router');
// 配置api版本和路由
$api->version('v1', ['namespace' => 'App\Http\Api\V1\Controllers'], function ($api) {
    // 授权组
    $api->group(['prefix' => 'auth'], function ($api) {
        $api->post('register', ['as' => 'auth.register', 'uses' => 'AuthenticateController@register']);
    });
    // 文章组
    $api->group(['prefix' => 'posts'], function ($api) {
        $api->get('/', ['as' => 'post.index', 'uses' => 'PostController@index']);
    });
});
app('Dingo\Api\Routing\UrlGenerator')->version('v1');