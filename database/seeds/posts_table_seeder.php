<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

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

        $post = new Post;

		$post->id = 1;
		$post->title = "Post Title 1";
		$post->slug = 'post_title_1';
		$post->author = 'John B. Goode';
		$post->short_description = 'Oh what a great article this is going to be random stuff here.';
		$post->body = 'NOhting to see here, move along';
		$post->status = 'A';
		$post->user_id_created = 1;
		$post->save();

		 $post = new Post;

		$post->id = 2;
		$post->title = "Post Title 2";
		$post->slug = 'post_title_2';
		$post->author = 'John B. Goode';
		$post->short_description = 'Oh what a great article this is going to be random stuff here.';
		$post->body = 'NOhting to see here, move along';
		$post->status = 'A';
		$post->user_id_created = 1;
		$post->save(); 

		 $post = new Post;

		$post->id = 3;
		$post->title = "Post Title 3";
		$post->slug = 'post_title_3';
		$post->author = 'John B. Goode';
		$post->short_description = 'Oh what a great article this is going to be random stuff here.';
		$post->body = 'NOhting to see here, move along';
		$post->status = 'A';
		$post->user_id_created = 2;
		$post->save(); 


    }
}
