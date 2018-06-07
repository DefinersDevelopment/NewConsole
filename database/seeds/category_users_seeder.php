<?php

use Illuminate\Database\Seeder;

class category_users_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('category_user')->insert([
        	'user_id' => 1,
            'category_id' => 1
        ]);
    }
}
