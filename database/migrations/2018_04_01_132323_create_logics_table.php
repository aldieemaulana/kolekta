<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('answer', false)->unsigned();
            $table->foreign('answer')->references('id')->on('answers');
            $table->integer('skip_to', false)->unsigned();
            $table->foreign('skip_to')->references('id')->on('pages');
            $table->integer('skip_to_question', false)->unsigned();
            $table->foreign('skip_to_question')->references('id')->on('questions');
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
        Schema::dropIfExists('logics');
    }
}
