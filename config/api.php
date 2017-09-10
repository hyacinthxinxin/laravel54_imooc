<?php


return [
    'standardsTree' => env('API_STANDARDS_TREE', 'x'),
    'subtype' => env('API_SUBTYPE', ''),
    'version' => env('API_VERSION', 'v1'),
    'prefix' => env('API_PREFIX', 'api'),
    'domain' => env('API_DOMAIN', 'localhost'),
    'name' => env('API_NAME', null),
    'conditionalRequest' => env('API_CONDITIONAL_REQUEST', true),
    'strict' => env('API_STRICT', false),
    'debug' => env('API_DEBUG', false),
    'errorFormat' => [
        'message' => ':message',
        'errors' => ':errors',
        'code' => ':code',
        'status_code' => ':status_code',
        'debug' => ':debug',
    ],
    'middleware' => [

    ],
    'auth' => [
        'basic'=>function($app){
            return new  Dingo\Api\Auth\Provider\Basic($app['auth']);
        },
        'jwt'=>function($app){
            return new  Dingo\Api\Auth\Provider\JWT($app['Tymon\JWTAuth\JWTAuth']);
        }
    ],
    'throttling' => [

    ],
    'transformer' => env('API_TRANSFORMER', Dingo\Api\Transformer\Adapter\Fractal::class),
    'defaultFormat' => env('API_DEFAULT_FORMAT', 'json'),
    'formats' => [
        'json' => Dingo\Api\Http\Response\Format\Json::class,
    ],

];
