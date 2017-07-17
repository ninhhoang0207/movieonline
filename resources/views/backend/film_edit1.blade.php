@extends('layouts.copy')

@section('title')
	{{$data->title}}
@endsection

@section('content')
<div class="container">
	<div class="">
		<h1 class="page-header">CHỈNH SỬA</h1>
	</div>
	<div class="section">
		<div class="row">
			{!! Form::open(['method'=>'post','files'=>true]) !!}
			<input type="hidden" name="id" value="{{$data->id}}">
			<div class="col-md-4">
				<div class="form-group">
					<label for="title">Tên phim<span style="color:red"> *</span></label>
					<input type="text" name="title" id="title" class="form-control" value="{{$data->title}}">
				</div>
				<div class="form-group">
					<label for="imdb">IMDB</label>
					<input type="text" value="{{$data->imdb}}" name="imdb" id="imdb" class="form-control">
				</div>
				<div class="form-group">
					<label for="length">Thời lượng</label>
					<input type="text" value="{{$data->length}}" name="length" id="length" class="form-control">
				</div>
				<div class="form-group">
					<label for="companies">Công ty sản xuất</label>
					<textarea name="companies" id="companies" rows="3" class="form-control" value="{{$data->companies}}"></textarea>
				</div>
				<div class="form-group">
					<label for="quality">Chất lượng</label>
					<input type="text" name="quality" id="quality" class="form-control" value="{{$data->quality}}"> 
				</div>
				<div class="form-group">
	              	<div><label for="countries">Quốc gia</label></div>
	              	<select name="countries_id" class="form-control">
	              		@foreach($data->countries as $countries)
	              			@if($data->countries_id == $countries->id)
						    <option value="{{ $countries->id}} " selected="">{{$countries->name}}</option>
						    @else
						    <option value="{{ $countries->id}} ">{{$countries->name}}</option>
						    @endif
	              		@endforeach
	              	</select>
	            </div>
	            <div class="form-group">
	              		<div><label for="kinda">Loại phim</label></div>
	              		<select name="kinda" class="form-control">
	              		@if($data->type == 1)
						    <option value="1" selected="">Phim lẻ</option>
						    <option value="2">Phim chiếu rạp</option>
						@else
						    <option value="1">Phim lẻ</option>
						    <option value="2" selected="">Phim chiếu rạp</option>
						@endif
	              		</select>
	              	</div>
	            <div class="form-group">
					<label for="date">Ngày phát hành</label>
					<input class="form-control" type="text" id="date" name="date" value="{{$data->date}}" />
				</div>
				<div class="form-group">
					<label for="directors">Đạo diễn</label>
					<textarea name="directors" id="directors" rows="3" class="form-control">{{$data->directors}}</textarea>
				</div>
				<div class="form-group">
					<label>Thể loại</label>
					@foreach($data->categories as $categories)
					<?php $check = -1; ?>
					@foreach($data->categories_id as $value)
						@if ($categories->id == $value->categories_id)
							<?php $check = $categories->id; ?>
						@endif
					@endforeach
					<div class="form-control col-md-4">
						@if($check != -1)
						<input type="checkbox" name="type{{$categories->id}}" value="{{$categories->type}}" checked>
						@else
						<input type="checkbox" name="type{{$categories->id}}" value="{{$categories->type}}">
						@endif
						<label>{{$categories->type}}<label>
					</div>
					@endforeach	
				</div>
				<div class="form-group">
					<div class="form-control"></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body"></div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="url">Film URL</label>
					<input class="form-control" type="file" name="url" id="url">
				</div>
				<div class="form-group">
					<label for="trailer">Trailer URL</label>
					<input class="form-control" type="file" name="trailer" id="trailer">
				</div>
				<div class="form-group">
					<label for="image">Hình ảnh URL</label>
					<input class="form-control" type="file" name="image" id="image">
				</div>
				<div class="form-group">
					<label for="image">Ảnh trình chiếu URL</label>
					<input class="form-control" type="file" name="slide" id="image">
				</div>
				<div class="form-group">
					<label>Nội dung:</label>
					<textarea class="ckeditor" id="content" name="content">{{$data->content}}</textarea>
					<script type="text/javascript">
						var editor = CKEDITOR.replace('content',{
							language:'vi',
							filebrowserBrowseUrl : './public/js/ckfinder/ckfinder.html',
							filebrowserImageBrowserUrl : './public/js/ckfinder/ckfinder.html?Type=Images',
							filebrowserFlashBrowserUrl:  './public/js/ckfinder/ckfinder.html?Type=Flash',
							filebrowserImageUploadUrl: './public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Image',
							filebrowserFlashUploadUrl: './public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
						});
					</script>
				</div>
				<!-- <div class="form-group">
					<label for = "film-imgs">Hình ảnh trong phim</label>
					<div class="form-control">
						<input type="file" name="img[]">
					</div>
					<div type="file" class="form-control">
						<input type="file" name="img[]">
					</div>
					<div type="file" class="form-control">
						<input type="file" name="img[]">
					</div>
				</div> -->
				<div class="form-group">
					<div class="table table-responsive">
					<label>Diễn viên</label>
					<table class="table table-striped table-bordered" id="actorstbl">
						 <thead>
				            <tr>
				                <th>Tên</th>
				                <th>Hình ảnh</th>
				                <th>Quốc gia</th>
				                <th>Lựa chọn</th>
				            </tr>
        				</thead>
						<tbody>
				            @foreach($data->actors as $actors)
				            	<?php $index = -1 ?>
					            @foreach($data->actors_id as $value)
					            	@if($actors->id == $value->actors_id)
					            		<?php $index = $actors->id ?>
					            	@endif
					            @endforeach
				            <tr>
				                <td>{{$actors->name}}</td>
				                <td><img src="../../{{$actors->image
				                }}" class="img img responsive" height="75px"></td>
				                <td>{{$actors->countries}}</td>
				                @if($index == -1)
				                <td><input type="checkbox"  value = "{{$actors->id}}" name="actor{{$actors->id}}"></td>
				                @else
				                <td><input type="checkbox" checked=""  value = "{{$actors->id}}" name="actor{{$actors->id}}"></td>
				                @endif
				            </tr>
				            @endforeach  
				        </tbody>
					</table>
					</div>
				</div>
			</div>
			<div class="form-group col-md-4">
				<input type="submit" name="upload" id="upload" class="btn btn-primary col-md-5 " value="Cập nhật">
				<input type="reset" name="cancel" id="cancel" class="btn btn-danger col-md-5" style="float:right" value="Quay lại">
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    	$("#actorstbl").DataTable({
    		scrollY:        300,
	        scrollCollapse: true,
	        paging:         false
    	});
} );
</script>
<script type="text/javascript">
$("#date").daterangepicker({
	singleDatePicker: true,
    showDropdowns: true,
    locale: {
      format: 'YYYY-MM-DD',
    },
});
</script>
@endsection