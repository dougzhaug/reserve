<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique()->comment('用户名');
            $table->string('nickname')->comment('昵称');
            $table->string('avatar')->comment('头像');
            $table->string('phone')->unique()->comment('手机号');
            $table->tinyInteger('sex')->default(0)->comment('性别 0:未知 1:男 2:女');
            $table->string('password')->comment('密码');
            $table->tinyInteger('source')->default(0)->comment('注册来源 0:手机注册 1:微信注册 2:QQ注册 3:微博注册');
            $table->rememberToken();
            $table->timestamps();

            //索引
//            $table->index('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
}