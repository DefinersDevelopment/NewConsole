<?php

use Illuminate\Database\Seeder;

class category_posts_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('category_post')->insert([
        	'category_id' => 4,
            'post_id' => 1
        ]);

        DB::table('category_post')->insert([
        	'category_id' => 4,
            'post_id' => 2
        ]);

        DB::table('category_post')->insert([
        	'category_id' => 3,
            'post_id' => 3
        ]);

        DB::table('category_post')->insert([
        	'category_id' => 1,
            'post_id' => 3
        ]);
    }
}
