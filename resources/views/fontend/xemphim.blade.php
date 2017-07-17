@extends('templates.fontend')
@section('title')
@endsection
@section('content')
	<div class="col-sm-9 padding-right">
	<!-- <header class="header dark"> -->
	<div class="features_items">
				<!-- BEGIN .video-slider -->
				<div class="video-slider">
					<!-- BEGIN .wrapper -->
					<div class="wrapper">
						<div class="slider-controls">
							<div class="video-slider-inline">
								<div class="otplayer-wrapper showcontrols">
									<video class="otplayer" preload="auto" poster="{{$film->image}}">
										<source src="{{$film->url}}" type="video/mp4">
										<div id="videofallback" style="width: 100%; height: 250px; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255); display: table; opacity: 1;"><p style="vertical-align: middle; text-align: center; display: table-cell; font: 15px/20px Arial,Helvetica,sans-serif;">Error loading player:<br> HTML5 player not found</p></div>
									</video>

									<div class="otplayer-controls">
										<div class="ot-inline-playpause"><i class="fa fa-play"></i><i class="fa fa-pause"></i></div>
										<div class="ot-inline-slider"><div></div></div>
										<div class="ot-inline-time">00:00</div>
										<div class="ot-inline-volume-controls">
											<div class="ot-inline-volume">
												<i class="fa fa-volume-up"></i>
												<i class="fa fa-volume-off"></i>
											</div>
											<div class="ot-inline-volume-slider"><div></div></div>
										</div>
										<div class="ot-inline-fullscreen"><i class="fa fa-desktop"></i></div>
									</div>
								</div>

							</div>
						</div>
						<div class="video-slider-meta">
							<div class="video-slider-info right">
								<input type="hidden" id="user_id" value="{{$user_id}}">
								<!-- <button class="btn btn-info"><i class="fa fa-thumbs-up"></i> <strong>283</strong>Thích</button> -->
								@if(!isset($check['like']))
								<button class="btn btn-info" id="like" value="0">
									<i class="fa fa-thumbs-up"></i><a id="thich" style="color:white"> Thích</a>
								</button>
								@else
								<button class="btn btn-info" id="like" value="1">
									<i class="fa fa-thumbs-up"></i><a id="thich" style="color:white"> Đã thích</a>
								</button>
								@endif
								<!-- <a href="#" class="meta-click"><i class="fa fa-thumbs-up"></i> <strong>283</strong>Thích</a> -->
								<!-- <a href="p#" class="meta-click"><i class="fa fa-plus"></i>Thêm vào danh sách</a> -->
								@if(!isset($check['favor']))
								<button class="btn btn-info" id="add-list" value="0">
									<i class="fa fa-plus"></i><a id="dsach" style="color:white"> Thêm vào danh sách yêu thích</a>
								</button>
								@else
								<button class="btn btn-info" id="add-list" value="1">
									<i class="fa fa-plus"></i><a id="dsach" style="color:white"> Đã thêm vào danh sách yêu thích</a>
								</button>
								@endif
								@if(!isset($check['rate']))
								<button class="btn btn-info" id="rate" value="0" data-toggle="modal" data-target="#myModal">
									<i class="fa fa-heart"></i><a id="danhgia" style="color:white"> Đánh giá phim</a>
								</button>
								@else
								<button class="btn btn-info" id="rate" value="1" data-toggle="modal" data-target="#myModal">
									<i class="fa fa-heart"></i><a id="danhgia" style="color:white"> Bạn đã đánh giá phim: {{$check['rate']->point}}/5 điểm</a>
								</button>
								@endif
								<a href="p#" class="meta-click"><i class="fa fa-eye"></i> <strong>{{$film->views}}</strong>Lượt xem</a>
							</div>
							<h3><a href="#">{{$film->title}}</a></h3>
							<div id="rate-body"></div>
						</div>
					<!-- END .wrapper -->
					</div>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Đánh giá phim</h4>
				      </div>
				      <div class="modal-body">
				        <div class="form-group" >
				        	<label>Điểm: </label>
							<label class="fomr-control">1</label>
							<input type="radio" name="point" checked="" value="1">
							<label class="fomr-control">2</label>
							<input type="radio" name="point" value="2">
							<label class="fomr-control" >3</label>
							<input type="radio" name="point" value="3">
							<label class="fomr-control">4</label>
							<input type="radio" name="point" value="4">
							<label class="fomr-control">5</label>
							<input type="radio" name="point" value="5">
						</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				        <button type="button" class="btn btn-info" id="rate-comfirm">Xác nhận</button>
				      </div>
				    </div>
				  </div>
				</div>
	<!-- </header> -->
	</div>
	</div>
	<!-- END Center -->
	<script type="text/javascript" src="./public/jscript/theme-scripts.js"></script>
	<script type="text/javascript" src="./public/jscript/jwplayer.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//Xu ly nut them vao danh sach
			@if(Auth::check())
			var user_id = {{Auth::getUser()->id}};
			@else
			var user_id = '';
			@endif
			$("#add-list").click(function(){
				var film_id = {{$film->id}};
				var value = document.getElementById('add-list').value;
				if(value == 0){
					if(user_id == ''){
						alert("Bạn phải đăng nhập để thực hiện chức năng này")
					}else{
						$.get("add-list",{user_id:user_id,film_id:film_id},function(data){
							document.getElementById('dsach').innerText = ' Đã thêm vào danh sách yêu thích';
							document.getElementById('add-list').value = '1';
						})
					}
				}else{
					$.get("del-list",{user_id:user_id,film_id:film_id},function(data){
						document.getElementById('dsach').innerText = ' Thêm vào danh sách yêu thích';
						document.getElementById('add-list').value = '0';
					})
				}
			});
			//Xu ly nut like
			$("#like").click(function(){
				var film_id = {{$film->id}};
				var value = document.getElementById('like').value;
				if(value == 0){
					if(user_id == ''){
						alert("Bạn phải đăng nhập để thực hiện chức năng này");
					}else{
						$.get("add-like",{user_id:user_id,film_id:film_id},function(data){
							document.getElementById('thich').innerText = 'Đã thích';
							document.getElementById('like').value = '1';
						});
					}
				}else{
					$.get("del-like",{user_id:user_id,film_id:film_id},function(data){
						document.getElementById('thich').innerText = 'Thích';
						document.getElementById('like').value = '0';
					})
				}
			});
			//Xu ly nut danh gia
			$("#rate-comfirm").click(function(){
				var film_id = {{$film->id}};
				var value = document.getElementById('rate').value;
				var point = $("input[type='radio'][name='point']:checked").val();
				if(value == 0){
					if(user_id == ''){
						alert("Bạn phải đăng nhập để thực hiện chức năng này");
					}else{
						$.get("rate",{user_id:user_id,film_id:film_id,point:point},function(data){
						});
						$("[data-dismiss=modal]").trigger({ type: "click" });
						alert("Thành công! Bạn đã đánh giá bộ phim này "+point+" điểm");
						document.getElementById('rate').value = '1';
						document.getElementById('danhgia').innerText = 'Bạn đã đánh giá bộ phim: '+point+'/5 điểm';
					}
				}else{
					$.get("edit-rate",{user_id:user_id,film_id:film_id,point:point},function(data){
						$("[data-dismiss=modal]").trigger({ type: "click" });
						alert("Thành công! Bạn đã đánh giá bộ phim: "+point+" điểm");
						document.getElementById('danhgia').innerText = 'Bạn đã đánh giá bộ phim: '+point+'/5 điểm';
					})
				}
			});
		});
	</script>
@endsection