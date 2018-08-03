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
    protected $cat_ids;

     public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'category_post');
    }

    public function getCatIds(){
        if (isset($this->cat_ids)){
            
        } else {
            $cats = DB::select('select cp.category_id, c.name 
                                from category_post cp, category c 
                                where cp.post_id = ? and c.id=cp.category_id',[$this->id]);
            
            $this->cat_ids = (array)$cats;
        }
        LogIt('this is cats ' . print_r($this->cat_ids,TRUE));
        return $this->cat_ids;
    }

/*****************************
	Simple Func. Probably will not be used except maybe as admin
        b/c it does not get anything based on the user like
        favs/unreads, etc....
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
    	p.updated_at,p.created_at ';
    }


    /*********************************
    	The standard func call that will be used, 
    	returns all posts in a cat
    	WITH the user_posts info (favorite or unread currently)
    	$last_time 
    ************************/

    public static function getByCategoryWithFavAndUnreads($cat_id,$user_id,$limit,$last_time = ''){

    	LogIt('Getting cats with Fav and Unreads');
    	
    	/*
    	This can be done with eloquent relations, I am pretty sure
    	but it was more straight forward to do this IMO
    	

    	NOTE: 	I hard code this to get the favorites, then run a seperate query
    			for unreads.  I didnt want to get duplicates;
    	*/

    	$sql = Post::selectSQL() .  ' , up.type as favorite, up2.type as unread from posts p ';
        $sql .=  " inner join category_post cp on p.id = cp.post_id and cp.category_id = $cat_id ";
    	$sql .= "left join user_posts up on p.id = up.post_id and up.user_id = $user_id and up.type = 'F' ";
        $sql .= "left join user_posts up2 on p.id = up2.post_id and up2.user_id = $user_id and up2.type = 'U' and up2.category_id = $cat_id ";
    	$sql .= " where p.deleted_at IS NULL and p.status = 'A' ";
    	

    	LogIt("this is sql $sql");

    	$posts = DB::select($sql);
 
        return $posts;       
    }
/*******
This needs to use seperate select SQL b/c it needs a distinct
because it does not select on category and therefore could have 
duplicates.

The distinct might kill performance in the future

********/
    public static function getUserPostsOfTypeWithUnreads($user_id, $type){
        LogIt("get posts of type with unreads");

	    /*******************
	    Tried the eloquent way, the SQL was awful, and the 
	    return was total bloat 
	    ******************/
	    // TODO need to chunk this in groups of ~50?? 100?? for now hardcoded limit 150
	    $sql = 'select DISTINCT p.id, p.title,p.slug,p.author,p.author_bio,p.publication,p.url, p.short_description,
                p.updated_at,p.created_at, up.type as favorite, up2.type as unread ' ;
	    $sql .= " from posts p ";
        $sql .= " inner join user_posts up3 ON p.id = up3.post_id and up3.type = '$type' and up3.user_id = $user_id ";
        $sql .= " left join user_posts up ON p.id = up.post_id and up.type = 'F' and up.user_id = $user_id ";
        $sql .= " left join user_posts up2 ON p.id = up2.post_id and up2.type = 'U' and up2.user_id = $user_id ";
        $sql .= " where p.status = 'A' and p.deleted_at IS NULL LIMIT 150 ";

        LogIt("this is sql $sql");

	    $posts = DB::select($sql);

        LogIt("got posts count " . count($posts));

	    return $posts;       

	}

/**********
The function name says it all
**********/

    public static function getUnreads($user_id, $cat_id = '') {

        $sql = Post::selectSQL() .  " , ' ' as favorite, up.type as unread from posts p ";
        $sql .= " inner join user_posts up on p.id = up.post_id and up.user_id = $user_id and up.type = 'U' ";
        if ($cat_id != '') { $sql .= " and up.category_id = $cat_id "; }
        $sql .= " where p.status = 'A' and p.deleted_at IS NULL LIMIT 150";

        LogIt("this is sql $sql");

        $posts = DB::select($sql);

        LogIt("got posts count " . count($posts));

        return $posts;       

    }



    // made this a function in case we want to 

    public static function getPost($id){

    	$post = Post::with('category')->where('id', $id)->get();

        // TODO use Auth

    	return $post[0];
    }
/*
Build dynamic search query.
$filters can carry many things
terms, string of word or words
begin_date, string of a date to start search
end_date, string of a date to end a search
categories, string of one id or comma seperated IDs, can also be an array
*/
    public static function search ($filters){

        $terms = isset($filters['terms']) ? $filters['terms'] : '';
        
        LogIt('post search terms ' . print_r($terms, TRUE));

        $terms = trim($terms);

        if ($terms != ''){

            // $termArray = preg_split('=\s=', $terms);

            // LogIt("post search terms \n" . print_r($termArray, TRUE));

            $where = ' where 1=1 ';
            /*
            If we only have one term, do like %term% searches
            on the columns other than body
            */
            
            $like_phrase = "like '%" . $terms . "%' ";

            $where .= " and (p.title $like_phrase or p.author $like_phrase or p.author_bio $like_phrase or p.publication $like_phrase or p.short_description $like_phrase or match (body) against ('$terms') ) ";

            

        } // END if we had at least one term

       

        $from  = " , up.type as favorite, up2.type as unread from posts p ";
        $from .= "left join user_posts up ON p.id = up.post_id and up.type = 'F' ";
        $from .= "left join user_posts up2 ON p.id = up2.post_id and up2.type = 'U'";

        $where .= " and p.status = 'A' and p.deleted_at IS NULL order by p.updated_at";
        $sql = Post::selectSQL() . $from . $where;

         LogIt("\n search sql \n\n $sql" );
        $posts = DB::select($sql);
       

        LogIt("search got posts count " . count($posts));

        return $posts;

    }

    public static function deletePost($post_id){

        try {

            DB::table('posts')
                ->where('id', $post_id)
                ->update(['updated_at' => DB::raw('now()'), 'deleted_at'=> DB::raw('now()'), 'status'=>'D']);

        } catch(\Throwable $e) {
            LogIt("Cant Delete  Post  ".$e->getMessage());
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            throw $e;
        }
        catch(\Exception $e){
            LogIt("Cant Delete  Post  ".$e->getMessage());

            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            throw $e;
        }

        return 0;
    }
/*************
Deletes all unreads for a post, not just for a specific user
**************/

    public static function deleteUnreads($post_id) {
        try {
            LogIt("deleting unreads for post -> $post_id");

            DB::table('user_posts')->where('post_id', $post_id)->where('type','U')->delete();

        } catch(\Throwable $e) {
            LogIt("Cant update  Unreads $post_id  ".$e->getMessage());
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            throw $e;
        }
        catch(\Exception $e){
            LogIt("Cant Update  Unreads $post_id  ". $e->getMessage());

            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            throw $e;   
        }
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
