<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\News;
use Carbon\Carbon;
use File;

class NewsController extends Controller
{
    //
    public function index_upload(){
    	return view('backend.news');
    }
    //
    public function post_upload(Request $request){
    	$user_id = 1;
    	$urlimg="";
    	$imgs = $request->file('img');

            if(isset($imgs)){
                
                    $ext = $imgs->getClientOriginalExtension();
                    $imgName = $user_id.'_'.time().'.'.$ext;
                    $path = "./resources/new_imgs";
                    $upload = $imgs->move($path, $imgName);
                    $urlimg = $path.'/'.$imgName;
              
            }
        $news = News::create([
    		'title'		=>		$request->title,
    		'composer'	=>		$request->composer,
    		'content'	=>		$request->editor1,
    		'img'		=>		$urlimg
    		]);

        if(isset($news)){
        	return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 1, 'message' => 'Thao tác thành công'));
        }else{
        	return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Thất bại'));
        }
    }

    public function index_list () {
    	$data = News::all();
    	return view ('backend.news_list')->with('data',$data);
    }

    public function index_edit (Request $request) {
    	$id = $request->id;
    	$data = News::find($id);
    	return view ('backend.news_edit')->with('data',$data);
    }

    public function post_edit (Request $request) {
    	$user_id = 1;
    	$id = $request->id;
    	$urlimg=DB::table('news')->where('id',$id)->get()[0]->img;
    	$imgs = $request->file('img');
            if(isset($imgs)){
                	
                    $ext = $imgs->getClientOriginalExtension();
                    $imgName = $user_id.'_'.time().'.'.$ext;
                    $path = "./resources/new_imgs";
                     File::delete($urlimg);
                    $upload = $imgs->move($path, $imgName);
                    $urlimg = $path.'/'.$imgName;
            }
        $news = News::find($id);
        $news->title = $request->title;
        $news->composer = $request->composer;
        $news->content = $request->editor1;
        $news->img = $urlimg;
        $data = array([
    		'title'		=>		$request->title,
    		'composer'	=>		$request->composer,
    		'content'	=>		$request->editor1,
    		'img'		=>		$urlimg
    		]);
        $news = $news->save();
        if(isset($news)){
        	return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 1, 'message' => 'Thao tác thành công'));
        }else{
        	return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Thất bại'));
        }
    }
}
