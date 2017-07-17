@extends('layouts.copy')

@section('title')
DANH SÁCH PHIM
@endsection

@section('content')
<div class="contaier">
	<div class="">
		<h1 class="page-header">DANH SÁCH 
		<small>PHIM</small>
		</h1>
	</div>
	<div class="content">
		<div class="form-group">
			<div class="table table-responsive">
				<table class="table table-striped table-bordered" id="list">
					<thead>
				        <tr>
				            <th>#</th>
				            <th>Tên phim</th>
				            <th>Ảnh</th>
				            <th>Quốc gia</th>
				            <th>Diễn viên</th>
				            <th>Thể loại</th>
				            <th>Ngày phát hành</th>
				           	<th></th>
				            <th></th>
				         </tr>
        			</thead>
					<tbody>
				    @foreach($data as $key=>$data)
				    <tr>
				    	<td>{{$key+1}}</td>
				        <td>{{$data->title}}</td>
				        <td><img src="../../{{$data->image}}" class="img img responsive" height="100px"></td>
				        <td>{{$data->name}}</td>
				        <td>{{$data->actor_name}}</td>
				        <td>{{$data->categories}}</td>
				        <td>{{$data->date}}</td>
				 		<td><a href="./sua?id={{$data->id}}"><button class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i>Sửa</button></a></td>
				      	<td><a href="./xoa?id={{$data->id}}" style="color:red" onclick="return confirm('Bạn có chắc muốn xóa không !')"><button class="btn btn-danger"><i class="fa fa-trash-o  fa-fw"></i>Xóa</button></a></td>
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