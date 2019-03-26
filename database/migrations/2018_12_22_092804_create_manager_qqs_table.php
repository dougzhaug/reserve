<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerQqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_qqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid')->comment('QQopenid');
            $table->string('name')->default('')->comment('');
            $table->string('email')->default('')->comment('');
            $table->tinyInteger('is_lost')->comment('');
            $table->string('nickname')->comment('昵称');
            $table->string('gender')->comment('性别');
            $table->string('province')->default('')->comment('省份');
            $table->string('city')->default('')->comment('城市');
            $table->string('year')->default(0)->comment('年份');
            $table->string('constellation')->comment('星座');
            $table->string('figureurl')->comment('空间头像');
            $table->string('figureurl_1')->comment('空间头像1');
            $table->string('figureurl_2')->comment('空间头像2');
            $table->string('figureurl_qq_1')->comment('QQ头像1');
            $table->string('figureurl_qq_2')->comment('QQ头像2 (代理商使用)');
            $table->tinyInteger('is_yellow_vip')->comment('');
            $table->tinyInteger('vip')->comment('');
            $table->tinyInteger('yellow_vip_level')->comment('');
            $table->tinyInteger('level')->comment('');
            $table->tinyInteger('is_yellow_year_vip')->comment('');
            $table->string('unionid')->default('')->comment('唯一识别号');
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
        Schema::dropIfExists('manager_qqs');
    }
}
