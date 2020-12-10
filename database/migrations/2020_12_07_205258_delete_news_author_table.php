<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteNewsAuthorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('news_author');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('news_author', function (Blueprint $table) {
            $table->integer('id_news');
            $table->integer('id_author');
            $table->primary(['id_news', 'id_author']);
            $table->timestamps();
        });
    }
}
