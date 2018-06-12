<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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
    	$posts = Post::getByCategory($cat_id);

    	
    	$returnVal = new \stdClass;

    	$returnVal->error = 0;
    	$returnVal->data = view('middle-column.entries',['posts'=>$posts]);

    	return json_encode($returnVal);

    }
}
