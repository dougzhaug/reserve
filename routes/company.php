<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/17
 * Time: 16:57
 */

Route::namespace('Company')->group(function () {
    // 在 "App\Http\Controllers\Company" 命名空间下的控制器

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

    //会员管理
    Route::resource('managers', 'ManagersController');
    Route::post('managers/index', 'ManagersController@index');
    Route::post('managers/status/{manager?}', 'ManagersController@status');

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

    //商店管理
    Route::resource('shops', 'ShopsController');
    Route::post('shops/index', 'ShopsController@index');

    //预约管理
    Route::get('reserves/{reserve}', 'ReservesController@show');
    Route::post('reserves/get_reserves','ReservesController@getReserves');
    Route::post('reserves/get_reserve_events','ReservesController@getReserveEvents');
    Route::get('reserves/{reserve}/edit', 'ReservesController@edit');
    Route::patch('reserves/{reserve}', 'ReservesController@update');
    Route::resource('reserves', 'ReservesController');
    Route::post('reserves/index', 'ReservesController@index');

    //用户管理
//    Route::get('users/{reserve}/edit', 'ReservesController@edit');
//    Route::patch('reserves/{reserve}', 'ReservesController@update');
    Route::resource('users', 'UsersController');
    Route::post('users/index', 'UsersController@index');

    //用户会员卡管理

    Route::get('user_vip_cards/{user_vip_card}/edit', 'UserVipCardsController@edit');
    Route::get('user_vip_cards/create/{user_id}/{shop_id}', 'UserVipCardsController@create');
    Route::get('user_vip_cards/{user_id}/{shop_id}', 'UserVipCardsController@index');
    Route::post('user_vip_cards/create', 'UserVipCardsController@create');
    Route::post('user_vip_cards/get_vip_card', 'UserVipCardsController@getVipCard');
//    Route::get('user_vip_cards/{user_id}', 'UserVipCardsController@index');
    Route::resource('user_vip_cards', 'UserVipCardsController');
    Route::post('user_vip_cards/index/{user_id}/{shop_id}', 'UserVipCardsController@index');

});