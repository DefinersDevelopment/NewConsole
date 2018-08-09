<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Auth;

/**
 * Class MasterController
 * @package App\Http\Controllers
 */
class MasterController extends Controller
{
    public function index() {
        
        $user_id = Auth::user()->id;

        $navCats = Category::getAllCategoriesByUser($user_id);
        // start the user off with their unreads
        $posts = Post::getUserPostsOfTypeWithUnreads($user_id, 'U');

        // TODO if we have no unreads, get *SOMETHING* to display

        LogIt('number of unreads for user in index function ' . count($posts));

        return view("layouts.threeColumn",['navCats'=>$navCats, 'posts'=>$posts]);

    }

    /**
     * @param $cat_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * this *MAY* be used if we go by URL and not an SPA Ajax based site.
     * this is currently deprecated!
     */
    public function browseByCategory($cat_id){

        // TODO should i check if this cat is valid
        // This assumes middleware has already made sure this
        // person can see this category.

        $posts = Post::getByCategory($cat_id);

        return view("layouts.threeColumn", ['posts'=>$posts]);

    }

    /**
     * @param $cat_id
     * @return string JSON obj. w/ error code and 'data' which is the HTML from the template
     */
    public function getMiddleByCat($cat_id){

        // TODO wrap in try catch?? not a ton could go wrong
        // but......
        $user_id = Auth::user()->id;
        $posts = Post::getByCategoryWithFavAndUnreads($cat_id,$user_id,50,null);
        LogIt(' did we get posts ' . print_r($posts,true));
        $returnVal = new \stdClass;

        $returnVal->error = 0;
         
        $returnVal->data = View::make('middle-column.entries')->with(['posts'=>$posts])->render();

        return json_encode($returnVal);

    }

    /**
     * @param $post_id
     * @param Request $r
     * @return string JSON; HTML of the post requested.
     * @throws \Throwable
     *
     * Gets the post requested.
     * Deletes this user's unread reacord from the user_post
     *
     * TODO this should check that the user has permissions to see this post
     * i.e. does this post belong to a category that is in user_category
     *
     */

    public function getPost($post_id, Request $r){

        // TODO wrap in try catch?? not a ton could go wrong
        // but......
        $post = Post::getPost($post_id);        
        $returnVal = new \stdClass;

        $returnVal->error = 0;
        $returnVal->postId = $post->id;
        $returnVal->cats = $post->getCatIds();
        
        $user_id = Auth::user()->id;
        // remove unread
        User::deleteUserPost($user_id, $post->id, 'U');

        $returnVal->data = View::make('right-column.mainContent')->with(['post'=>$post])->render();
        //LogIt ('HEADER' . print_r($r->server(), TRUE));

        return json_encode($returnVal);

    }

    /**
     * @return string JSON of HTML for middle col.
     */
    public function getFavorites(){
        LogIt(' getting favorites ', 'start') ;
        
        $user_id = Auth::user()->id;

        $posts = Post::getUserPostsOfTypeWithUnreads($user_id, 'F');
        $returnVal = new \stdClass;
        $returnVal->error = 0;
        $returnVal->data = View::make('middle-column.entries')->with(['posts'=>$posts])->render();
        LogIt(' getting favorites done ', 'end') ;
        return json_encode($returnVal);
    }

/************************

NEEDS 

TESTEING!
**************************/

    public function getUnreads($cat_id = ''){

        $user_id = Auth::user()->id;
        $posts = Post::getUnreads($user_id, $cat_id);
        $returnVal = new \stdClass;
        $returnVal->error = 0;
        $returnVal->data = View::make('middle-column.entries')->with(['posts'=>$posts])->render();
        LogIt(' getting favorites done ', 'end') ;
        return json_encode($returnVal);

    }



    /**
     * @param $onOff - which way to 'flip' the user favorite
     * @param $postId which post the user is flipping for
     * @return string
     *
     * If turning on, add record to user_post,
     * If turning off, delete record
     *
     */
    function toggleFavorite($onOff, $postId){
        // TODO error check that I got either 'on' or off

        // this is the obj that we will JSON for return
        $returnVal = new \stdClass;
        switch ($onOff){

            case 'on':
                // add record to DB
               
                try{
                    
                    User::setUserPost(Auth::user()->id,$postId,'F');
                
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
               
                try{
                    
                    User::deleteUserPost(Auth::user()->id,$postId,'F');

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

    /**
     * @param Request $r
     * @return string JSON of HTML of search results
     *
     * All the hard work is done in the model.
     *
     */
    public function searchPosts(Request $r){

        $returnVal = new \stdClass;
        LogIt('in master this is terms ' . $r->input('terms') );
        
        // TODO try catch
        $posts = Post::search( ['terms'=>$r->input('terms')]);
        $returnVal->error = 0; 
        $returnVal->data = View::make('middle-column.entries')->with(['posts'=>$posts])->render();

        return json_encode($returnVal);

    }

    /**
     * @param $post_id
     * @return string JSON. message of successfully licensed, or Previosuly licensed
     */
    public function licensePost($post_id){

        $user_id = Auth::user()->id;
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

    /**
     * @param Request $r
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * John wrote this funciton.
     *
     * this is what is used when we send out a e-mail for user to verify email and create
     * their own password.
     *
     */
    public function verifyUserForm($email_token, Request $r){

        $user = User::where('token', $email_token)->get();
        return view("forms.verifyUserForm", ['user' => $user[0]]);

    }

    public function verifyUser(Request $request){

        $this->validate($request, [
            'password' => 'required|confirmed|min:6|max:16',
        ]);

        $user = User::find($request->input('user_id'));
        if($user->getAttribute('id') == $request->input('user_id')) {
            //bail out, no user found or more than one user found...
            $user->setAttribute('password', Hash::make($request->input('password')));
            $user->save();
        } else {
            //TODO: Fail gracefully if something went wrong...
            return false;
        }

        return redirect('/login');

    }


    //showPost
    //Post::with('category')->where('id',$post_id)->get();
 
}
