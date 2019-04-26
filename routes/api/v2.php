<?php
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

$api = app('Dingo\Api\Routing\Router');

$params = [
    'version' => 'v2',
    'domain' => 'api.'.config('app.tld'),
    'namespace' => 'App\\Http\\Controllers\\Api',
];


$api->group($params, function ($api) {

    /**
     * Auth
     */
    $api->group(['namespace' => 'Auth'],function ($api){
        $api->post('/mini_program/login','MiniProgram\LoginController@index');
    });

    /**
     * V2
     */
    $api->group(['namespace' => 'V2'],function ($api){
        $api->get('/get_user_info','IndexController@index');
    });
});
