<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\View;

class MasterController extends Controller
{
    public function index() {
    	return view("layouts.threeColumn");
    }

    public function browseByCategory($cat_id){

    	// TODO should i check if this cat is valid

    	$posts = Post::getByCategory($cat_id);

    	return view("layouts.threeColumn", ['posts'=>$posts]);

    }
    
    public function getMiddleByCat($cat_id){

    	// TODO wrap in try catch?? not a ton could go wrong
    	// but......
    	$posts = Post::getByCategoryWithFavAndUnreads($cat_id,1,50,null);
    	LogIt(' did we get posts ' . print_r($posts,true));
    	$returnVal = new \stdClass;

    	$returnVal->error = 0;
    	 
    	$returnVal->data = View::make('middle-column.entries')->with(['posts'=>$posts])->render();

    	return json_encode($returnVal);

    }

    public function getPost($post_id){

    	// TODO wrap in try catch?? not a ton could go wrong
    	// but......
    	$post = Post::getPost($post_id);    	
    	$returnVal = new \stdClass;

    	$returnVal->error = 0;
    	$returnVal->postId = $post->id; 

    	$returnVal->data = View::make('right-column.mainContent')->with(['post'=>$post])->render();

    	return json_encode($returnVal);

    }

    public function getFavorites(){
    	LogIt(' getting favorites ') ;
    	// TODO do not hard code user
    	$user_id = 1;

    	$posts = Post::getUserPosts($user_id, 'F');
    	$returnVal = new \stdClass;
    	$returnVal->error = 0;
    	 
    	$returnVal->data = View::make('middle-column.entries')->with(['posts'=>$posts])->render();

    	return json_encode($returnVal);
    }
 
}
