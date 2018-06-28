<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Logging;
use DB;

class Category extends Model
{
    //
    protected $table = 'category';
    protected $children;
    protected $childrenLoaded = FALSE;
    protected $fillable = ['id','name','order','parent_id','postable','unread_count'];
    public $unread_count;

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'category_post');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }


/************
Get All top level cats for a particular user 
with a particular user
Admin usage
*************/ 
    public static function getAllCatsByUserByParent($user_id, $parent_id = 0){
        $retArray = [];

        // I didnt want to take the time to figure out the Eloquent
        // way
        $cats =  DB::select("select c.id, c.name, c.order, c.parent_id, c.postable, count(up.type) as unread_count from category c 
                            left join user_posts up on c.id = up.category_id and up.user_id = ? and up.type = 'U'
                            join category_user cu on c.id = cu.category_id and cu.user_id = ?
                            and c.parent_id = ?
                            group by 1,2, 3,4,5 order by c.order ASC", [$user_id,$user_id,$parent_id]);

        // convert to a model
        foreach ($cats as $c){
            $temp = new Category;
            $temp->fill( (array) $c);
            $temp->unread_count = $c->unread_count;
            $retArray[] = $temp;
        }

        return $retArray;
    }

/************
Get All Children for this particular user 
with a particular user
Admin usage
*************/
    public function loadChildrenByUser($user_id){
        $this->children = Category::getAllCatsByUserByParent($user_id, $this->id);

        $this->childrenLoaded = TRUE;
        return count($this->children);
    }

/************
Get All top level cats regardless of relationship 
with a particular user
Admin usage
*************/

    public static function getAllParents(){

        $cats = Category::where('parent_id',0)->orderBy('order','ASC')->get();
        return $cats;

    } 
/************
Get All Children regardless of relationship 
with a particular user
Admin usage
*************/
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

    public static function getAllCategoriesByUser($user_id){
        $parentArray = Category::getAllCatsByUserByParent($user_id,0);
        
        // LogIt(print_r($parentArray,TRUE));
        // die;

        foreach ($parentArray as $parent){
            $parent->loadChildrenByUser($user_id); 
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
