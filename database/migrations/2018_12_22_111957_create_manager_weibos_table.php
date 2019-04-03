<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerWeibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_weibos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid')->comment('微博返回的用户id');
            $table->string('openid')->comment('微博 openid');
            $table->string('name')->default('')->comment('');
            $table->string('email')->default('')->comment('');
            $table->string('screen_name')->comment('屏幕名称');
            $table->string('gender')->comment('性别');
            $table->string('location')->comment('地址');
            $table->string('lang')->comment('语言');
            $table->string('province')->default('')->comment('省份');
            $table->string('city')->default('')->comment('城市');
            $table->string('description')->default('')->comment('描述');
            $table->integer('followers_count')->comment('粉丝数');
            $table->integer('friends_count')->comment('关注数');
            $table->integer('pagefriends_count')->comment('');
            $table->integer('statuses_count')->comment('发布的微博数');
            $table->integer('video_status_count')->comment('');
            $table->integer('favourites_count')->comment('');
            $table->string('created_time')->comment('微博创建时间');
            $table->string('avatar_large')->comment('大头像（使用）');
            $table->string('avatar_hd')->comment('高清头像');
            $table->integer('bi_followers_count')->comment('互相关注数');
            $table->integer('credit_score')->comment('信用分');
            $table->string('refresh_token')->comment('刷新token标识');
            $table->dateTime('expires')->comment('用户信息刷新标识（防止用户修改信息后没有及时更新）');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager_weibos');
    }
}
