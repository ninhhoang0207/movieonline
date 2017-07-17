<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Session;
use File;
use App\User;
use App\Comment;
use App\Films;
use App\Country;
use App\Category;
use Storage;

class FilmsController extends Controller
{

      public function listfilm(){
        $data = DB::table('films')
                        ->join('countries','countries.id','=','films.countries_id')
                        ->select('films.id','films.title','films.date','films.countries_id'
                            ,'films.image','films.views','countries.name')  
                        ->get();
        
        $actors = DB::table('films_actors')
                                ->join('actors','actors.id','=','films_actors.actors_id')
                                ->join('films','films.id','=','films_actors.films_id') 
                                ->select('actors.id','actors.name','films.id')
                                ->get();
       // print_r($data);die;
        foreach ($data as $key => $value) {
            $actor_str = "";//tao 1 xau luu ten cua cac dien vien
            for ($i=0; $i<sizeof($actors) ; $i++) { 
                # code...
                if($actors[$i]->id == $value->id){//neu dien vien co trong phim them vao xau actor_str
                    $actor_str = $actor_str." ".$actors[$i]->name.';';
                }
            }
            $data[$key]->actor_name = $actor_str;
            //Lay thong tin ve the loai phim
            $categories = Films::find($value->id)->categories()->get();
            $categories_str = "";
            
            foreach ($categories as $value) {
                $categories_str = $categories_str." ".$value->type."; ";
            }
            $data[$key]->categories = $categories_str;                     
        }
        return view('backend.films_lists')->with('data',$data);                          
    }

    public function edit_index(Request $requests){
        $id = $requests->get('id');
        $data = DB::table('films')->where('id',$id)->get();
        $countries = DB::table('countries')->get();
        $categories = DB::table('categories')->get();
        $categories_id = DB::table('films_categories')
                        ->select('categories_id')->where('films_id',$id)->get();
        $actors = DB::table('actors')
                            ->join('countries','countries.id','=','actors.countries_id')
                            ->select('actors.id as id','actors.name as name','actors.image as image','countries.name as countries')
                            ->get();
        $actors_id = Films::find($id)->actors()->select('actors_id')->get();
        
        $data[0]->countries = $countries;
        $data[0]->categories = $categories;
        $data[0]->categories_id = $categories_id;
        $data[0]->actors = $actors;
        $data[0]->actors_id = $actors_id;
        //print_r($data[0]->);die;
        return view('backend.film_edit1')->with('data',$data[0]);
    }


