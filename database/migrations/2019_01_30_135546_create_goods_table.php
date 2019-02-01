<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agent_id')->comment('上传者id');
            $table->string('name')->comment('名称');
            $table->string('author')->comment('作者');
            $table->string('summary')->comment('简介');
            $table->string('images')->comment('展示图集');
            $table->smallInteger('category')->default(0)->comment('商品类型 1-9图集 10-19动漫 20-29小说 30-39影音 40-49影视');
            $table->float('price', 10, 2)->default(0.00)->comment('价格');
            $table->tinyInteger('status')->default(0)->comment('商品状态 -1审核未通过 0未审核 1审核通过 2上架 3下架');
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
        Schema::dropIfExists('goods');
    }
}
