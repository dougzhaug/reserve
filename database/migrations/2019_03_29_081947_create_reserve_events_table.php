<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserveEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserve_id')->default(0)->comment('所属预约项目');
            $table->year('year')->comment('年份(2019)');
            $table->string('month',10)->comment('月份(2019-03)');
            $table->date('date')->comment('日期(2019-03-01)');
            $table->time('start_time')->comment('日程开始时间(12:45:00)');
            $table->time('end_time')->comment('日程结束时间(15:15:00)');
            $table->tinyInteger('status')->default(-1)->comment('状态 -1未预约 1已经预约');
            $table->integer('user_id')->default(0)->comment('预约用户id');
            $table->string('name')->default('')->comment('预约人的姓名');
            $table->string('phone')->default('')->comment('预约人的联系方式');
            $table->string('remark')->default('')->comment('预约备注信息（其它预约信息，使用json结构存放）');
            $table->timestamp('submit_at')->comment('用户提交时间');
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
        Schema::dropIfExists('reserve_events');
    }
}
