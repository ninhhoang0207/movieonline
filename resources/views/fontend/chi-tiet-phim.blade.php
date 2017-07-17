@extends('templates.fontend')
@section('title')
@endsection
@section('content')
	<!-- Center -->
				<div class="col-sm-9 padding-right">
					<!--product-details-->
					<div class="product-details">
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{$film[0]->image}}" alt="" />
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <?php foreach ($actor as $key => $value): ?>
										  @if($key < 3)
										  <a href="dienvien?dvien-id=?"><img src="{{$value->image}}" width="90px" height="120px" alt=""></a>
										  @endif
										  <?php endforeach ?>
										</div>
										@if(count($actor)>3)
										<div class="item">
										   <?php foreach ($actor as $key => $value): ?>
										  @if($key >= 3)
										  <a href="dienvien?dvien-id=?"><img src="{{$value->image}}" width="90px" height="120px" alt=""></a>x
										  @endif
										  <?php endforeach ?>
										</div>
										@endif
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h2>{{$film[0]->title}}</h2>
								<!-- <h3>The K2 (2016)</h3> -->
								<p><b>Đạo diễn:</b> {{$film[0]->directors}}</p>
								<p><b>Quốc gia:</b> {{$film[0]->name}}</p>
								<p><b>Thời lượng:</b> {{$film[0]->length}} phút</p>
								<p><b>Số tập:</b> 1 tập</p>
								<p><b>Thể loại:</b> {{$film[0]->categories}}</p>
								<p><b>Lượt xem:</b> {{$film[0]->views}}</p>
								<p>Đánh giá phim: {{$film[0]->point}} điểm ({{$film[0]->rates}} lượt)</p>
								<img src="" alt="" />
								 <a href="xem-phim?id={{$film[0]->id}}">
								 <span>
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-film"></i>  Xem Phim</button>
								</span>
								 </a>
							</div><!--/product-information-->
						</div>
					</div>
					<!-- END product-details-->

					<!-- Nội dung phim -->
					<div class="blog-post-area">
						<div class="single-blog-post">
							<h3>Nội Dung Phim</h3>
							<?php echo $film[0]->content ?>
						</div>
					</div><!--/blog-post-area-->


@endsection