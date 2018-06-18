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

/**********
The standard that we return when getting a list of POSTS
***********/

    private static function selectSQL(){
    	return  'select p.id, p.title,p.slug,p.author,p.author_bio,p.publication,p.url, p.short_description,
    	p.updated_at,p.created_at, up.type as favorite, up2.type as unread ';
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

    	$sql = Post::selectSQL() .  'from posts p ';
        $sql .=  " inner join category_post cp on p.id = cp.post_id and cp.category_id = $cat_id ";
    	$sql .= "left join user_posts up on p.id = up.post_id and up.user_id = $user_id and up.type = 'F' ";
        $sql .= "left join user_posts up2 on p.id = up2.post_id and up.user_id = $user_id and up2.type = 'U' ";
    	$sql .= " where p.deleted_at IS NULL and p.status = 'A' ";
    	

    	LogIt("this is sql $sql");

    	$posts = DB::select($sql);
 
        return $posts;       
    }

    public static function getUserPostsOfTypeWithUnreads($user_id, $type){
        LogIt("get posts of type with unreads");

	    /*******************
	    Tried the eloquent way, the SQL was awful, and the 
	    return was total bloat 
	    ******************/
	    // TODO need to chunk this in groups of ~50?? 100??
	    $sql = Post::selectSQL();
	    $sql .= "from posts p ";
        $sql .= "inner join user_posts up ON p.id = up.post_id and up.type = '$type' ";

        $sql .= "left join user_posts up2 ON p.id = up2.post_id and up2.type = 'U'";
        $sql .= " where p.status = 'A' and p.deleted_at IS NULL ";

        LogIt("this is sql $sql");

	    $posts = DB::select($sql);

        LogIt("got posts count " . count($posts));

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
