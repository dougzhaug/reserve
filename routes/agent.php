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
    Route::get('auth/wechat_web', 'Auth\WechatWebController@redirectToProvider');
    Route::get('auth/wechat_web/callback', 'Auth\WechatWebController@handleProviderCallback');

    Route::get('/','IndexController@index');
});