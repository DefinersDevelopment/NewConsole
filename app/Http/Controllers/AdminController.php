<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Logging;
use App\Helpers\Misc;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
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
        

		$data['user_id_created'] = 1;
    	$data['status'] = 'A';
    	$data['slug'] = makeSlug($data['title']);

    	// If this is an update, get the old post
    	if (isset($data['id']) && $data['id'] != ''){
    		$post = Post::find($data['id']);
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
            $returnVal->message = 'There were errors during submission.'
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

	    }catch(\Throwable $e)
        {
            LogIt("ERR:: Cant Create Post In Post Table - ".$e->getMessage(), 'end');
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            $errors['topMessage'] = "Error " . $e->getMessage();
            $returnVal->error = 1;
            $returnVal->message = 'There were errors during submission.'
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
            $returnVal->message = 'There were errors during submission.'
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
        $returnVal->message = 'POST $post->id was Created/Updated successfully.'
    	$returnVal->data = View::make('forms.article',['post'=>$post,
    		'theErrors'=>$errors, 'postCats'=>$cats, 'allCats'=>$allCats])->render();
    	//$returnVal->data = print_r($data,TRUE);
    	return json_encode($returnVal);
	
    }

    function editPost($postId){

    	$returnVal = new \stdClass;
    	$post = Post::with('category')->find($postId);
    	$postCats = [];
    	foreach ($post->category as $cat){
    		$postCats[] = $cat->id;
    	}
    	LogIt('cats from post ' . print_r($post->category,TRUE));
    	$allCats = Category::getAllCategories();  // display
    	$returnVal->error = 0;
        $returnVal->postId = $postId;
    	$returnVal->data = View::make('forms.article',['post'=>$post, 'allCats'=>$allCats, 'postCats'=>$postCats])->render();

    	return json_encode($returnVal);

    }
    /*****
    Function takes a onOff string which should be 'on' or 'off'
    and a post id.
    if on: add a record in the user_posts table
    if off: delete the record
    NOTE user_posts stores favorites as well as unreads 
    and more in the future so be careful of having the right type
    ******/
    function toggleFavorite($onOff, $postId){
        // TODO error check that I got either 'on' or off

        // this is the obj that we will JSON for return
        $returnVal = new \stdClass;
        switch ($onOff){

            case 'on':
                // add record to DB
                // TODO add real Auth::user id here
                try{
                    
                    User::setUserPost(1,$postId,'F');
                
                } catch(\Throwable $e){
                    $emsg = "ERR:: cant create favorite  - ".$e->getMessage();
                    LogIt($emsg, 'end');
                    //Bugsnag::notifyException($e);
                    // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
                    //     $report->setSeverity('info');
                    // });
                    
                    $returnVal->error = 1;
                    $returnVal->message = $emsg;
                    $returnVal->data = $postId;

                    return json_encode($returnVal);
                }
                catch(\Exception $e)
                {
                    $emsg = "ERR:: cant create favorite  - ".$e->getMessage();
                    LogIt($emsg, 'end');
                    //Bugsnag::notifyException($e);
                    // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
                    //     $report->setSeverity('info');
                    // });
                    
                    $returnVal->error = 1;
                    $returnVal->data = $postId;
                    $returnVal->message = $emsg;
                    return json_encode($returnVal);
                }

                // all went well
                $returnVal->error = 0;
                $returnVal->data = $postId;
                return json_encode($returnVal);
                
                break;
            case 'off':
                // remove record from DB
                // TODO add real Auth::user id here
                try{
                    
                    User::deleteUserPost(1,$postId,'F');

                } catch(\Throwable $e){
                    $emsg = "ERR:: cant delete favorite  - ".$e->getMessage();
                    LogIt($emsg, 'end');
                    //Bugsnag::notifyException($e);
                    // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
                    //     $report->setSeverity('info');
                    // });
                    
                    $returnVal->error = 1;
                    $returnVal->data = $postId;
                    $returnVal->message = $emsg;

                    return json_encode($returnVal);
                } catch(\Exception $e){
                    $emsg = "ERR:: cant delete favorite  - ".$e->getMessage();
                    LogIt($emsg, 'end');
                    //Bugsnag::notifyException($e);
                    // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
                    //     $report->setSeverity('info');
                    // });
                    
                    $returnVal->error = 1;
                    $returnVal->data = $postId;
                    $returnVal->message = $emsg;

                    return json_encode($returnVal);
                }

                // all went well
                $returnVal->error = 0;
                $returnVal->data = $postId;
                return json_encode($returnVal);
                break;
            
            default:
                    //error
                // all bad val for onOff
                $returnVal->error = 1;
                $returnVal->data = $postId;
                $returnVal->message = 'Bad value for onOff variable';
                return json_encode($returnVal);
                break;

        }

    }



}
