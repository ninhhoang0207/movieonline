@extends('templates.fontend')
@section('title')
@endsection
@section('content')

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="fa fa-film"> Top IMDB</h2>
				
						<?php foreach ($film as $key => $value): ?>
							<!-- phim -->
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
											<div class="productinfo text-center" >
												<img src="{{$value->image}}" alt="" />
												<p>{{$value->title}}</p>
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
						<!-- END PHIM -->
					</div>
					<div class="pagination-area">
							<h3><b>Trang</b></h3>
							<ul class="pagination">
								<?php $i = 2 ?>
								<?php $count = count($film)-16 ?>
								<li><a href="" class="active">1</a></li>
								<?php while($count > 0){?>
								<li><a href="phim-the-loai?the-loai-id={{$value->id}}&page={{$i}}">{{$i}}</a></li>
								{{$i++}}
								{{$count-=16}}
								<?php }?>
							</ul>
					</div>
					<!--End Phim Tinh Cam-->
					
@endsection