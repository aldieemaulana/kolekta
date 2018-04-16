<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Migrations\Migration;
use Kolekta\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('category', false)->unsigned();
            $table->foreign('category')->references('id')->on('categories');
            $table->rememberToken();
            $table->timestamps();
        });

        User::create(['name' => 'Admin', 'username' => 'admin', 'password' => Hash::make('admin'), 'email' => 'admin@vendumedia.com', 'category' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
