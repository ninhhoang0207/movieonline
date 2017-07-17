@extends('layouts.copy')
@section('title')
THÊM DIỄN VIÊN
@endsection
@section('content')
       <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">THÊM
                            <small>DIỄN VIÊN</small>
                        </h1>
                    </div>
                    <div class="col-lg-12" style="padding-bottom:80px">
                        <form class="form-horizontal" method="POST" action="{{route('add.image')}}" id="frm-actor" enctype="multipart/form-data" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->All() as $error)
                                    <li>{!! $error !!}</li>
                                @endforeach()

                            </div>
                        @endif
                        @if(Session::has('message'))
                                 <div class="alert alert-success"><i class="glyphicon glyphicon-ok">{{Session::get('message')}}</i>
                                </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                <strong>{{Session::get('error')}}</strong>
                            </div>
                        @endif
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-1" >
                                    <label>Tên diễn viên :</label>
                                    <br>
                                    <input class="form-control" minlenght="5" id="actor_name" name="actor_name" type="text" placeholder="Tên diễn viên...">
                                </div>
                                 
                                 
                            </div>
                            
                            <div class="form-group">
                                  <div class="col-md-9 col-md-offset-1">
                                    <label class=" control-label">Tiểu sử:</label>
                                    <textarea class="form-control" rows="5" id="ckeditor" name="ckeditor" ></textarea>
                                  </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-1">
                                    <label >Hình ảnh:  </label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-1">
                                
                                    <div><label for="countries">Quốc gia</label></div>
                                    <select name="countries_id" class="form-control">
                                    @foreach($data as $countries)
                                         <option value="{{ $countries->id}} ">{{$countries->name}}</option>
                                    @endforeach
                                    </select>
                                
                                 </div>
                             </div>
                            <input type="submit" value="Thêm" id="submit" class="btn btn-primary" style="margin-left: 100px ;width: 126px;margin-top:30px;">
                                
                        </form>
                </div>
            </div>
        </div>
		
   			<script >
   				$(document).on('click','#submit',function(){
   					$('#frm-actor').submit();
   				});
   			</script>
            <!-- /#wrapper -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
				
	</div>
    @endsection