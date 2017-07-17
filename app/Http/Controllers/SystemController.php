<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Like;
use App\Films;
use App\Rate;
class SystemController extends Controller
{
    public function add_list(Request $request){
    	$user_id = $request->get('user_id');
    	$film_id = $request->get('film_id');
    	$favor = Favorite::create([
    		'users_id'		=>		$user_id,
    		'films_id'	=>		$film_id,
    		]);
    }

    public function del_list(Request $request){
    	$user_id = $request->get('user_id');
    	$film_id = $request->get('film_id');
    	$favor = Favorite::where([
    			'users_id'		=>		$user_id,
    			'films_id'	=>		$film_id,
    		])->first();
    	$favor->delete();
    }

    public function add_like(Request $request){
    	$user_id = $request->get('user_id');
    	$film_id = $request->get('film_id');
    	$film = Films::find($film_id);
    	$like = $film->likes;
    	$film->likes = $like+1;
    	$film->save();
    	$favor = Like::create([
    		'users_id'		=>		$user_id,
    		'films_id'		=>		$film_id,
    		]);
    }

    public function del_like(Request $request){
    	$user_id = $request->get('user_id');
    	$film_id = $request->get('film_id');
    	$film = Films::find($film_id);
    	$like = $film->likes;
    	$film->likes = $like-1;
    	$film->save();
    	$favor = Like::where([
    			'users_id'		=>		$user_id,
    			'films_id'		=>		$film_id,
    		])->first();
    	$favor->delete();
    }

    public function rate(Request $request){
    	$user_id = $request->get('user_id');
    	$film_id = $request->get('film_id');
    	$point = $request->get('point');
    	$film = Films::find($film_id);
    	$rate = $film->rates;
    	$film->rates = $rate+1;
    	$film->save();
    	$favor = Rate::create([
    		'users_id'		=>		$user_id,
    		'films_id'		=>		$film_id,
    		'point'			=>		$point
    		]);
    }

    public function edit_rate(Request $request){
    	$user_id = $request->get('user_id');
    	$film_id = $request->get('film_id');
    	$point = $request->get('point');
    	$favor = Rate::where('users_id',$user_id)->where('films_id',$film_id)->first();
    	$favor->point = $point;
    	$favor->update();
    }
}
