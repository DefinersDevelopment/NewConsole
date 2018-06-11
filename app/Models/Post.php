<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

     public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'category_post');
    }



    public static function getByCategory($cat_id){

    	$posts = Post::whereHas('category', function($q) use($cat_id){

	               $q->where('id', $cat_id); //this refers id field from categories table
				})
                 
                 ->where('status','A')
                 ->orderBy('created_at','desc')
                 ->get();

        return $posts;       
    }

    public static function getPost($id){

    	$post = Post::find($id);
    	return $post;
    }
}
