@extends('layouts.copy')
@section('content')

<div class="container">
	<div class="">
		
		<h1 class="page-header">UPLOAD
			<small>PHIM</small>
		</h1>
	</div>
	<div class="section">
		<div class="row">
			{!! Form::open(['method'=>'post','files'=>true]) !!}
			{{ csrf_field() }}
			<div class="col-md-4">
					<div class="form-group">
						<label for="title">Tên phim<span style="color:red"> *</span></label>
						<input type="text" name="title" id="title" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="imdb">IMDB</label>
						<input type="text" value="0" name="imdb" id="imdb" class="form-control">
					</div>
					<div class="form-group">
						<label for="length">Thời lượng</label>
						<input type="text" value="0" name="length" id="length" class="form-control">
					</div>
					<div class="form-group">
						<label for="companies">Công ty sản xuất</label>
						<textarea name="companies" id="companies" rows="3" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="quality">Chất lượng</label>
						<input type="text" name="quality" id="quality" class="form-control">
					</div>
					<div class="form-group">
	              		<div><label for="countries">Quốc gia</label></div>
	              		<select name="countries_id" class="form-control">
	              		@foreach($data['countries'] as $countries)
						     <option value="{{ $countries->id}} ">{{$countries->name}}</option>
	              		@endforeach
	              		</select>
	              	</div>
	      			<div class="form-group">
	              		<div><label for="kinda">Loại phim</label></div>
	              		<select name="kinda" class="form-control">
						     <option value="1">Phim lẻ</option>
						     <option value="2">Phim chiếu rạp</option>
	              		</select>
	              	</div>
					<div class="form-group">
						<label for="date">Ngày phát hành</label>
						<input class="form-control" type="text" id="date" name="date" value="" />
					</div>
					<div class="form-group">
						<label for="directors">Đạo diễn</label>
						<textarea name="directors" id="directors" rows="3" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>Thể loại</label>
						@foreach($data['categories'] as $categories)
						<div class="form-control col-md-4">
							<input type="checkbox" name="type{{$categories->id}}" value="{{$categories->id}}">
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
					<label for="url">Film URL<span style="color:red"> *</span></label>
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
					<textarea class="ckeditor" id="editor1" name="content"></textarea>
				</div>

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
				            @foreach($data['actors'] as $actors)
				            <tr>
				                <td>{{$actors->name}}</td>
				                <td><img src="../../{{$actors->image}}" class="img img responsive" height="75px"></td>
				                <td>{{$actors->countries}}</td>
				                <td><input type="checkbox"  value = "{{$actors->id}}" name="actor{{$actors->id}}"></td>
				            </tr>
				            @endforeach  
				        </tbody>
					</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="form-group" style="border-top:1px solid; margin:50px; padding:10px;">
				<input type="submit" name="upload" id="upload" class="btn-lg btn-primary col-md-3 " value="Tải lên">
				<input type="reset" name="cancel" id="cancel" class="btn-lg btn-danger col-md-3" style="float:right" value="Hủy">
			</div>
			{!! Form::close() !!}
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