<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class MasterController extends Controller
{
    public function index() {
        // TODO do not hard code user
        $user_id = 1;

        $navCats = Category::getAllCategoriesByUser($user_id); 
       
        return view("layouts.threeColumn", ['navCats'=>$navCats, ]);
    }

    public function browseByCategory($cat_id){

        // TODO should i check if this cat is valid

        $posts = Post::getByCategory($cat_id);

        return view("layouts.threeColumn", ['posts'=>$posts]);

    }
    
    public function getMiddleByCat($cat_id){

        // TODO wrap in try catch?? not a ton could go wrong
        // but......
        $user_id = 1; // no hard code
        $posts = Post::getByCategoryWithFavAndUnreads($cat_id,$user_id,50,null);
        LogIt(' did we get posts ' . print_r($posts,true));
        $returnVal = new \stdClass;

        $returnVal->error = 0;
         
        $returnVal->data = View::make('middle-column.entries')->with(['posts'=>$posts])->render();

        return json_encode($returnVal);

    }

    public function getPost($post_id, Request $r){

        // TODO wrap in try catch?? not a ton could go wrong
        // but......
        $post = Post::getPost($post_id);        
        $returnVal = new \stdClass;

        $returnVal->error = 0;
        $returnVal->postId = $post->id;
        $returnVal->cats = $post->getCatIds();
        //TODO not hard code
        $user_id = 1;
        // remove unread
        User::deleteUserPost($user_id, $post->id, 'U');

        $returnVal->data = View::make('right-column.mainContent')->with(['post'=>$post])->render();
        //LogIt ('HEADER' . print_r($r->server(), TRUE));

        return json_encode($returnVal);

    }

    public function getFavorites(){
        LogIt(' getting favorites ', 'start') ;
        // TODO do not hard code user
        $user_id = 1;

        $posts = Post::getUserPostsOfTypeWithUnreads($user_id, 'F');
        $returnVal = new \stdClass;
        $returnVal->error = 0;
        $returnVal->data = View::make('middle-column.entries')->with(['posts'=>$posts])->render();
        LogIt(' getting favorites done ', 'end') ;
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

    public function searchPosts(Request $r){

        $returnVal = new \stdClass;
        LogIt('in master this is terms ' . $r->input('terms') );
        
        // TODO try catch
        $posts = Post::search( ['terms'=>$r->input('terms')]);
        $returnVal->error = 0; 
        $returnVal->data = View::make('middle-column.entries')->with(['posts'=>$posts])->render();

        return json_encode($returnVal);

    }

    public function licensePost($post_id){

        $user_id = 1;
        // the return object
        $returnVal = new \stdClass;

        try {

            $up = User::getUserPost($user_id,$post_id,'L');

            if (isset($up) and count($up) > 0){
                $returnVal->error = 0;
                $returnVal->data = $post_id;
                $returnVal->message = "Previously Licensed";
                return json_encode($returnVal);

            } else {

                User::setUserPost($user_id,$post_id,'L');    
            }

        } catch(\Throwable $e){
            $emsg = "ERR:: cant license post  - ".$e->getMessage();
            LogIt($emsg, 'end');
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            $returnVal->error = 1;
            $returnVal->data = $post_id;
            $returnVal->message = $emsg;
            return json_encode($returnVal);

        } catch(\Exception $e){
            $emsg = "ERR:: cant license post  - ".$e->getMessage();
            LogIt($emsg, 'end');
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            $returnVal->error = 1;
            $returnVal->data = $post_id;
            $returnVal->message = $emsg;
            return json_encode($returnVal);

        }

        $returnVal->error = 0;
        $returnVal->data = $post_id;
        $returnVal->message = "License Recorded";
        return json_encode($returnVal);


    }

    public function verifyUserForm(Request $r){

        $user = User::where('token', $r->input('V'))->get();        
        //print_r($user[0]);
        return view("forms.verifyUserForm", ['user' => $user[0]]);

    }
 
}
