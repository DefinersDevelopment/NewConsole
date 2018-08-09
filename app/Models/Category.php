<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Logging;
use DB;

/**
 * Class Category
 * @package App\Models
 */
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
One of the main entry points into this Model,
this is what is called when getting the data for
the left Nav.
*********/

    public static function getAllCategoriesByUser($user_id){
        $parentArray = Category::getAllCatsByUserByParent($user_id,0);
        
        // LogIt(print_r($parentArray,TRUE));
        // die;

        foreach ($parentArray as $parent){
            LogIt('loop');
            $parent->loadChildrenByUser($user_id);
        }

        return $parentArray;
    }
/************
Get All  cats with a parent of X [default 0 or top level]
that a user has subscribed to
*************/ 
    public static function getAllCatsByUserByParent($user_id, $parent_id = 0){
        $retArray = [];
        LogIt("got called $user_id $parent_id");
        // I didnt want to take the time to figure out the Eloquent
        // way
        $cats =  DB::select("select c.id, c.name, c.order, c.parent_id, c.postable, count(up.type) as unread_count from category c 
                            left join user_posts up on c.id = up.category_id and up.user_id = ? and up.type = 'U'
                            join category_user cu on c.id = cu.category_id and cu.user_id = ?
                            and c.parent_id = ?
                            group by 1,2, 3,4,5 order by c.order ASC", [$user_id,$user_id,$parent_id]);

        LogIt(" this is some cats " . print_r($cats,TRUE));

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
Have this instance load all of its own children,
If those children are in categories the user is 
subscribed to
*************/
    public function loadChildrenByUser($user_id){
        $this->children = Category::getAllCatsByUserByParent($user_id, $this->id);
        $this->childrenLoaded = TRUE;
        return count($this->children);
    }

/************
Get All top level cats 
Does not take user_id
Admin usage ONLY
*************/

    public static function getAllParents(){

        $cats = Category::where('parent_id',0)->orderBy('order','ASC')->get();
        return $cats;

    } 

/************
Have this instance load all of its children
DOES NOT TAKE USER_ID
Admin usage ONLY
*************/
    public function loadChildren(){
    	$this->children = Category::where('parent_id', $this->id)->orderBy('order','ASC')->get();
    	$this->childrenLoaded = TRUE;
    	return count($this->children);
    }

/****************
Get all cats and have them load their children too
ADMIN ONLY
******************/
    public static function getAllCategories(){
    	$parentArray = Category::getAllParents();

    	foreach ($parentArray as $parent){
    		$parent->loadChildren();
    	}

    	return $parentArray;
    }


    public function getChildren(){
	
    	if (isset($this->children)){
    		return $this->children;	
    	} else {
    		return null;
    	}
    	
    }
}
