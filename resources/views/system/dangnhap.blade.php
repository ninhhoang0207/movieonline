<!DOCTYPE html>
<html>
<head>
	<title>ĐĂNG NHẬP</title>

	<link rel="stylesheet" type="text/css" href="http://localhost/movie/public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/movie/public/css/dang-nhap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<script type="text/javascript" src="http://localhost/movie/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost/movie/public/js/bootstrap.min.js"></script>

</head>
<body>
	<!-- @if($errors->has('username')) -->
		<!-- @foreach($errors as $err) -->
			<div class="aler aler-danger">1</div>
		<!-- @endforeach -->
	<!-- @endif -->
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div id="login-background" class="col-md-6">
				<div id="login-lbl"><label><h4>ĐĂNG NHẬP</h4></label></div>
				<div id="login-form" >
					{{Form::open(['method' => 'post', 'url' => 'dang-nhap'])}}
					{{ csrf_field() }}
						<div class="col-md-2"></div>
						<div id="login-div" class="col-md-8">
							<div class="form-group">
								<input type="text" name="email" placeholder="Tên đăng nhập" class="form-control"> 
							</div>
							<div class="form-group">
								<input type="password" name="password" placeholder="Mật khẩu" class="form-control"> 
							</div>
							<div>
								<input type="checkbox" name=""> <label>Ghi nhớ</label>
								<label style="float:right">Chưa có tài khoản? <a href="">Đăng ký</a></label>
							</div>
							<br>
							<div>
								<input class="btn btn-primary" type="submit" name="" value="Đăng nhập">
								<input class="btn btn-danger" style="float:right" type="reset" name="" value="Hủy">
							</div>
						</div>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</body>
</html>