@extends('layouts.copy')

@section('content')

       <div id="page-wrapper">
            <div class="container-fluid">
               
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Diễn viên
                            <small>{{$actor->name}}</small>
                        </h1>
                    </div>
                    <div class="col-lg-12" style="padding-bottom:80px">
                        <form class="form-horizontal" method="POST" id="frm-actor" enctype="multipart/form-data" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{$actor->id}}">
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
                                {{Session::get('error')}}
                            </div>
                        @endif
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-1" >
                                    <label>Tên diễn viên :</label>
                                    <br>
                                    <input class="form-control" minlenght="5" id="actor_name" name="actor_name" type="text" placeholder="tên diễn viên..." value="{{$actor->name}}">
                                </div>
                                 
                            </div>
                            
                            <div class="form-group">
                                  <div class="col-md-8 col-md-offset-1">
                                    <label class=" control-label">Tiểu sử:</label>
                                    <textarea class="form-control" rows="3" id="ckeditor" name="ckeditor" >{{$actor->about}}</textarea>
                                  </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-1">
                                    <label >Hình ảnh:  </label><br>
                                    <img width="100px" src="{{$actor->image}}">
                                    <input type="file" name="file" class="form-control" value="../public/image/{{$actor->image}}"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                  <div class="col-md-8 col-md-offset-1">
                                    <label >Quốc Gia:</label>
                                        <select class="form-control" id="select" name="select">
                                            @foreach($countries as $ct)
                                            <option value="{{$ct->id}}"
                                                <?php if ( $actor->country->id == $ct->id):?>
                                                    {{"selected"}}
                                                <?php endif; ?>
                                            >{{$ct->name}}</option>
                                            @endforeach

                                        </select>
                                          
                                    </div>
                             </div>
                            <input type="submit" value="submit" id="submit" class="btn btn-primary" style="margin-left: 100px ;width: 126px;margin-top:30px;">
                                
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

   <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
				
	</div>
@endsection