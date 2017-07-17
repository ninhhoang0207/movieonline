@extends('templates.fontend')
@section('title')
TRANG CHỦ
@endsection
@section('content')
	<!-- Center -->
	
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="fa fa-film"> Phim Hành Động</h2>
						<?php foreach ($data['hanhdong'] as $key => $value): ?>
						<!-- phim -->
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{resource_path().'/movie/'.$value->image}}" alt=""  />
											<p>{{$value->title}}<br></p>

										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<a href="phim?phim-id={{$value->id}}" class="btn btn-default add-to-cart"><i class="fa fa-play-circle"></i>Xem Phim</a>
											</div>
										</div>
								</div>
							</div>
						</div>
						<?php endforeach ?>
					</div>
					<div class="pagination-area">
						<ul class="pagination">
							<li ><a href="the-loai?the-loai-id=1">Xem thêm <i class="fa fa-angle-double-right"></i></a></li>
						</ul>
					</div>
					<!--End Phim Hành động-->
					

					<div class="category-tab"><!--Phim-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#phimtinhcam" data-toggle="tab">Phim Tình Cảm</a></li>
								<li><a href="#phimhoathinh" data-toggle="tab">Phim Hoạt hình</a></li>
								<li><a href="#phimkhoahoc" data-toggle="tab">Phim Khoa học-viễn tưởng</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="phimtinhcam" >
								<?php foreach ($data['tinhcam'] as $key => $value): ?>
								<!-- Phim -->
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<a href="phim?phim-id={{$value->id}}" title="header=[{{$value->title}}] body=[&nbsp;]"><img src="{{$value->image}}" alt="Laptop"/></a>
												<p>{{$value->title}}</p>
												<a href="phim?phim-id={{$value->id}}"  class="btn btn-default add-to-cart"><i class="fa fa-"></i>Xem phim</a>
											</div>
											
										</div>
									</div>
								</div>
								<?php endforeach ?>
							</div>
							<!-- End phim tinh cam -->
							<!-- Phim hoat hinh -->
							<div class="tab-pane fade" id="phimhoathinh" >
								<?php foreach ($data['hoathinh'] as $key => $value): ?>
								<!-- Phim -->
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<a href="phim?phim-id={{$value->id}}" title="header=[{{$value->title}}] body=[&nbsp;]"><img src="{{$value->image}}" alt="Hình ảnh"/></a>
												<p>{{$value->title}}</p>
												<a href="phim?phim-id={{$value->id}}" class="btn btn-default add-to-cart"><i class="fa fa-"></i>Xem phim</a>
											</div>
											
										</div>
									</div>
								</div>
								<?php endforeach ?>
							</div>
							<!-- End phim hoat hinh -->
							<!-- Phim hoat hinh -->
							<div class="tab-pane fade" id="phimkhoahoc" >
								<?php foreach ($data['khoahoc'] as $key => $value): ?>
								<!-- Phim -->
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<a href="phim?phim-id={{$slide[0]->id}}" title="header=[{{$value->title}}] body=[&nbsp;]"><img src="{{$value->image}}" alt="Hình ảnh"/></a>
												<p>{{$value->title}}</p>
												<a href="phim?phim-id={{$slide[0]->id}}" class="btn btn-default add-to-cart"><i class="fa fa-"></i>Xem phim</a>
											</div>
										</div>
									</div>
								</div>
								<?php endforeach ?>
							<!-- End phim hoat hinh -->
							</div>
						</div>
					</div>
					<!--End Phim-tab-->



					
					<div class="recommended_items"><!--Slider_items-->
						<h2 class="fa fa-film"> Phim Đặc Sắc</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<?php foreach ($data['phimhay'] as $key => $value): ?>
									<!-- phim -->
									@if($key < 4)
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
													<div class="productinfo text-center">
														<a href="phim?phim-id={{$value->id}}" title="header=[{{$value->title}}] body=[&nbsp;]"><img class="hovereffect" src="{{$value->image}}" alt="Laptop"/></a>
														<div class="movie-carousel-top-item-meta"  >
														<a href="phim?phim-id={{$value->id}}" class="btn btn-default add-to-cart"><i class="fa fa-play-circle center"></i></a>
														</div>
													</div>
											</div>
										</div>
									</div>
									@endif
									<?php endforeach ?>
								</div>
								<div class="item">
								<?php foreach ($data['phimhay'] as $key => $value): ?>
									<!-- phim -->
									@if($key >= 4)
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
													<div class="productinfo text-center">
														<a href="phim?phim-id={{$value->id}}" title="header=[{{$value->title}}] body=[&nbsp;]"><img class="hovereffect" src="{{$value->image}}" alt="Laptop"/></a>
														<div class="movie-carousel-top-item-meta"  >
														<a href="phim?phim-id={{$value->id}}" class="btn btn-default add-to-cart"><i class="fa fa-play-circle center"></i></a>
														</div>
													</div>
											</div>
										</div>
									</div>
									@endif
									<?php endforeach ?>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--End Slider_items-->
					
				</div>

			<!-- End Center -->

@endsection