<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';

	public function films(){
		return $this->belongsToMany('App\Films','films_categories','films_id','categories_id');
	}
    //
}
