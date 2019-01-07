<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/17
 * Time: 16:57
 */

Route::namespace('Agent')->group(function () {
    Route::get('demo', 'IndexController@demo');

    // 在 "App\Http\Controllers\Agent" 命名空间下的控制器
    Auth::routes();
    //登出
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    //微信公众号授权
    Route::get('authorize', 'Auth\SnsRegisterController@showRegistrationForm');

    /***** 第三方登录 *****/
    //微信登录
    Route::get('auth/wechat_web', 'Auth\WechatWebController@redirectToProvider');
    Route::get('auth/wechat_web/callback', 'Auth\WechatWebController@handleProviderCallback');
    //QQ登录
    Route::get('auth/qq', 'Auth\QqController@redirectToProvider');
    Route::get('auth/qq/callback', 'Auth\QqController@handleProviderCallback');
    //微博登录
    Route::get('auth/weibo', 'Auth\WeiBoController@redirectToProvider');
    Route::get('auth/weibo/callback', 'Auth\WeiBoController@handleProviderCallback');

    /***** 第三方登录（完） *****/

    //微信开放平台授权
    Route::any('open-platform/serve','OpenPlatformController@serve');

    Route::get('/','IndexController@index');
    Route::get('test','IndexController@index');
    Route::get('order/create','IndexController@index');

    //代理商管理
    Route::resource('agents', 'AgentsController');
    Route::post('agents', 'AgentsController@index');

    //权限管理
    Route::get('permissions/create/{id?}', 'Rbac\PermissionsController@create');
    Route::resource('permissions', 'Rbac\PermissionsController');
    Route::post('permissions/index', 'Rbac\PermissionsController@index');
});