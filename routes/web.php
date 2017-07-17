<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'hethong', 'middleware' => ['auth','role:1']], function(){
	Route::get('/', function () {
    return view('backend.home');
	});
	//Menu quan ly phim
	Route::group(['prefix'	=> 'phim'], function(){
		Route::get('upload','FilmsController@index');
		Route::post('upload', 'FilmsController@upload');
		Route::get('danh-sach',['uses'=>'FilmsController@listfilm']);
		Route::get('sua','FilmsController@edit_index');
		Route::post('sua','FilmsController@update');
		Route::get('xoa','FilmsController@delete');
		Route::group(['prefix'=>'hang-muc'], function(){
			Route::get('','CategoriesController@index');
			Route::post('','CategoriesController@add');
			Route::get('xoa','CategoriesController@delete');
			Route::post('/hangmuc-phim/sua',['as'=>'sua','uses'=>'CategoriesController@update_index']);
		});
	});
	//Menu quan ly dien vien
	Route::group(['prefix'=>'dien-vien'], function(){
		Route::get('danh-sach',['as'=>'list.actor','uses'=>'ActorController@index']);
		Route::get('them',['uses'=>'ActorController@addActor']);
		Route::post('them',['as'=>'add.image','uses'=>'ActorController@postActor']);
		Route::get('sua',array('uses'=>'ActorController@getEdit'));
		Route::post('sua',['uses'=>'ActorController@postEdit']);
		Route::get('xoa',['uses'=>'ActorController@destroy']);
	});
	//Menu tin tuc
	Route::group(['prefix'=>'tin-tuc'], function(){
		Route::get('danh-sach','NewsController@index_list');
		Route::get('them','NewsController@index_upload');
		Route::post('them','NewsController@post_upload');
		Route::get('sua','NewsController@index_edit');
		Route::post('sua','NewsController@post_edit');
	});
});

//Trang chu
Route::group(['prefix'=>''], function(){
	Route::get('','HomesController@index_home')->name('home');
	Route::get('phim','HomesController@index_detail');
	Route::get('xem-phim','HomesController@index_movie');
	Route::get('the-loai/{type}','HomesController@index_type')->name('typeMovie');
	Route::get('quoc-gia/{country}','HomesController@index_country')->name('countryMovie');
	Route::get('phim-moi','HomesController@index_newmovie')->name('newMovies');
	Route::get('phim-le/{year}','HomesController@index_odd')->name('oddMovies');
	Route::get('phim-chieu-rap/{year}','HomesController@index_theator')->name('theatorMovies');
	Route::get('top-imdb','HomesController@index_imdb')->name('topIMDB');
	Route::get('tim-kiem','HomesController@index_search')->name('search');
	Route::get('danh-sach-phim-yeu-thich','HomesController@favor_list')->name('favorlistMovies');
	Route::get('dang-nhap','AuthController@index_login')->name('signin');
	Route::post('dang-nhap',['as'=>'dang-nhap','uses'=>'AuthController@post_login']);
	Route::get('dang-xuat','AuthController@logout')->name('signout');
});
//He thong
Route::get('add-list','SystemController@add_list');
Route::get('del-list','SystemController@del_list');
Route::get('add-like','SystemController@add_like');
Route::get('del-like','SystemController@del_like');
Route::get('rate','SystemController@rate');
Route::get('edit-rate','SystemController@edit_rate');
// Route::get('favor-list','HomeController@favor_list');

Auth::routes();
Route::get('/home', 'HomeController@index');

