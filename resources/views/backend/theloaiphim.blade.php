@extends('layouts.copy')
@section('title')
HẠNG MỤC PHIM
@endsection
@section('content')
<div class="header">
		
	<h1 class="page-header">HẠNG MỤC
		<small>PHIM</small>
	</h1>
</div>

<div class="row" id="tb">
	<div class="table table-responsive">	
		<table class="table table-striped table-bordered" id="list">
			<thead>
				<th>#</th>
				<th>Thể loại</th>
				<th>Chỉnh sửa</th>
				<th></th>
				
			</thead>

			<tbody>
			<?php foreach ($data as $key => $value): ?>
				<tr>
				
					<td>{{$key+1}}</td>
					<td>{{$value->type}}</td>
					{!! Form::open(['route'=>'sua']) !!}
					<input type="hidden" name="tid" value="{!! $value->id !!}">
					<td><input name="newname" placeholder="Nhập hạng mục phim" class="form-control"></td>
					<td align="center" class="col-md-2">
					<!-- <a href="./hangmuc-phim/sua?id={{$value->id}}&old={{$value->type}}"><button class="btn btn-primary">Sửa</button></a> -->
					<button type="submite" class="btn btn-primary">Sửa</button>
					{!! Form::close() !!}
					<a href="./hang-muc/xoa?id={{$value->id}}">
						<button class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không !')">Xóa</button></a>
					</td>
				</tr>
			<?php endforeach ?>
			<tr>
				{!! Form::open() !!}
				<td align="center"><strong>Thêm mới</strong></td>
				<td>...</td>
				<td><input name="category" placeholder="Nhập hạng mục phim" class="form-control"></td>
				<td align="center">
				<input type="submit" class="btn btn-success" value="Thêm">
				{!! Form::close() !!}
				</td>
			</tr>
			</tbody>
			
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
    	$("#list").DataTable();
} );
</script>
@endsection