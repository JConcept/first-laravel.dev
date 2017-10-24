<?php

namespace App;

class Post extends Model
{
    // Solution 1 :
    // protected $fillable = ['title', 'body'];
    
    // Solution 2 :
    //protected $guarded = [];
    
    // Solution 3 : on crée un modèle que l'on étend pour réutiliser la récupération de données
}
