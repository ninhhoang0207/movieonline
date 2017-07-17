@extends('templates.fontend')
@section('title')
@endsection
@section('content')
<div id="main-content" class="col-sm-9 padding-right">
	<div class="features_items"><!--features_items-->
		<h2 class="fa fa-film"> Phim {{$film[0]->type}}</h2>
		<div id="content">
			<?php foreach ($film as $key => $value): ?>
				<!-- phim -->
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center" >
								<img src="../{{$value->image}}" alt="" />
								<p>{{$value->title}}</p>
							</div>
							<div class="product-overlay">
								<div class="overlay-content">
									<a href="phim?phim-id={{$value->films_id}}" class="btn btn-default add-to-cart"><i class="fa fa-play-circle"></i>Xem Phim</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			<!-- END PHIM -->
			<div class="pagination-area">
				{{$film->links()}}
			</div>
			<!--End Phim Tinh Cam-->
			<script type="text/javascript">
				$('.pagination-area a').on('click', function (event) {
					event.preventDefault();
					if ( $(this).attr('href') != '#' ) {
						
						var url = $(this).attr('href');
						$.ajax({
							url : url,
						}).done(function(data){
							$('#content').empty();
							console.log(data);
							$('#content').append(data);
						});
					}
				});
			</script>
		</div>
	</div>
</div>
@endsection
