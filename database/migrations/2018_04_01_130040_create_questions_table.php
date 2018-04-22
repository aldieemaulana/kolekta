<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type', false)->unsigned();
            $table->foreign('type')->references('id')->on('types');
            $table->integer('page', false)->unsigned();
            $table->foreign('page')->references('id')->on('pages');
            $table->smallInteger('position', false)->unsigned();
            $table->string('unique');
            $table->text('question');
            $table->boolean('add_other')->default(false);
            $table->boolean('required')->default(false);
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
        Schema::dropIfExists('questions');
    }
}
