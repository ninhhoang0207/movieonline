<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB, App\Films;
use App\Category;
use App\Favorite;
use App\Like;
use App\Rate;
use Session;

class HomesController extends Controller
{
    //

     public function __construct(){

       if(Session::get('data') === null)
            $this->load_data();        
     }

     public function get_data() {
        $data['theloai']=DB::table('categories')->get();
        $data['quocgia']=DB::table('countries')->get();
        $data['phimhay']=DB::table('films')->orderby('views','desc')->take(8)->get();
        $data['phimmoi']=DB::table('films')->orderby('date','desc')->take(8)->get();
        //Slide
        $slide = DB::table('films')
                        ->join('countries','countries.id','=','films.countries_id')
                        ->select('films.id','films.title','films.date','films.countries_id'
                            ,'films.image','films.directors','films.companies','films.length',
                            'films.image','films.slide','countries.name')  
                        ->orderby('films.views','desc')->take(3)->get();
        
        $actors = DB::table('films_actors')
                                ->join('actors','actors.id','=','films_actors.actors_id')
                                ->join('films','films.id','=','films_actors.films_id') 
                                ->select('actors.id','actors.name','films.id')
                                ->get();
      
        foreach ($slide as $key => $value) {
            $actor_str = "";//tao 1 xau luu ten cua cac dien vien
            for ($i=0; $i<sizeof($actors) ; $i++) { 
                # code...
                if($actors[$i]->id == $value->id){//neu dien vien co trong phim them vao xau actor_str
                    $actor_str = $actor_str." ".$actors[$i]->name.', ';
                }
            }
            if($actor_str!=""){
                $slide[$key]->actor_name = substr($actor_str,1,count($actor_str)-3);
            }else{
                $slide[$key]->actor_name = "Chưa rõ";
            }
            //Lay thong tin ve the loai phim
            $categories = Films::find($value->id)->categories()->get();
            $categories_str = "";
            
            foreach ($categories as $value) {
                $categories_str = $categories_str." ".$value->type.", ";
            }
            if($categories_str!=""){
                $slide[$key]->categories = substr($categories_str,1,count($categories_str)-3);
            }else{
                $slide[$key]->categories = "Chưa rõ";
            }                  
        }
        //Lay ra phim hanh dong
        $id_action = DB::table('categories')->where('type','Hành động')->get()[0]->id;
        // $data['hanhdong'] = DB::table('films')->orderby('views','desc')->get();
        $data['hanhdong'] = DB::table('films_categories')->where('categories_id',$id_action)
                                                        ->join('films','films.id','=','films_categories.films_id')
                                                        ->orderby('films.date')
                                                        ->paginate(8);
        //phim tinh cam              
        $id_emotion = DB::table('categories')->where('type','Tâm lý-Tình cảm')->get()[0]->id;
        $data['tinhcam'] = DB::table('films_categories')->where('categories_id',$id_emotion)
                                                        ->join('films','films.id','=','films_categories.films_id')
                                                        ->orderby('films.date')
                                                        ->get()
                                                        ->take(8);
        //phim hoat hinh
        $id_anime = DB::table('categories')->where('type','Hoạt hình')->get()[0]->id;
        $data['hoathinh'] = DB::table('films_categories')->where('categories_id',$id_anime)
                                                        ->join('films','films.id','=','films_categories.films_id')
                                                        ->orderby('films.date')
                                                        ->get()
                                                        ->take(8);
                                                        //phim hoat hinh
        $id_scient = DB::table('categories')->where('type','Khoa học-Viễn tưởng')->get()[0]->id;
        $data['khoahoc'] = DB::table('films_categories')->where('categories_id',$id_scient)
                                                        ->join('films','films.id','=','films_categories.films_id')
                                                        ->orderby('films.date')
                                                        ->get()
                                                        ->take(8);
        // print_r($data['tinhcam']);die;
        $load['data'] = $data;
        $load['slide'] = $slide;
        // $load['favor_list'] = $this->favor_list();
        // $favor_list = $this->getFavorlist();
        Session::put('data',$load['data']);
        Session::put('slide',$slide);
        return array(
            'data'  =>  $data,
            'slide' =>  $slide,
            );
     }

