<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
          $this->call([
        		category_users_seeder::class,
        		posts_table_seeder::class,
        		category_posts_seeder::class,
        		users_table_seeder::class,
        		category_table_seeder::class,
        		user_posts_table_seeder::class
    	]);
    }
}
