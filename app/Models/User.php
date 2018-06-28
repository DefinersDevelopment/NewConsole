<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Helpers\Logging;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    // public function category()
    // {
    //     return $this->belongsToMany('App\Models\Category');
    // }  

    /******************************
    NOTE on favorites and unreads (and other types in the future).
    Eloquent models can handle one M2M table defining diferent 
    relationships with the withPivot('column').  However, I found the select
    SQL a little funky, and then you get issues with query limits, etc...
    I did not look into it much, but going straight SQL for favs/unreads made
    the most sense
    *******************************/


    

    public static function setUserPost($user_id, $post_id, $type, $category_id = 0){

        try {
            DB::insert('insert into user_posts (user_id, post_id, type, category_id, created_at, updated_at) values (?, ?, ?, ?, NOW(), NOW() )', 
                [$user_id, $post_id, $type, $category_id]);
        }

        catch(\Throwable $e)
        {
            LogIt("Cant Create User Post  ".$e->getMessage());
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            throw $e;
        }
        catch(\Exception $e)
        {
            LogIt("Cant Create User Post  ".$e->getMessage());

            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            throw $e;
        }

        
    }

    public static function getUserPost($user_id, $post_id, $type){

        try {
            $up = DB::select('select user_id, post_id, type, created_at, updated_at from user_posts 
                where user_id = ? and post_id = ? and type = ?', [$user_id, $post_id, $type]);
        }

        catch(\Throwable $e)
        {
            LogIt("Cant Get User Post  ".$e->getMessage());
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            throw $e;
        }
        catch(\Exception $e)
        {
            LogIt("Cant get User Post  ".$e->getMessage());

            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            throw $e;
        }

        return $up;

        
    }

    public static function deleteUserPost($user_id, $post_id, $type){

        try {
            DB::delete('delete from user_posts where user_id = ? and post_id = ? and type = ?',[$user_id, $post_id, $type]);
        }

        catch(\Throwable $e)
        {
            LogIt("Cant Delete User Post  ".$e->getMessage());
            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            throw $e;
        }
        catch(\Exception $e)
        {
            LogIt("Cant Delete User Post  ". $e->getMessage());

            //Bugsnag::notifyException($e);
            // Bugsnag::notifyError('ALERT CREATION ERROR - Sent Back To Form', $e->getMessage(), function($report){
            //     $report->setSeverity('info');
            // });
            
            throw $e;
        }

        
    }
/**********
Get a list of users that 'subscribe' to the given 
category
***********/

    public static function getUsersWithCategory($cat_id){
        LogIt('In get users with category ' . $cat_id);  
        $returnUsers = [];
        
        $users = DB::table('category_user')->where('category_id', $cat_id)->get();

        foreach ($users as $u){
            $returnUsers[] = $u->user_id;
        }
        //LogIt('these are the users that have thiis cat ' . print_r($returnUsers, TRUE));
        return $returnUsers;
    }

}
