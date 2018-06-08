<?php

use Illuminate\Database\Seeder;

class posts_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //
        DB::table('posts')->insert([
        	'id' => 1,
            'title' => 'Test Post 1',
            'slug' => 'test_post_1',
            'author' => 'Test Author 1',
            'short_description' => 'this is a very short short_description',
            'body' => 'body is also short',
            'user_id_created' => 1,
            'status' => 'A'

        ]);

    }
}
