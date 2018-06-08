<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class BenTestController extends Controller
{
    /**
     * Create a new controller instance.
     */

    public function test()
    {
        $posts = Post::with('category')->get();

        return view('benTest', ['posts'=>$posts]);

    }
}
