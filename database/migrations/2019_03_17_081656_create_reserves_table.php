<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->default(0)->comment('所属企业');
            $table->integer('shop_id')->default(0)->comment('所属商店');
            $table->integer('manager_id')->default(0)->comment('负责人');
            $table->string('name')->default('')->comment('预约项目名称');
            $table->integer('min_ahead_days')->default(0)->comment('最小提前预约天数');
            $table->integer('max_ahead_days')->default(1)->comment('最大提前预约天数');
            $table->tinyInteger('type')->default(0)->comment('预约类型 1唯一方式 2时间段 3排号');
            $table->text('config')->comment('预约配置信息');
            $table->tinyInteger('status')->default(0)->comment('状态 0禁用 1正常');
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
        Schema::dropIfExists('reserves');
    }
}
