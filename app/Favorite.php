<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //
    protected $table = 'favorites';
     protected $fillable = ['users_id', 'films_id'];
}
