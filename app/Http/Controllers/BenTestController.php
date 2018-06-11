<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class BenTestController extends Controller
{
    /**
     * Create a new controller instance.
     */

    public function test()
    {

        $posts = User::getUserPosts(1,'F');

        return view('benTest', ['posts'=>$posts]);

    }
}
