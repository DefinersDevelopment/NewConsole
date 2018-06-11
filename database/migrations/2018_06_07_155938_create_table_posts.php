<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('slug');
            $table->string('author', 200)->nullable(); // this should be an author ID TODO
            $table->string('url', 1000)->nullable();
            $table->text('short_description')->nullable();
            $table->longText('body')->nullable();
            
            $table->integer('user_id_created'); // user that created post

            $table->char('status', 2);
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
        //
       Schema::dropIfExists('posts');
    }
}
