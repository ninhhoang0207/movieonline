<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //
    protected $table = 'actors';

    public function films(){
    	return $this->belongsToMany('App\Films','films_actors','films_id','actors_id');
    }

    public function country(){
    	return $this->belongsTo('App\Country','countries_id');
    }
}
