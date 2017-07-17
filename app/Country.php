<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'countries';

    public function films(){
    	return $this->hasMany('App\Films','countries_id');
    }

    public function actors(){
    	return $this->hasMany('App\Actor','countries_id');
    }
}
