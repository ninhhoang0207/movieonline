<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
     protected $fillable = [
        'content',
    ];
    public function user(){
        return $this->belongsTo('App\User','users_id');
    }
}
