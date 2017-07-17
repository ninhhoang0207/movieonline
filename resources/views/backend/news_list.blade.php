@extends('layouts.copy')
@section('title')
CHỈNH SỬA TIN TỨC
@endsection
@section('content')
<div>
	<div class="page-header">
		<h1>DANH SÁCH
			<small>BÀI VIẾT</small>
		</h1>
	</div>
	<div class="content">
		<div class="form-group">
			<div class="table table-responsive">
				<table class="table table-striped table-bordered" id="list">
					<thead>
				        <tr>
				            <th>#</th>
				            <th>Tiêu đề</th>
				            <th>Ảnh</th>
				            <th>Tác giả</th>
				            <th>Thời gian đăng</th>
				           	<th></th>
				           	<th></th>
				         </tr>
        			</thead>
					<tbody>
				    @foreach($data as $key=>$data)
				    <tr>
				    	<td>{{$key+1}}</td>
				        <td>{{$data->title}}</td>
				        <td><img src="../../{{$data->img}}" class="img img responsive" height="100px" width="100px"></td>
				        <td>{{$data->composer}}</td>
				        <td>{{$data->created_at}}</td>
				 		<td align="center"><a href="./sua?id={{$data->id}}"><button class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i>Sửa</button></a></td>
				      	<td align="center"><a href="./xoa?id={{$data->id}}" style="color:red" onclick="return confirm('Bạn có chắc muốn xóa không !')"><button class="btn btn-danger"><i class="fa fa-trash-o  fa-fw"></i>Xóa</button></a></td>
				    </tr>
				    @endforeach  
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    	$("#list").DataTable();
} );
</script>
@endsection