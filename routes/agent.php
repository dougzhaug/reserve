<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/17
 * Time: 16:57
 */

Route::namespace('Agent')->group(function () {
    // 在 "App\Http\Controllers\Agent" 命名空间下的控制器
    Auth::routes();
    Route::get('auth/weixin_web', 'Auth\WeixinWebController@redirectToProvider');
    Route::get('auth/weixin_web/callback', 'Auth\WeixinWebController@handleProviderCallback');

    Route::get('/','IndexController@index');
});