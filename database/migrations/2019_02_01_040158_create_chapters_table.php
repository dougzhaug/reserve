<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('goods_id')->comment('所属商品');
            $table->string('name')->comment('名称');
            $table->string('summary')->comment('章节简介');
            $table->tinyInteger('charge')->default(1)->comment('0免费/试看 1收费');
            $table->string('files')->comment('上传的文件');
            $table->string('file_format')->default('')->comment('上传文件格式（小写）');
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
        Schema::dropIfExists('chapters');
    }
}
