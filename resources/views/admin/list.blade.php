@extends('layouts.copy')
@section('title')
Danh sách diễn viên
@endsection
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách
                        <small>Diễn viên</small>
                        </h1>
                    </div>
                       <div class="col-lg-12">
                            @if(Session::has('message'))
                                 <div class="alert alert-success">{{Session::get('message')}}</div>
                                
                             @endif
                              <table class="table table-striped table-bordered table-hover" id="list">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Tên </th>
                                <th>Tiểu sử </th>
                                <th>Hình ảnh </th>
                                <th>Quốc gia </th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($actor as $key=>$at)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$key+1}}</td>
                                    <td>{{$at->name}}</td>
                                    <td>{{$at->about}}</td>
                                    <td><img width="100px" src="../../{{$at->image}}"></td>
                                    <td>{{$at->country->name}}</td>
                                    <td class="center"><a id ="sua" href="sua?id={{$at->id}}"><button class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i> <span style="color:white">Sửa</span></button></a></td>
                                    <td class="center"><a id ="xoa" href="xoa?id={{$at->id}}" onclick="return confirm('Bạn có chắc muốn xóa không !')"><button class="btn btn-danger" ><i class="fa fa-trash-o  fa-fw"></i><span style="color:white">Xóa</span></button></a></td>
                            @endforeach
                        </tbody>
                    </table>
               </tr>
               </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#list").DataTable();
} );
</script>
@endsection

			 
		