    public function update(Request $requests){
        $id = $requests->id;
        $user_id = 1;
        $film = Films::find($id);
        $prev_data=DB::table('films')->select('url','image','trailer')->where('id',$id)->get();
        $val = Validator::make($requests->all(),[
                'title'     =>  'required|max:255',
                            ]);
        if($val->fails()){
            return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Vui lòng nhập đầy đủ thông tin.'));
        }else{
            
            $data = array(
                    'title'     =>  $requests->get('title'),
                    'content'   =>  $requests->get('content'),
                    'length'    =>  $requests->get('length'),
                    'imdb'      =>  $requests->get('imdb'),
                    'companies' =>  $requests->get('companies'),
                    'directors' =>  $requests->get('directors'),
                    'quality'   =>  $requests->get('quality'),
                    'countries_id'=>$requests->get('countries_id'),
                    'type'      => $requests->get('kinda'),
                    'date'      =>  $requests->get('date'),
                    'type'      =>  $requests->get('kinda'),
                    'updated_at'=>  new \DateTime(),
                );
              //them du lieu vao bang films_actors
            if ($requests->hasFile('image') ) {
                $file = $requests->file('image');
                $ext = $file->getClientOriginalExtension();
                    $imgName = $id.'_'.time().'.'.$ext;
                    $path = "./resources/film_imgs";
                    $upload = $file->move($path, $imgName);
                    if(File::exists($prev_data[0]->image))
                        File::delete($prev_data[0]->image);
                    $data['image'] = $path.'/'.$imgName;
                    if(!$upload)
                        return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Can not upload Image\'s film '));
                    
            }//endif
             //them anh slide
            if ($requests->hasFile('slide') ) {
                $file = $requests->file('slide');
                $ext = $file->getClientOriginalExtension();
                    $imgName = $user_id.'_'.time().'.slide.'.$ext;
                    $path = "./resources/imgs";
                    $upload = $file->move($path, $imgName);
                    $data['slide'] = $path.'/'.$imgName;
                    if(!$upload)
                        return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Can not upload Image\'s film '));
                    
            }//endif

            if ($requests->hasFile('trailer') ) {
                $file = $requests->file('trailer');
                $ext = $file->getClientOriginalExtension();
                    $trlName = $id.'_'.time().'.'.$ext;
                    $path = "./resources/trailer_films";
                    $upload=$file->move($path, $trlName);
                    if(File::exists($prev_data[0]->trailer))
                        File::delete($prev_data[0]->trailer);
                    $data['trailer'] = $path.'/'.$trlName;
                    if(!$upload)
                        return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Can not upload Trailer\'s film '));
            }//endif
             
            if ($requests->hasFile('url') ) {
                $file = $requests->file('url');
                $ext = $file->getClientOriginalExtension();
                    $user=Session::get('users');
                    $filmName = $id.'_'.time().'.'.$ext;
                    $path = "./resources/film_videos";
                    $upload=$file->move($path, $filmName);
                     File::delete($prev_data[0]->url);
                    $data['url'] = $path.'/'.$filmName;
                    if(!$upload)
                        return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Can not upload Film '));
            }//end if

            // $imgs = $requests->file('img');
            // if(isset($imgs)){
                   
            //     DB::table('films_images')->where('films_id',$id)->delete();
            //     foreach ($imgs as $key => $value) {
            //         $ext = $value->getClientOriginalExtension();
            //         $imgName = $id.$key.'_'.time().'.'.$ext;
            //         $path = "./resources/film_images";
            //         $upload = $value->move($path, $imgName);
            //         $urlimg = $path.'/'.$imgName;
            //         DB::table('films_images')->insert(
            //             ['films_id'     =>      $id,
            //              'images'       =>      $urlimg   ]);
            //         if(!$upload)
            //             return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Can not upload Image\'s film '));
            //     }//endforeach
            // }
            //Them vao bang csdl the loai phim
            $categories=DB::table('categories')->get();
            DB::table('films_categories')->where('films_id',$id)->delete();
            foreach ($categories as $key => $value) {
                //Dieu kien kiem tra neu checked thi thuc hien
                if ($requests->get('type'.$value->id,'0')) {
                    DB::table('films_categories')->insert(
                        ['films_id' => $id,
                         'categories_id' => $value->id]
                    );
                }
            }//endforeach
            $update = DB::table('films')->where('id',$id)->update($data);
            //Lay thong tin dien vien da duoc chon
            DB::table('films_actors')->where('films_id',$id)->delete();
            $actors=DB::table('actors')->get();
            foreach ($actors as $key => $value) {
                //Dieu kien kiem tra neu checked thi thuc hien
                if ($requests->get('actor'.$value->id,'0')) {
                    DB::table('films_actors')->insert(
                        ['films_id' => $id,
                         'actors_id' => $value->id]
                    );
                }
            }//endforeach
            //Them vao bang csdl the loai phim
            $actors=DB::table('actors')->get();
            DB::table('films_actors')->where('films_id',$id)->delete();
            foreach ($actors as $key => $value) {
                //Dieu kien kiem tra neu checked thi thuc hien
                if ($requests->get('actor'.$value->id,'0')) {
                    DB::table('films_actors')->insert(
                        ['films_id' => $id,
                         'actors_id' => $value->id]
                    );
                }
            }//endforeach
            // print_r($requests->all());die;
            return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 1, 'message' => 'Thành Công'));
        }
    }

    public function delete(Request $requests){
        $id = $requests->id;
        DB::table('films')->where('id',$id)->delete();
        DB::table('films_actors')->where('films_id',$id)->delete();
        DB::table('films_categories')->where('films_id',$id)->delete();
        DB::table('films_images')->where('films_id',$id)->delete();
        return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 1, 'message' => 'Thanh cong'));
    }

    public function index(){

    	$data['countries'] = DB::table('countries')->select('id', 'name')->get();
 	
 		$data['actors'] = DB::table('actors')
 							->join('countries','countries.id','=','actors.countries_id')
 							->select('actors.id as id','actors.name as name','actors.image as image','countries.name as countries')
 							->get();
        $data['categories'] = DB::table('categories')->select('id', 'type')->get();
    	return view('backend.films_upload_demo')->with('data',$data);
    }

    public function upload(Request $requests){
        $user_id = 1;
    	$val = Validator::make($requests->all(),[
    			'title'		=>	'required|max:255',
                'image'     =>  'image|mimes:jpg,jpeg,png',
                'trailer'   =>  'file|mimetypes:video/x-flv,video/x-msvideo,video/mp4',
                'url'      =>   'required|file|mimetypes:video/x-flv,video/x-msvideo,video/mp4'
    			    		]);
      // print_r($val->Errors());die;
    	if($val->fails()){   
    		return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Cần nhập đầy đủ thông tin đánh với mục *'));  
    	}else{
    //        $user_id = Session::get('users');
            
            //Them du lieu vao bang films
            $data = array(
                    'title'     =>  $requests->get('title'),
                    'content'   =>  $requests->get('content'),
                    'length'    =>  $requests->get('length'),
                    'imdb'      =>  $requests->get('imdb'),
                    'companies' =>  $requests->get('companies'),
                    'directors' =>  $requests->get('directors'),
                    'quality'   =>  $requests->get('quality'),
                    'countries_id'=>$requests->get('countries_id'),
                    'date'      =>  $requests->get('date'),
                    'type'      =>  $requests->get('kinda'),
                    'created_at'=>  new \DateTime(),
                );
            
            //them anh
        	if ($requests->hasFile('image') ) {
	  			$file = $requests->file('image');
				$ext = $file->getClientOriginalExtension();
					$imgName = $user_id.'_'.time().'.'.$ext;
					$path = "./resources/imgs";
					$upload = $file->move($path, $imgName);
                    $data['image'] = $path.'/'.$imgName;
                    if(!$upload)
                        return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Can not upload Image\'s film '));
					
			}//endif
            //them anh slide
            if ($requests->hasFile('slide') ) {
                $file = $requests->file('slide');
                $ext = $file->getClientOriginalExtension();
                    $imgName = $user_id.'_'.time().'.slide.'.$ext;
                    $path = "./resources/imgs";
                    $upload = $file->move($path, $imgName);
                    $data['slide'] = $path.'/'.$imgName;
                    if(!$upload)
                        return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Can not upload Image\'s film '));
                    
            }//endif

    		//upload video trailer phim
            if ($requests->hasFile('trailer') ) {
                $file = $requests->file('trailer');
                $ext = $file->getClientOriginalExtension();
                    $trlName = $user_id.'_'.time().'.'.$ext;
                    $path = "./resources/trailer_films";
                    $upload=$file->move($path, $trlName);
                    $data['trailer'] = $path.'/'.$trlName;
                    if(!$upload)
                        return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Can not upload Trailer\'s film '));
            }//endif
            //Upload video phim
            // print_r($requests->file('url'));die;
            if ($requests->hasFile('url') ) {
                $file = $requests->file('url');
                $ext = $file->getClientOriginalExtension();
                    $user=Session::get('users');
                    $filmName = $user_id.'_'.time().'.'.$ext;
                    $path = "./resources/film_videos";
                    $upload=$file->move($path, $filmName);
                    $data['url'] = $path.'/'.$filmName;

                   // $disk = Storage::disk('s3');

                    //Storage::move($file, $path.$filmName);
                    if(!$upload)
                        return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Can not upload Film '));
            }//end if
            
            DB::table('films')->insert($data);
            $film_id = DB::getPdo()->lastInsertId();

            //Lay thong tin dien vien da duoc chon
            $actors=DB::table('actors')->get();
            foreach ($actors as $key => $value) {
                //Dieu kien kiem tra neu checked thi thuc hien
                if ($requests->get('actor'.$value->id,'0')) {
                    DB::table('films_actors')->insert(
                        ['films_id' => $film_id,
                         'actors_id' => $value->id]
                    );
                }
            }//endforeach
            //them anh
            // $imgs = $requests->file('img');

            // if(isset($imgs)){
            //     foreach ($imgs as $key => $value) {
            //         $ext = $value->getClientOriginalExtension();
            //         $imgName = $user_id.$key.'_'.time().'.'.$ext;
            //         $path = "./resources/film_images";
            //         $upload = $value->move($path, $imgName);
            //         $urlimg = $path.'/'.$imgName;
            //         DB::table('films_images')->insert(
            //             ['films_id'     =>      $film_id,
            //              'images'       =>      $urlimg   ]);
            //         if(!$upload)
            //             return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Can not upload Image\'s film '));
            //     }//endforeach
            // }
            //Them vao bang csdl the loai phim
            $categories=DB::table('categories')->get();
            foreach ($categories as $key => $value) {
                //Dieu kien kiem tra neu checked thi thuc hien
                if ($requests->get('type'.$value->id,'0')) {
                    DB::table('films_categories')->insert(
                        ['films_id' => $film_id,
                         'categories_id' => $value->id]
                    );
                }
            }//endforeach
           return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 1, 'message' => 'Success'));  
        }
    }
}
