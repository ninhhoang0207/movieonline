<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
    <link href="{{asset('public/dist/css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/style_login.css')}}">
</head>
<body>
	<div class="login">
	<div style="margin-top:120px;">
  	<div class="login-triangle"></div>
  			<h2 class="login-header">Đăng nhập vào trang WEB</h2>
  		
		  <form class="login-container" action="{{url('/login')}}" id="frm" method="POST">
		    @if(Session::has('message'))
  			<div class="btn btn-warning">{{Session::get('message')}}</div>
  		@endif
		  @if(count($errors) > 0)
  			<div class="alert alert-danger ">
  				<ul>
  					@foreach($errors->all() as $error)
  						<li>{{$error}}</li>
  					@endforeach
  				</ul>
  			</div>

  		@endif
		  	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    <p><input type="text" placeholder="Tài khoản" name="username"></p>
		    <p><input type="password" placeholder="Mật khẩu" name="password"></p>
		    <label>Nhớ</label>
		    <p><input type="submit" value="Đăng Nhâp" id="submit">
		    </p>
		  </form>

  		</div>
  		
	</div>
	<script>
			$(document).on('click','#submit',function(){
				$('#frm').submit();
			});
	</script>
</body>
</html>