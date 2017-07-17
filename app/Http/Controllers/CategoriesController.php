<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class CategoriesController extends Controller
{
    //
    public function index(){
    	$data = DB::table('categories')->get();
    	return view('backend.theloaiphim')->with('data',$data);
    }

    public function add(Request $request){
    	$category = $request->category;
    	if($category!=""){
    		DB::table('categories')->insert(array('type' => $category));
    		 return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 1, 
    		 	'message' => 'Thêm mới thành công!'));
    	}else{
    		 return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 
    		 	'message' => 'Thêm mới thất bại!'));
    	}
    }

    public function delete(Request $request){
    	$id = $request->id;
    	$del=DB::table('categories')->where('id',$id)->delete();
    	return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 1, 
    		 	'message' => 'Xóa thành công!'));
    }

    public function update_index(Request $request){
 		
 		$id = $request->get('tid');
    	$newname = $request->get('newname');

    	if($newname != ""){
    		DB::table('categories')->where('id',$id)->update(['type'=>$newname]);
    		 return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 1, 
    		 	'message' => 'Sửa thành công!'));
    	}else{
    		return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 
    		 	'message' => 'Tên danh mục cần thay đổi không được để trống'));
    	}
    	
    }
}
