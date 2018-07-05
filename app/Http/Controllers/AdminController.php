<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Logging;
use App\Helpers\Misc;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\TidTracking;
use Auth;
//use DB;

class AdminController extends Controller
{

    //
    public function showForm($formType) {

    	switch ($formType) {
	    
		    case 'article':
		    	$allCats = Category::getAllCategories();
		    	$returnVal = new \stdClass;
    			$returnVal->error = 0;
    			$returnVal->data = View::make('forms.article', ['allCats'=>$allCats, 'bentest'=>'testing'])->render();
    			return json_encode($returnVal);
		        break;
		}
    	

    }
/*****************************************

Fairly Simple Function. 
Takes input all in one data element
from ajax call in "formData" (made by jquery searializeArray() )
makes a hash
validates data 
returns if errors
makes a post object, fills it, saves it, save category relations


***************************************/
    public function savePost(Request $r) {
    	
        LogIt('savePost','start');

        // this is the obj that we will
        // JSON and return
        $returnVal = new \stdClass;

    	$inputs = ($r->input('formData'));
    	$data;
    	$cats = []; // empty but set.
        
    	// parse data from ajax call,
    	// we have post data and category data
    	foreach ($inputs as $i){
    		if ($i['name'] == 'category'){
    			$cats[] = $i['value'];
    		} else {
    			$data[$i['name']] = $i['value'];
    		}
    	}
        
        // TODO not hard code
		$data['user_id_created'] = Auth::user()->id;
    	$data['status'] = 'A';
    	$data['slug'] = makeSlug($data['title']);

        $isUpdate = FALSE;
    	// If this is an update, get the old post
    	if (isset($data['id']) && $data['id'] != ''){
    		$post = Post::find($data['id']);
            $isUpdate = TRUE;
    	} else { // or create a new one.
    		$post = new Post;	
    	}

  		$post->fill($data);

  		unset($data);

  		// validate
    	$errors = $post->validate();
    	// at least one category is required
    	if (!isset($cats) || count($cats) < 1){
    		$errors['category'] = 'At least one category is required';		
    	}   	
 
    	/***
    	The function could return (error or success) from here down
    	and when it does, it needs all the categories for 
    	display purposes
    	***/
    	// returns a "tree" of categories, parents on top
    	// each parent contains their children
    	$allCats = Category::getAllCategories();
    	
    	if (isset($errors) && count($errors) > 0){
    		$returnVal->error = 1;
            $returnVal->message = 'There were errors during submission.';
    		$returnVal->data = View::make('forms.article',['post'=>$post,'theErrors'=>$errors, 
    			'postCats'=>$cats, 'allCats'=>$allCats])->render();
    		return json_encode($returnVal);
    	}

    	try {
	    	
	    	$post->save(); // save or update

	    	// remove all cats
	    	$post->category()->detach(); 

	    	// then add new cat relations
	    	if (count($cats) > 0){
	    		$post->category()->attach($cats);
	    	}

/*******
HANDLE UNREADS
TODO:
do we want to wrap the entire create in transaction and roll back if unreads fail??
********/

            if ($isUpdate == TRUE){
                    // delete all the previous unread entries for this
                    // post
                    Post::deleteUnreads($post->id);
            }

            // get ALL the users who 'subscribe' to ALL the 
            // categories of this post
            foreach ($cats as $cat){
                LogIt("Cat loop $cat");
                foreach (User::getUsersWithCategory($cat) as $user_id){ // each user subscribed to cat
                    // TODO catch errors!
                    User::setUserPost($user_id, $post->id, 'U', $cat); // add unread
                }
                
            }
        

	    }
        catch(\Throwable $e){
            LogIt("ERR:: Cant Create Post In Post Table - ".$e->getMessage(), 'end');
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            $errors['topMessage'] = "Error " . $e->getMessage();
            $returnVal->error = 1;
            $returnVal->message = 'There were errors during submission.';
    		$returnVal->data = View::make('forms.article',['post'=>$post,
    			'theErrors'=>$errors, 'postCats'=>$cats, 'allCats'=>$allCats])->render();
    		return json_encode($returnVal);
        }
        catch(\Exception $e)
        {
            LogIt("ERR:: Cant Create Post In Post Table - ".$e->getMessage(), 'end');
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            $errors['topMessage'] = "Error " . $e->getMessage();
            $returnVal->error = 1;
            $returnVal->message = 'There were errors during submission.';
    		$returnVal->data = View::make('forms.article',['post'=>$post,
    			'theErrors'=>$errors, 'postCats'=>$cats, 'allCats'=>$allCats])->render();
    		return json_encode($returnVal);
        }


        /******************
        If we are here, everything went OK
        *******************/

    	
    	$errors['topMessage'] = 'Post Created/Updated as Post ID ' . $post->id;
    	LogIt('Post Created as Post ID ' . $post->id, 'end');
    	$returnVal->error = 0;
        $returnVal->message = 'POST $post->id was Created/Updated successfully.';
    	$returnVal->data = View::make('forms.article',['post'=>$post,
    		'theErrors'=>$errors, 'postCats'=>$cats, 'allCats'=>$allCats])->render();
    	//$returnVal->data = print_r($data,TRUE);
    	return json_encode($returnVal);
	
    }

