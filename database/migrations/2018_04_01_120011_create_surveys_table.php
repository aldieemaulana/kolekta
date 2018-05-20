<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user', false)->unsigned();
            $table->foreign('user')->references('id')->on('users');
            $table->string('name');
            $table->string('description')->nullable();
            $table->dateTime('open_time')->useCurrent();
            $table->dateTime('close_time')->nullable();
            $table->boolean('required_asterik')->default(true);
            $table->boolean('question_number')->default(true);
            $table->string('logo')->nullable();
            $table->boolean('public')->default(true);
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
        Schema::dropIfExists('surveys');
    }
}
