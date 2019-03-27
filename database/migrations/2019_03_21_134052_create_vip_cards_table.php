<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVipCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->default(0)->comment('所属企业');
            $table->integer('shop_id')->default(0)->comment('所属商店');
            $table->string('name')->default('')->comment('会员卡名称');
            $table->string('bg_image')->default('')->comment('会员卡背景图');
            $table->tinyInteger('type')->default(0)->comment('会员卡类型 1储值卡 2次卡');
            $table->decimal('price',10,2)->default(0.00)->comment('会卡价格');
            $table->decimal('present',10,2)->default(0)->comment('储值卡:赠送金额  次卡:购买的次数');
            $table->tinyInteger('universal')->default(0)->comment('通用卡 0否（单店卡） 1是（通用卡）');
            $table->integer('valid_date')->default(0)->comment('有效天数  0永久有效');
            $table->text('direction_for_use')->comment('使用须知');
            $table->tinyInteger('status')->default(0)->comment('状态 -1禁用 1正常');
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
        Schema::dropIfExists('vip_cards');
    }
}
