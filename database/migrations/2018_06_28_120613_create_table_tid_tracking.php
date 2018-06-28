<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTidTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tid_tracking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); 
            $table->integer('post_id'); 
            $table->string('referer', 2000);
            $table->string('user_agent', 1000);
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
        //
        Schema::dropIfExists('tid_tracking');
    }
}
