<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Helpers\Logging;

class Post extends Model
{
    //
    protected $table = 'posts';
    protected $fillable = ['title','slug','author','author_bio','publication',
    					'url','short_description','body','user_id_created','status'];

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

    public static function getByCategoryWithFavorites($cat_id,$user_id){

    	/*
    	This can be done with eloquent relations, I am pretty sure
    	but it was more straight forward to do this IMO
    	*/
    	$posts = DB::select("select p.title,p.slug,p.author,p.author_bio,p.publication,p.url, up.type 
    							from posts p join category_post cp on (p.id=cp.post_id and cp.category_id = $cat_id) left join user_posts up on (p.id = up.post_id and up.type='F' and up.user_id = $user_id) ");

        return $posts;       
    }

    // made this a function in case we want to 

    public static function getPost($id){

    	$post = Post::find($id);

    	return $post;
    }

    public function validate(){
    	
    	$errors;

    	// title is required
    	if (!isset($this->title) || $this->title == ''){
    		$errors['title'] = 'Title is required';
    	}

    	//author max length is 200
    	if (strlen($this->author) > 200){
    		$errors['author'] = 'Max Length 200';	
    	}

    	//author_bio max length is 2000
    	if (strlen($this->author_bio) > 2000){
    		$errors['author_bio'] = 'Max Length 2000';	
    	}

		//publication max length is 2000
    	if (strlen($this->publication) > 2000){
    		$errors['publication'] = 'Max Length 2000';	
    	} 

    	//short_description max length is 4000
    	if (strlen($this->short_description) > 4000){
    		$errors['short_description'] = 'Max Length 4000';	
    	}

    	if (isset($errors)){
    		return $errors;	
    	} else {
    		return null;
    	}
    	

    }

}
