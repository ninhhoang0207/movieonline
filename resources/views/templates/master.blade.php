<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="./public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./public/css/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="./public/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<script type="text/javascript" src="./public/js/jquery.min.js"></script>
	<script type="text/javascript" src="./public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./public/js/moment.min.js"></script>
	<script type="text/javascript" src="./public/js/daterangepicker.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<!-- <script type="text/javascript" src="./public/js/bootstrap.min.js"></script> -->

	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/> 
 
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
	<!-- ckeditor -->
	<script type="text/javascript" src="./public/js/ckeditor.js"></script>
	<script type="text/javascript" src="./public/js/ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="./public/js/config.js"></script>
</head>
<body>
	
	 <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
        <!--Khi responsive-->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

          </button>
          <!--chế độ deskop-->
          <a class="navbar-brand active" href="./">QUẢN TRỊ HỆ THỐNG</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Trang chủ</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quản lý phim <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="./danh-sach-phim">Danh sách phim</a></li>
                <li><a href="./upload-phim">Tải phim lên</a></li>
                <li><a href="./hangmuc-phim">Hạng mục phim</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quản lý diễn viên <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="./danhsach-dienvien">Danh sách diễn viên</a></li>
                <li><a href="./dienvien-them">Thêm diễn viên</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quản lý tin tức <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="./danh-sach-tin-tuc">Danh sách tin tức</a></li>
                <li><a href="./them-tin-tuc">Đăng tin tức mới</a></li>
              </ul>
            </li>
             <li><a href="">Thống kê</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<li></li>
            <li class="active"><a href="./">Tài khoản: Admin</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<!--<div id="menu">
		<ul>
			<li><a class="active" href="./"><i class="fa fa-home" style="font-size:40px;"></i></a></li>
			<li><a href="">Quản lý phim</a>
				<ul class="sub-menu">
					<li><a href="./upload-phim">Upload Phim</a></li>
					<li><a href="./danh-sach-phim">Danh sách Phim</a></li>
				</ul>
			</li>
			<li><a href="">Quản lý diễn viên</a></li>
			<li><a href="">Thống kê</a></li>
			<li id="user"><a href="">Xin chào: admin</a></li>
		</ul>
	</div>-->
	<div class="container" style="margin-bottom:50px;"> 
	@if (Session::has('responseData'))
			@if (Session::get('responseData')['statusCode'] == 1)
				<div class="alert alert-success">{{ Session::get('responseData')['message'] }}</div>
			@elseif (Session::get('responseData')['statusCode'] == 2)
				<div class="alert alert-danger">{{ Session::get('responseData')['message'] }}</div>
			@endif
		@endif
		@yield('content') 
	</div>
	<!-- <div id="footer" class="navbar navbar-default navbar-fixed-bottom">
		<a href=""><span class="fa fa-twitter"></span></a>
		<a href=""><span class="fa fa-facebook"></span></a>
		<a href=""><span class="fa fa-google"></span></a>
		
	</div> -->
</body>
</html>