<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->default(0)->comment('所属企业');
            $table->integer('shop_id')->default(0)->comment('所属商店');
            $table->string('username')->unique()->comment('用户名');
            $table->string('openid')->unique()->comment('用户唯一标识');
            $table->string('phone')->default('')->comment('手机号');
            $table->string('email')->default('')->comment('电子邮箱');
            $table->string('nickname')->comment('昵称');
            $table->string('avatar')->default('')->comment('头像');
            $table->tinyInteger('sex')->default(0)->comment('性别 0:未知 1:男 2:女');
            $table->string('password')->comment('密码');
            $table->string('sld')->default('')->comment('二级域名');
            $table->tinyInteger('sld_update_times')->default(0)->comment('二级域名更新次数');
            $table->tinyInteger('source')->default(0)->comment('注册来源 0:手机注册 1:微信注册 2:QQ注册 3:微博注册');
            $table->tinyInteger('status')->default(0)->comment('状态 0:禁用 1:启用');
            $table->tinyInteger('authorize_status')->default(0)->comment('公众号授权状态 0:未授权 1:已授权');
            $table->rememberToken();
            $table->timestamps();

            //索引
            $table->index('username');
            $table->index('openid');
            $table->index('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('managers');
    }
}
