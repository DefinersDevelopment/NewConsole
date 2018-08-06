<?php

use Illuminate\Database\Seeder;


class users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	  
        //
        DB::table('users')->insert([
        	'id'=> 1,
            'first_name' => 'ben',
            'last_name' => 'client',
            'title' => 'test title',
            'company' => 'awesome paper',
            'city' => 'Whalla Whalla',
            'state' => 'washington',
            'phone' => '999-555-5555',
            'email' => 'bbrown@definerscorp.com',
            'token' => '12345',
            'status' => 'A',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
        	'id'=> 2,
            'first_name' => 'wesley',
            'last_name' => 'client',
            'title' => 'test title',
            'company' => 'awesome paper',
            'city' => 'Whalla Whalla',
            'state' => 'washington',
            'phone' => '999-555-5555',
            'email' => 'wroberts@definerscorp.com',
            'token' => '12346',
            'status' => 'A',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
        	'id'=> 3,
            'first_name' => 'john',
            'last_name' => 'client',
            'title' => 'test title',
            'company' => 'awesome paper',
            'city' => 'Whalla Whalla',
            'state' => 'washington',
            'phone' => '999-555-5555',
            'email' => 'jfowler@definerscorp.com',
            'token' => '12347',
            'status' => 'A',
            'password' => bcrypt('password'),
        ]);
        //
       

    }
}
