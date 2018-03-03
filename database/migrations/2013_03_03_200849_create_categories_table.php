<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kolekta\Category;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('public');
            $table->timestamps();
        });

        Category::create(['name' => 'admin', 'public' => false]);
        Category::create(['name' => 'customer', 'public' => true]);
        Category::create(['name' => 'consultant', 'public' => true]);
        Category::create(['name' => 'surveyor', 'public' => true]);
        Category::create(['name' => 'responder', 'public' => true]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