    function deletePost($post_id){

        $returnVal = new \stdClass;

        try {
            Post::deletePost($post_id);
        }

        catch(\Throwable $e){
            LogIt("Cant Delete  Post  ".$e->getMessage());
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            $returnVal->error = 1;
            $returnVal->message = 'Could not delete post';
            return json_encode($returnVal);
        }
        catch(\Exception $e){
            
            LogIt("Cant Delete  Post  ".$e->getMessage());
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            $returnVal->error = 1;
            $returnVal->message = 'Could not delete post';
            return json_encode($returnVal);
        }

        $returnVal->error = 0;
        $returnVal->message = 'Post Deleted';
        return json_encode($returnVal);
    }

    function editPost($postId){

    	$returnVal = new \stdClass;
    	$post = Post::with('category')->find($postId);
    	$postCats = [];
    	foreach ($post->category as $cat){
    		$postCats[] = $cat->id;
    	}
    	//LogIt('cats from post ' . print_r($post->category,TRUE));
    	$allCats = Category::getAllCategories();  // display
    	$returnVal->error = 0;
        $returnVal->postId = $postId;
    	$returnVal->data = View::make('forms.article',['post'=>$post, 'allCats'=>$allCats, 'postCats'=>$postCats])->render();

    	return json_encode($returnVal);

    }
/**************
The way we track the viewing of our articles
***************/

    function trackTid(Request $r){

        $temp = $r->input('t');
        $temp = explode('-',$temp);
        
        if (!isset($temp[0]) || !isset($temp[1])){
            LogIt('track tid could not get user and/or post ');
            return $this->returnImage();
        }

        $ref = $r->header('referer');
        if (!isset($ref) || $ref == ''){
            $ref = $r->header('host');
            if (!isset($ref) || $ref == ''){
                $ref='unknown';
            }
        }
        $foo = preg_match('/ardashtest/i', $ref);
        LogIt('is this is match ' . $foo);
        if ( $foo == 1){
            return $this->returnImage();

        }

        $tracker = new TidTracking;

        $tracker->user_id = $temp[0];
        $tracker->post_id = $temp[1];
        
        $ua = $r->header('user_agent');
        if (!isset($ua) || $ua == ''){
            $ua = 'unknown';
        }
        


        $tracker->user_agent = $ua;
        $tracker->referer = $ref;

        
        //echo '<br>header:<br>'; 
        //echo print_r($r->header(),TRUE);
        //echo $r->header('referer');
        $tracker->save();

        return $this->returnImage();

    }
    function returnImage(){
         return response(base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII='), 200)
                  ->header('Content-Type', 'img/png');
    }

    function makePostFromBrowserExt(Request $r){
        LogIt('fuck yeah ' . $r->input('url'));
        $returnVal = new \stdClass; 
        $returnVal->error = 0;
        $returnVal->data = "fuck yeah";
        return json_encode($returnVal);
    }




}
