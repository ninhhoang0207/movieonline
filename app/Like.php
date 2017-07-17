<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
     protected $table = 'likes';
     protected $fillable = ['users_id', 'films_id'];
}
