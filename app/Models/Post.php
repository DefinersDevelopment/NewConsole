<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

     public function category()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
