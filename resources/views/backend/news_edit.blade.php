@extends('layouts.copy')
@section('title')
CHỈNH SỬA TIN TỨC
@endsection
@section('content')
<div>
	<div class="page-header">
		<h1>CHỈNH SỬA
			<small>BÀI VIẾT</small>
		</h1>
	</div>
	{{ Form::open(['method'=>'post','files'=>true])}}
	<div>
		<input type="hidden" name="id" value="{{$data->id}}">
		<div class="form-group">
			<label>Tiêu đề:</label>
			<input type="text" name="title" class="form-control" value="{{$data->title}}" />
		</div>
		<div class="form-group">
			<label>Tác giả:</label>
			<input type="text" name="composer" class="form-control" value="{{$data->composer}}"/>
		</div>
		<div class="form-group">
			<label>Hình ảnh đại diện:</label>
			<img src="../../{{$data->img}}" name="old_img" class="img img-responsive" width="100px" height="150px">
			<input type="file" name="img" class="form-control">
		</div>
		<div class="form-group">
			<label>Nội dung:</label>
			<textarea class="ckeditor" id="editor1" name="editor1">{{$data->content}}</textarea>
			<script type="text/javascript">
				var editor = CKEDITOR.replace('editor1',{
					language:'vi',
					filebrowserBrowseUrl : './public/js/ckfinder/ckfinder.html',
					filebrowserImageBrowserUrl : './public/js/ckfinder/ckfinder.html?Type=Images',
					filebrowserFlashBrowserUrl:  './public/js/ckfinder/ckfinder.html?Type=Flash',
					filebrowserImageUploadUrl: './public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Image',
					filebrowserFlashUploadUrl: './public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
				});
			</script>
		</div>
	</div>
	<div class="form-group" style="padding-top:20px; border-top:1px solid">
		<div class="row container">
			<button type="submit" class="btn-lg btn-primary col-md-2">Cập nhật</button>
			<button type="reset" class="btn-lg btn-danger col-md-2" style="float:right">Hủy</button>
		</div>
	</div>
	{{Form::close()}}
</div>


@endsection