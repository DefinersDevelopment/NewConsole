<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Logging;
use App\Helpers\Misc;
use App\Models\Post;

class AdminController extends Controller
{
    //
    public function showForm($formType) {

    	switch ($formType) {
	    
		    case 'article':

		    	$returnVal = new \stdClass;
    			$returnVal->error = 0;
    			$returnVal->data = View::make('forms.article')->render();
    			return json_encode($returnVal);
		        break;
		}
    	

    }
/*****************************************

Simple Function. Takes input all in one 
from ajax call in "formData"
makes an array
validates
returns if errors
makes a post, fills it, saves it.

***************************************/
    public function savePost(Request $r) {
    	$returnVal = new \stdClass;

    	LogIt('savePost','start');
    	$inputs = ($r->input('formData'));
    	$data;
    	$cats;
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

    	$post = new Post;
  		$post->fill($data);

  		unset($data);
    	// validate

    	$errors = $post->validate();
    	// at least one category is required
    	if (!isset($cats) || count($cats) < 1){
    		$errors['category'] = 'At least one category is required';		
    	}   	
 
    	if (isset($errors) && count($errors) > 0){
    		$returnVal->error = 1;
    		$returnVal->data = View::make('forms.article',['post'=>$post,'theErrors'=>$errors])->render();
    		return json_encode($returnVal);
    	}


    	try {
	    	
	    	$post->save();
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
    		$returnVal->data = View::make('forms.article',['post'=>$post,'theErrors'=>$errors])->render();
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
    		$returnVal->data = View::make('forms.article',['post'=>$post,'theErrors'=>$errors])->render();
    		return json_encode($returnVal);
        }

    	
    	$errors['topMessage'] = 'Post Created/Updated as Post ID ' . $post->id;
    	LogIt('Post Created as Post ID ' . $post->id, 'end');
    	$returnVal->error = 0;
    	$returnVal->data = View::make('forms.article',['post'=>$post,'theErrors'=>$errors])->render();
    	//$returnVal->data = print_r($data,TRUE);
    	return json_encode($returnVal);
	
    }




}
