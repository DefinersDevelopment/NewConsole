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


    /*****************************
    	Simple Func. Probably will not be used except maybe as admin
    *****************************/

    public static function getByCategory($cat_id){

    	$posts = Post::whereHas('category', function($q) use($cat_id){

	               $q->where('id', $cat_id); //this refers id field from categories table
				})
                 
                 ->where('status','A')
                 ->orderBy('created_at','desc')
                 ->get();

        return $posts;       
    }

    /*********************************
    	The standard func call that will be used, 
    	returns all posts in a cat
    	WITH the user_posts info (favorite or unread currently)
    	$last_time 
    ************************/

    public static function getByCategoryWithFavAndUnreads($cat_id,$user_id,$limit,$last_time = ''){

    	LogIt('Getting cats with suer posts');
    	
    	/*
    	This can be done with eloquent relations, I am pretty sure
    	but it was more straight forward to do this IMO
    	

    	NOTE: 	I hard code this to get the favorites, then run a seperate query
    			for unreads.  I didnt want to get duplicates;
    	*/

    	$sql = 'select p.id, p.title,p.slug,p.author,p.author_bio,p.publication,p.url, ';
    	$sql .= 'p.updated_at,p.created_at, up.type as favorite ';
    	$sql .= "from posts p inner join category_post cp on p.id = cp.post_id and cp.category_id = $cat_id ";
    	$sql .= "left join user_posts up on p.id = up.post_id and up.user_id = $user_id and up.type = 'F'";
    	

    	LogIt("this is sql $sql");

    	$posts = DB::select($sql);


    	/**********************
			Now, go back to the user_posts and get the other 
			types (currently just Unreads, could be more later)
    	***********************/
    	
    	$ids = ''; // string; CSV of post ids
    	$id_map = []; // a hash where id_map[ post id ] = *pointer to that post
    	foreach ($posts as $p){
    		$ids .= $p->id . ',';
    		$id_map[$p->id] = $p;
    		$p->unread = ''; // make sure something is always there
    	}

    	$ids = rtrim($ids,',');

    	$sql = "select post_id, type from user_posts where post_id in ($ids)";
    	LogIt("this is sql $sql");
    	$user_posts = DB::select($sql);


    	foreach ($user_posts as $up){
    		$post = $id_map[$up->post_id];
    		if (isset($post)){
    			$post->unread = 'U';
    		}
    	}

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
