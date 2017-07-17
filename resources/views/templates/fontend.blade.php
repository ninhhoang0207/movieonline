<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/daterangepicker.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/dataTables.bootstrap.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/fontendstyle.css')}}">
	<!-- <link rel="stylesheet" type="text/css" href="./public/css/style1.css"/> -->
	<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
	<!-- <script type="text/javascript" src="./public/js/jquery.dataTables.min.js"></script> -->
	<script type="text/javascript" src="{{asset('public/js/moment.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/js/daterangepicker.js')}}"></script>
	
	<!-- Trang chu -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/vd/css/main.css')}}"/>
	<!-- <link rel="stylesheet" type="text/css" href="./public/css/main.css"> -->
	<script src="{{asset('public/js/font-end/jquery.scrollUp.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('public/js/font-end/jquery.prettyPhoto.js')}}" type="text/javascript"></script>
	<script src="{{asset('public/js/font-end/boxOver.js')}}" type="text/javascript" ></script>

</head>
<body>
	<div id="header">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">XEM PHIM ONLINE</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="{{route('home')}}">Trang chủ</a></li>
					<li><a href="../movie/tintuc.html" target="_blank">Tin tức mới</a></li>
					<li><a href="{{route('topIMDB')}}">Top IMDB</a></li>
				</ul>
				<form class="navbar-form navbar-left" action="{{route('search')}}" method="get">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<input type="text" class="form-control" name="search" placeholder="Nhấp vào đây để tìm kiếm...">
					</div>
					<button type="submit" class="btn btn-default">Tìm kiếm</button>
				</form>
				@if(Auth::guest())
				<ul class="nav navbar-nav navbar-right">
					<li><a href=""><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
					<li><a href="{{route('signin')}}"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
				</ul>
				@else
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{route('favorlistMovies')}}"><span class="glyphicon glyphicon-star"></span> Danh sách phim yêu thích</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->username}}</a></li>
					<li>
						<a href="{{url('signout')}}"><span class="glyphicon glyphicon-log-in"></span> Đăng xuất</a>
					</li>
				</ul>
				@endif
			</div>
		</nav>
	</div>
	<nav class="navbar navbar-inverse">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="container-fluid">	
					<ul class="nav navbar-nav">
						<li><a href="{{route('newMovies')}}">Phim mới</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Thể loại
							<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php foreach ($data['theloai'] as $key => $value): ?>
										<li><a href="{{route('typeMovie',['type'=>$value->id])}}">{{$value->type}}</a></li>
									<?php endforeach ?>
								</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Quốc gia
								<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<?php foreach ($data['quocgia'] as $key => $value): ?>
									<li><a href="{{route('countryMovie',['country'=>$value->id])}}">{{$value->name}}</a></li>
								<?php endforeach ?>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Phim lẻ
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{route('oddMovies',['year'=>2010])}}">Năm 2010</a></li>
									<li><a href="{{route('oddMovies',['year'=>2011])}}">Năm 2011</a></li>
									<li><a href="{{route('oddMovies',['year'=>2012])}}">Năm 2012</a></li>
									<li><a href="{{route('oddMovies',['year'=>2013])}}">Năm 2013</a></li>
									<li><a href="{{route('oddMovies',['year'=>2014])}}">Năm 2014</a></li>
									<li><a href="{{route('oddMovies',['year'=>2015])}}">Năm 2015</a></li>
									<li><a href="{{route('oddMovies',['year'=>2016])}}">Năm 2016</a></li>
								</ul>
						</li>
						<li lass="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Phim chiếu rạp
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{route('theatorMovies',['year'=>2010])}}">Năm 2010</a></li>
									<li><a href="{{route('theatorMovies',['year'=>2011])}}">Năm 2011</a></li>
									<li><a href="{{route('theatorMovies',['year'=>2012])}}">Năm 2012</a></li>
									<li><a href="{{route('theatorMovies',['year'=>2013])}}">Năm 2013</a></li>
									<li><a href="{{route('theatorMovies',['year'=>2014])}}">Năm 2014</a></li>
									<li><a href="{{route('theatorMovies',['year'=>2015])}}">Năm 2015</a></li>
									<li><a href="{{route('theatorMovies',['year'=>2016])}}">Năm 2016</a></li>
								</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</nav>
					<!--  Slider -->
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>

						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>Phim</span></h1>
									<h2>{{$slide[0]->title}}</h2>
									<p>Đạo diễn: {{$slide[0]->directors}}</p>
									<p>Diễn viên: {{$slide[0]->actor_name}}</p>
									<p>Quốc gia: {{$slide[0]->name}}</p>
									<p>Thời lượng: {{$slide[0]->length}}</p>
									<p>Thể loại: {{$slide[0]->categories}}</p>
									<a href="phim?phim-id={{$slide[0]->id}}">
										<button type="button" class="btn btn-default get">Xem Phim</button>
									</a>
								</div>
								<div class="col-sm-6">
									<img src="{{resource_path().'/'.$slide[0]->slide}}" class="girl img-responsive" alt="" />
								</div>
							</div>
							<?php foreach ($slide as $key => $value): ?>
								@if($key != 0)
								<div class="item">
									<div class="col-sm-6">
										<h1><span>Phim</span></h1>
										<h2>{{$value->title}}</h2>
										<p>Đạo diễn: {{$value->directors}}</p>
										<p>Diễn viên: {{$value->actor_name}}</p>
										<p>Quốc gia: {{$value->name}}</p>
										<p>Thời lượng: {{$value->length}}</p>
										<p>Thể loại: {{$value->categories}}</p>
										<a href="phim?phim-id={{$value->id}}">
											<button type="button" class="btn btn-default get">Xem Phim</button>
										</a>
									</div>
									<div class="col-sm-6">
										<img src="{{resource_path().$value->slide}}"" class="girl img-responsive" alt="" />
									</div>
								</div>
								@endif
							<?php endforeach ?>

						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<!-- Left Content -->
					<div class="left-sidebar">
						<h2>PHIM HAY NHẤT</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<?php foreach ($data['phimhay'] as $key => $value): ?>
										<li><a href="phim?phim-id={{$value->id}}">
											<span class="pull-right"></span>{{$value->title}}
										</a></li>
									<?php endforeach ?>
								</ul>
							</div>

						</div><!--/category-products-->
						<!-- Phim Mới Nhất -->
						<div class="panel-group category-products" id="accordian">
							<h2>PHIM MỚI NHẤT</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<?php foreach ($data['phimmoi'] as $key => $value): ?>
										<li><a href="phim?phim-id={{$value->id}}">
											<span class="pull-right"></span>{{$value->title}}
										</a></li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>
						<h2>DANH SÁCH PHIM YÊU THÍCH</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="brands-name">
								@if(Auth::check())
								<ul class="nav nav-pills nav-stacked">
									<?php foreach ($favor_list as $key => $value): ?>
										<li><a href="phim?phim-id={{$value->films_id}}">
											<span class="pull-right"></span>{{$value->title}}
										</a></li>
									<?php endforeach ?>
								</ul>
								@else
								<ul class="nav nav-pills nav-stacked">
									<li><a href="dang-nhap">Vui lòng đăng nhập</a></li>
								</ul>
								@endif
							</div>
						</div><!--/category-products-->
					</div>
					<!-- END Content -->
				</div>
				<div id="main-content">
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>T</span>-Phim</h2>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('images/home/iframe1.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Phong cách</p>
								<h2>24 DEC 2016</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('images/home/iframe2.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Phụ nữ là số 1</p>
								<h2>24 DEC 2016</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('images/home/iframe3.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Sức khỏe</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('images/home/iframe4.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Grils</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{asset('images/home/map.png')}}" alt="" />
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>PHIM MỚI</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Phim lẻ mới </a></li>
								<li><a href="#">Phim chiếu rạp</a></li>
								<li><a href="#">Phim bộ mới </a></li>
								<li><a href="#">Phim sắp chiếu</a></li>
								<li><a href="#">Phim kinh điển</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>PHIM LẺ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Phim lẻ mới </a></li>
								<li><a href="#">Phim chiếu rạp</a></li>
								<li><a href="#">Phim bộ mới</a></li>
								<li><a href="#">Phim sắp chiếu</a></li>
								<li><a href="#">Phim kinh điển</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>PHIM BỘ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Phim lẻ mới </a></li>
								<li><a href="#">Phim chiếu rạp</a></li>
								<li><a href="#">Phim bộ mới</a></li>
								<li><a href="#">Phim sắp chiếu</a></li>
								<li><a href="#">Phim kinh điển</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>TOP 10 IMDB 2016</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Phim lẻ mới </a></li>
								<li><a href="#">Phim chiếu rạp</a></li>
								<li><a href="#">Phim bộ mới</a></li>
								<li><a href="#">Phim sắp chiếu</a></li>
								<li><a href="#">Phim kinh điển</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Liên hệ quảng cáo</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Xin vui lòng cập nhật tất cả các thông tin muốn quảng cáo cho chúng tôi!</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--  Thông tin liên hệ -->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href="#">Thông tin xin liên hệ:</a></li>
							<li><a href="#"><i class="fa fa-phone"></i> 0987654321</a></li>
							<li><a href="#"><i class="fa fa-envelope"></i> TPhim@gmail.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">                     Copyright © 2016 T-Phim Nhóm phát triển website: K58A2-ĐhKhtn</p>

				</div>
			</div>
		</div>
	</footer><!--/Footer-->
</body>
</html>