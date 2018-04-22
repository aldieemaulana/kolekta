<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user', false)->unsigned();
            $table->foreign('user')->references('id')->on('users');
            $table->string('name');
            $table->integer('survey_category', false)->unsigned();
            $table->foreign('survey_category')->references('id')->on('survey_categories');
            $table->text('descriptions');
            $table->enum('type', ['public', 'targeting']);
            $table->enum('status', ['pending', 'doing', 'done']);
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
        Schema::dropIfExists('requests');
    }
}
