<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/17
 * Time: 16:57
 */

Route::namespace('Agent')->group(function () {
    // 在 "App\Http\Controllers\Agent" 命名空间下的控制器

    Route::get('/','IndexController@index');
    Route::get('demo', 'IndexController@demo');

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
    Route::any('open-platform/callback','OpenPlatformController@callback');

    //代理商管理
    Route::resource('agents', 'AgentsController');
    Route::post('agents', 'AgentsController@index');
    Route::post('agents/status/{agent?}', 'AgentsController@status');

    //权限管理
    Route::resource('permissions', 'Rbac\PermissionsController');
    Route::get('permissions/create/{id?}', 'Rbac\PermissionsController@create');
    Route::post('permissions/index', 'Rbac\PermissionsController@index');
    Route::post('permissions/sort/{permission}', 'Rbac\PermissionsController@sort');
    Route::post('permissions/toggle_nav/{permission}', 'Rbac\PermissionsController@toggleNav');

    //角色管理
    Route::resource('roles', 'Rbac\RolesController');
    Route::post('roles/index', 'Rbac\RolesController@index');
    Route::post('roles/permission_tree/{role?}', 'Rbac\RolesController@permissionTree');
    Route::post('roles/status/{role?}', 'Rbac\RolesController@status');


    //商品管理
    Route::get('goods/{goods}/edit', 'GoodsController@edit')->name('goods.edit');       //重置路由-资源路由查不到数据
    Route::patch('goods/{goods}', 'GoodsController@update')->name('goods.edit');        //重置路由-资源路由查不到数据
    Route::delete('goods/{goods}', 'GoodsController@destroy')->name('goods.destroy');   //重置路由-资源路由查不到数据
    Route::resource('goods', 'GoodsController');
    Route::post('goods/index', 'GoodsController@index');

});