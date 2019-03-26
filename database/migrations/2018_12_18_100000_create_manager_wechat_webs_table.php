<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerWechatWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_wechat_webs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid')->comment('微信openid');
            $table->string('name')->default('')->comment('');
            $table->string('email')->default('')->comment('');
            $table->string('nickname')->comment('昵称');
            $table->string('headimgurl')->comment('头像');
            $table->tinyInteger('sex')->comment('性别');
            $table->string('language')->default('')->comment('语言');
            $table->string('country')->comment('国家');
            $table->string('province')->comment('省份');
            $table->string('city')->comment('城市');
            $table->string('privilege')->default('')->comment('特权');
            $table->string('unionid')->default('')->comment('唯一识别号');
            $table->string('refresh_token')->comment('刷新token标识');
            $table->dateTime('expires')->comment('用户信息刷新标识（防止用户修改信息后没有及时更新）');
            $table->timestamps();

            //索引
            $table->index('openid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager_wechat_webs');
    }
}
