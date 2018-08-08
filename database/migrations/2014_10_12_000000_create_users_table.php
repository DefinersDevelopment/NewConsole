<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


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
           
            $table->string('first_name');
            $table->string('last_name');
            $table->string('title');
            $table->string('company');
            $table->string('city');
            $table->string('state');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('token',200)->unique();
            $table->string('password');
            $table->string('status', 5);
            $table->tinyInteger('level');
            $table->boolean('agreedTC')->nullable();
            $table->dateTime('agreedTC_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
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