     public function load_data(){
        //Left side
        $data['theloai']=DB::table('categories')->get();
        $data['quocgia']=DB::table('countries')->get();
        $data['phimhay']=DB::table('films')->orderby('views','desc')->take(8)->get();
        $data['phimmoi']=DB::table('films')->orderby('date','desc')->take(8)->get();
        //Slide
        $slide = DB::table('films')
                        ->join('countries','countries.id','=','films.countries_id')
                        ->select('films.id','films.title','films.date','films.countries_id'
                            ,'films.image','films.directors','films.companies','films.length',
                            'films.image','films.slide','countries.name')  
                        ->orderby('films.views','desc')->take(3)->get();
        
        $actors = DB::table('films_actors')
                                ->join('actors','actors.id','=','films_actors.actors_id')
                                ->join('films','films.id','=','films_actors.films_id') 
                                ->select('actors.id','actors.name','films.id')
                                ->get();
      
        foreach ($slide as $key => $value) {
            $actor_str = "";//tao 1 xau luu ten cua cac dien vien
            for ($i=0; $i<sizeof($actors) ; $i++) { 
                # code...
                if($actors[$i]->id == $value->id){//neu dien vien co trong phim them vao xau actor_str
                    $actor_str = $actor_str." ".$actors[$i]->name.', ';
                }
            }
            if($actor_str!=""){
                $slide[$key]->actor_name = substr($actor_str,1,count($actor_str)-3);
            }else{
                $slide[$key]->actor_name = "Chưa rõ";
            }
            //Lay thong tin ve the loai phim
            $categories = Films::find($value->id)->categories()->get();
            $categories_str = "";
            
            foreach ($categories as $value) {
                $categories_str = $categories_str." ".$value->type.", ";
            }
            if($categories_str!=""){
                $slide[$key]->categories = substr($categories_str,1,count($categories_str)-3);
            }else{
                $slide[$key]->categories = "Chưa rõ";
            }                  
        }
        //Lay ra phim hanh dong
        $id_action = DB::table('categories')->where('type','Hành động')->get()[0]->id;
        // $data['hanhdong'] = DB::table('films')->orderby('views','desc')->get();
        $data['hanhdong'] = DB::table('films_categories')->where('categories_id',$id_action)
                                                        ->join('films','films.id','=','films_categories.films_id')
                                                        ->orderby('films.date')
                                                        ->get()
                                                        ->take(8);
        //phim tinh cam              
        $id_emotion = DB::table('categories')->where('type','Tâm lý-Tình cảm')->get()[0]->id;
        $data['tinhcam'] = DB::table('films_categories')->where('categories_id',$id_emotion)
                                                        ->join('films','films.id','=','films_categories.films_id')
                                                        ->orderby('films.date')
                                                        ->get()
                                                        ->take(8);
        //phim hoat hinh
        $id_anime = DB::table('categories')->where('type','Hoạt hình')->get()[0]->id;
        $data['hoathinh'] = DB::table('films_categories')->where('categories_id',$id_anime)
                                                        ->join('films','films.id','=','films_categories.films_id')
                                                        ->orderby('films.date')
                                                        ->get()
                                                        ->take(8);
                                                        //phim hoat hinh
        $id_scient = DB::table('categories')->where('type','Khoa học-Viễn tưởng')->get()[0]->id;
        $data['khoahoc'] = DB::table('films_categories')->where('categories_id',$id_scient)
                                                        ->join('films','films.id','=','films_categories.films_id')
                                                        ->orderby('films.date')
                                                        ->get()
                                                        ->take(8);
        // print_r($data['tinhcam']);die;
        $load['data'] = $data;
        $load['slide'] = $slide;
        // $load['favor_list'] = $this->favor_list();
        // $favor_list = $this->getFavorlist();
        Session::put('data',$load['data']);
        Session::put('slide',$slide);

        // Session::put('favor_list',$favor_list);
        
    }
    //
    public function index_home(){
        // dd($this->get_data());
        $data = $this->get_data()['data'];
        $slide = $this->get_data()['slide'];
        $favor_list = Session::get('favor_list');
        return view('fontend.trangchu')->with([
            'data'=>$data,
            'slide'=>$slide,
            'favor_list'=>$favor_list
            ]);
    }
    //

