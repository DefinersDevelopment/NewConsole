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
            'name' => 'ben-client',
            'email' => 'bbrown@definerscorp.com',
            'password' => bcrypt('password'),
        ]);
        //
        DB::table('users')->insert([
            'name' => 'marc-client',
            'email' => 'mhess@definerscorp.com',
            'password' => bcrypt('password'),
        ]);

        //
        DB::table('users')->insert([
            'name' => 'john-client',
            'email' => 'jfowler@definerscorp.com',
            'password' => bcrypt('password'),
        ]);
        
    }
}
