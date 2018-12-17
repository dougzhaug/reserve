<?php
/**
 * Created by PhpStorm.
 * User: coolong
 * Date: 2018/12/16
 * Time: 15:32
 */

Route::namespace('Admin')->group(function () {
    // 在 "App\Http\Controllers\Admin" 命名空间下的控制器
    Auth::routes();

    Route::get('/','IndexController@index');

    Route::resource('admin','AdminsController');
    Route::resource('order','OrdersController');
});