    //Danh sach phim moi
    public function index_newmovie(){
        $data = Session::get('data');
        $slide = Session::get('slide');
        $favor_list = Session::get('favor_list');
        //Phim moi
        // $demo = Session::get('data');
        $film = $data['phimmoi'];
        return view('fontend.phim-moi')->with([
                'data'      =>      $data,
                'slide'     =>      $slide,
                'film'      =>      $film,
                'favor_list'=>      $favor_list
            ]);
    }

    public function index_detail(Request $request){
        $data = Session::get('data');
        $slide = Session::get('slide');
        $favor_list = Session::get('favor_list');
        //PHim detail
        $id = $request['phim-id'];     
        $film = DB::table('films')
                        ->where('films.id',$id)
                        ->join('countries','countries.id','=','films.countries_id')
                        ->select('films.id','films.title','films.date','films.countries_id'
                            ,'films.image','films.directors','films.companies','films.length',
                            'films.image','films.views','films.content','countries.name') 
                        ->get();
        $actor = Films::find($id)->actors()->get();
        
        foreach ($film as $key => $value) {
            //Lay thong tin ve the loai phim
            $categories = Films::find($value->id)->categories()->get();
            $categories_str = "";
            
            foreach ($categories as $value) {
                $categories_str = $categories_str." ".$value->type.", ";
            }
            // $slide[$key]->categories = substr($categories_str,1,count($categories_str)-3);
            if($categories_str!=""){
                $film[$key]->categories = substr($categories_str,1,count($categories_str)-3);
            }else{
                $film[$key]->categories = "Chưa rõ";
            }                  
        }
        $point = 0;
        $film[0]->rates = 0;
        if($film[0]->rates > 0){
            $point = Rate::where('films_id',$id)->sum('point')/$film[0]->rates;
        }
        $film[0]->point = $point;

        $check['favor'] = Favorite::where('films_id',$id)->where('users_id',1)->first();
        return view ('fontend.chi-tiet-phim')->with([
                'data' =>$data,
                'slide' => $slide,
                'film'  =>  $film,
                'actor' =>  $actor,
                'favor_list' => $favor_list,
                'check'     =>     $check,
            ]);
    }
    //Trang xem phim
    public function index_movie(Request $request){
        $data = Session::get('data');
        $slide = Session::get('slide');
        $favor_list = Session::get('favor_list');
        $user_id = Session::get('user_id');
        if(Auth::check())
            $user_id = Auth::getUser()->id;
        //Phim
        $id=$request->id;
        $film = Films::find($id);
        $view = $film->views+1;
        $film->views = $view;
        $film->save();
        $check['rate'] = Rate::where('films_id',$id)->where('users_id',$user_id)->first();
        $check['favor'] = Favorite::where('users_id',$user_id)->where('films_id',$id)->first();
        $check['like'] = Like::where('users_id',$user_id)->where('films_id',$id)->first();
        // print_r($user_id);die;
       return view('fontend.xemphim')->with([
            'data'=>$data,
            'slide'=>$slide,
            'film'=>$film,
            'check'=>$check,
            'favor_list'=>$favor_list,
            'user_id' => $user_id
            ]);
    }

    public function index_theator(Request $request, $year = -1){
        $data = $this->get_data()['data'];
        $slide = $this->get_data()['slide'];
        $favor_list = Session::get('favor_list');
         //Lay ra phim chieu rap
        $film = DB::table('films')->where('type',2)->whereYear('date','=',$year)->orderby('date')->get();
        $year=$request->get('nam-sx');
       return view('fontend.phim-chieu-rap')->with([
            'data'=>$data,
            'slide'=>$slide,
            'film'=>$film,
            'year'=>$year,
            'favor_list' => $favor_list
            ]);
    }

