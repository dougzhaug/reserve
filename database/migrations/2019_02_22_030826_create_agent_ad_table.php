<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_ad', function (Blueprint $table) {
            $table->unsignedInteger('agent_id');
            $table->unsignedInteger('goods_id');
            $table->tinyInteger('way')->default(0)->comment('广告位置 1首页');

            $table->primary(['agent_id', 'goods_id','way']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_ad');
    }
}
