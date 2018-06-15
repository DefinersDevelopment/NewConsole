<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Logging;

class Category extends Model
{
    //
    protected $table = 'category';
    protected $children;
    protected $childrenLoaded = FALSE;

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'category_post');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public static function getAllParents(){

    	$cats = Category::where('parent_id',0)->orderBy('order','ASC')->get();
    	return $cats;

    }

    public function loadChildren(){
    	$this->children = Category::where('parent_id', $this->id)->orderBy('order','ASC')->get();
    	$this->childrenLoaded = TRUE;
    	return count($this->children);
    }

    public static function getAllCategories(){
    	$parentArray = Category::getAllParents();

    	foreach ($parentArray as $parent){
    		$parent->loadChildren();
    	}

    	return $parentArray;
    }

    public function getChildren(){

    	if ($this->childrenLoaded == FALSE){
    		$this->loadChildren();
    	}
    	
    	if (isset($this->children)){
    		return $this->children;	
    	} else {
    		return null;
    	}
    	
    }
}
