<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    // Solution 3 : on crée un modèle (qui sera étendu pour être réutilisé par ceux qui on besoin de ce système de récupération de données)
    protected $guarded = [];
}
