<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->default(0)->comment('所属企业');
            $table->integer('manager_id')->default(0)->comment('店长');
            $table->string('name')->unique()->comment('商店名称');
            $table->string('logo')->comment('商店LOGO');
            $table->string('images')->comment('商店图片');
            $table->integer('province')->comment('省份');
            $table->integer('city')->comment('城市');
            $table->integer('area')->comment('区/县');
            $table->string('address')->comment('通讯地址');
            $table->tinyInteger('status')->comment('状态 0禁用 1正常');
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
        Schema::dropIfExists('shops');
    }
}
