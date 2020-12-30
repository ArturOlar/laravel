<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteNewsImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('news_image');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('news_image', function (Blueprint $table) {
            $table->bigIncrements('id_image');
            $table->integer('id_news');
            $table->string('image_url', 300);
            $table->timestamps();
        });
    }
}
