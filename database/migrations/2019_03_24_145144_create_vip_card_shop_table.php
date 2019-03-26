<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVipCardShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_card_shop', function (Blueprint $table) {
            $table->unsignedInteger('vip_card_id');
            $table->unsignedInteger('shop_id')->comment('通用会员卡，绑定的商店信息');

            $table->foreign('vip_card_id')
                ->references('id')
                ->on('vip_cards')
                ->onDelete('cascade');

            $table->foreign('shop_id')
                ->references('id')
                ->on('shops')
                ->onDelete('cascade');

            $table->primary(['vip_card_id', 'shop_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vip_card_shop');
    }
}
