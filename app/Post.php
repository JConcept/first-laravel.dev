<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Solution 1 :
    // protected $fillable = ['title', 'body'];
    
    // Solution 2 :
    protected $guarded = [];
}
