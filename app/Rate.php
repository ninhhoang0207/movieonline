<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    //
     protected $table = 'rating';
     protected $fillable = ['users_id', 'films_id','point'];
}
