<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_goods', function (Blueprint $table) {
            $table->unsignedInteger('agent_id');
            $table->unsignedInteger('goods_id');

            $table->foreign('agent_id')
                ->references('id')
                ->on('agents')
                ->onDelete('cascade');

            $table->foreign('goods_id')
                ->references('id')
                ->on('goods')
                ->onDelete('cascade');

            $table->primary(['agent_id', 'goods_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_goods');
    }
}
