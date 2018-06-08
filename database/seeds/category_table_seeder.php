<?php

use Illuminate\Database\Seeder;

class category_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
		DB::table('category')->insert([
        	'id' => 1,
            'parent_id' => 0,
            'name' => 'category 1',
            'slug' => 'category_1',
            
            'user_id_created' => 1,
            
        ]);
    }
}
