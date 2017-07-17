<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    //
    protected $table = 'films';
     protected $fillable = [
        'title',
    ];

    public function countries(){
    	return $this->belongsTo('App\Country','countries_id');
    }

    public function categories(){
    	return $this->belongsToMany('App\Category','films_categories','films_id','categories_id');
    }

    public function actors(){
    	return $this->belongsToMany('App\Actor','films_actors','films_id','actors_id');
    }
}
