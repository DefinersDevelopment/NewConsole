<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//use DB;

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

            $table->string('title',500);
            $table->string('slug',550);
            $table->string('author', 200)->nullable(); // this should be an author ID TODO
            $table->string('author_bio', 2000)->nullable(); // this should be an author ID TODO
            $table->string('publication', 2000)->nullable();
            $table->string('url', 2000)->nullable();
            $table->string('guid', 2000)->nullable();
            $table->string('short_description',4000)->nullable();  // for ISS this is 'byline'
            $table->mediumText('body')->nullable();
            
            $table->integer('user_id_created'); // user that created post

            $table->char('status', 2);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE posts ADD FULLTEXT idx_body (body)');
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