    public function index_odd(Request $request, $year = -1){
        $data = $this->get_data()['data'];
        $slide = $this->get_data()['slide'];
        $favor_list = Session::get('favor_list');
        //Lay ra phim le
        $film = DB::table('films')->where('type',1)->whereYear('date','=',$year)->orderby('date')->get();
        
       return view('fontend.phim-le')->with([
            'data'=>$data,
            'slide'=>$slide,
            'film'=>$film,
            'year'=>$year,
            'favor_list' => $favor_list
            ]);
    }
    //Danh sach phim theo the loai
    public function index_type(Request $request, $type = -1){
        //The loai
        $id = $type;
        $page = $request->get('page');
        $film = DB::table('films_categories')->where('categories_id',$id)
                                                        ->join('films','films.id','=','films_categories.films_id')
                                                        ->join('categories','categories.id','=','films_categories.categories_id')
                                                        ->orderby('films.date')
                                                        ->paginate(4);
        if($request->ajax()){
            return view('ajax.ajax_film_type')->with('film',$film)->render();
        }
        $data = $this->get_data()['data'];
        $slide = $this->get_data()['slide'];
        $favor_list = Session::get('favor_list');
        return view('fontend.theloai')->with([
                'data'      =>      $data,
                'slide'     =>      $slide,
                'film'      =>      $film,
                'favor_list'=>      $favor_list
            ]);
        
    }
    
    public function index_country(Request $request, $country = -1){
        $data = $this->get_data()['data'];
        $slide = $this->get_data()['slide'];
        $favor_list = Session::get('favor_list');
        //Phim theo quoc gia
        $id = $country;
        $film = DB::table('films')->where('countries_id',$id)->get();
        $type = DB::table('countries')->where('id',$id)->get();
        $film[0]->type = $type[0]->name;
        // print_r($film[0]->type);die;
         return view('fontend.phim-quoc-gia')->with([
                'data'      =>      $data,
                'slide'     =>      $slide,
                'film'      =>      $film,
                'favor_list'=>      $favor_list
            ]);
        
    }
    //top phim imdb
     public function index_imdb(){
        $data = $this->get_data()['data'];
        $slide = $this->get_data()['slide'];
        $favor_list = Session::get('favor_list');
        $favor_list = $this->load_data()['favor_list'];
        $film = DB::table('films')->orderBy('imdb','desc')->take(10)->get();
        dd($film);
        return view('fontend.top-imdb')->with([
                'data'      =>      $data,
                'slide'     =>      $slide,
                'film'      =>      $film,
                'favor_list'=>      $favor_list
            ]);
    }
    //Du lieu cho trang chu
    public function index_search(Request $request){
        $film = DB::table('films')->where('title','like',"%".$request->get('search')."%")->get();
        $data = Session::get('data');
        $slide = Session::get('slide');
        $favor_list = Session::get('favor_list');
    
        return view('fontend.tim-kiem')->with([
                'data'      =>      $data,
                'slide'     =>      $slide,
                'film'      =>      $film,
                'favor_list'=>      $favor_list
            ]);
    }

    // public function getFavorlist($user_id = -1){
    //     if (Auth::check())
    //         $user_id = Auth::getUser()->id;
    //     return DB::table('films')->join('favorites','favorites.films_id','=','films.id')
    //                                 ->where('favorites.users_id',$user_id)->get();

    // }

    public function favor_list(Request $request){
        $user_id = Session::get('user_id');
        $data = Session::get('data');
        $slide = Session::get('slide');
        $favor_list=DB::table('films')->join('favorites','favorites.films_id','=','films.id')
                                    ->where('favorites.users_id',$user_id)->get()->take(16);
        $page = $request->page;
        $count =  $film = DB::table('films')->join('favorites','favorites.films_id','=','films.id')
                                    ->where('favorites.users_id',$user_id)->count();
                                    // print_r($page);die;


        if(isset($page)){
            $film = DB::table('films')->join('favorites','favorites.films_id','=','films.id')
                                                        ->where('favorites.users_id',$user_id)
                                                        ->orderby('films.date')
                                                        ->offset(($page-1)+12)
                                                        ->limit(12)
                                                        ->get();
                                                        // print_r(2);die;
        }else{
            $film = DB::table('films')->join('favorites','favorites.films_id','=','films.id')
                                    ->where('favorites.users_id',$user_id)->get()->take(12);
        }

        return view('fontend.danh-sach-phim-yeu-thich')->with([
                'data'      =>      $data,
                'slide'     =>      $slide,
                'film'      =>      $film,
                'favor_list'=>      $favor_list,
                'count'     =>      $count
            ]);
    }

    // public function favor(Request $request){
     
    // }
    // //Phan dang nhap
    // public function index_login(){
    //     return view('system.login');
    // }
}
