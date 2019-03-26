<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('operate_mode')->default(0)->comment('企业运营模式  1独立运营（需要自有微信服务号）  2委托运营');
            $table->string('name')->unique()->comment('企业名称');
            $table->string('licence_no')->comment('营业执照号');
            $table->string('licence_image')->comment('营业执照照片');
            $table->tinyInteger('licence_type')->default(0)->comment('营业执照类型（1非合一证  2合一证）');
            $table->tinyInteger('type')->default(0)->comment('企业类型（1个人 2个体工商 3企业）');
            $table->integer('province')->comment('省份');
            $table->integer('city')->comment('城市');
            $table->integer('area')->comment('区/县');
            $table->string('address')->comment('通讯地址');
            $table->string('business_scope')->comment('经营范围');
            $table->string('pic')->comment('负责人/法人/经营者');
            $table->string('pic_id_no')->comment('身份证号');
            $table->string('pic_id_card_front')->comment('身份证照片-正面');
            $table->string('pic_id_card_back')->comment('身份证照片-背面');
            $table->string('pic_phone')->comment('手机号');
            $table->string('pic_email')->comment('电子邮箱');
            $table->tinyInteger('status')->comment('状态 -1未通过 0审核中 1审核通过 2禁用');
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
        Schema::dropIfExists('companies');
    }
}
