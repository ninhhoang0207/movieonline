<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use DB;
class AuthController extends Controller
{
    //
        use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


        //Phan dang nhap
    public function index_login(){
        return view('system.dangnhap');
    }

    public function post_login(Request $request){
    	$rule = [
    		'email' => 'required|max:225',
    		'password' => 'required'
    	];

    	$msg = [
    		'email.required'	=>	'Tên đăng nhập không được để trống.',
    		'password.required'	=>	'Mật khẩu không được để trống.'
    	];

    	$validator = Validator::make($request->all(),$rule,$msg);
    	$errors = $validator->errors();
    	// print_r($errors->first('username'));die;
    	if($validator->fails()){
    		// return redirect()->back()->withErrors($validator)
      //                   ->withInput();
    		return redirect()->back()->with('errors',$errors);

    	}
    	$data = ['email' => $request->email,
    				'password' => $request->password];
        // $this->login($request);
    	if(Auth::attempt($data)) {
            $user_id = DB::table('users')->where('email',Auth::user()->email)->get()[0]->id;
            Session::put('user_id', $user_id);
            $favor_list=DB::table('films')->join('favorites','favorites.films_id','=','films.id')
                                    ->where('favorites.users_id',$user_id)->get();
            Session::set('favor_list',$favor_list);
            return redirect('/');
        }
    	return redirect()->back();
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        // print_r(Session::get('data') === null);die;
        // print_r($request->session()->all());die;
        return redirect()->back();
    }
 
}
