<?php

use Illuminate\Database\Seeder;

class user_posts_table_seeder extends Seeder
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
        DB::table('user_posts')->insert([
        	'user_id' => 1,
            'post_id' => 1,
            'type' => 'F'
        ]);

           DB::table('user_posts')->insert([
        	'user_id' => 1,
            'post_id' => 2,
            'type' => 'U'
        ]);
    }
}
