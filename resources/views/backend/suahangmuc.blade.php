@extends('layouts.copy')
@section('title')
CHỈNH SỬA HẠNG MỤC PHIM
@endsection
@section('content')
<div>
	<div class="header-page">
		<h1>CHỈNH SỬA
			<small>HẠNG MỤC PHIM</small>
		</h1>
	</div>
	<div>
		<div>
			<label for="oldname" class="form-control">Tên cũ:</label>
			<input type="text" editable=false name="" value="{{$data->typename}}">
		</div>
		<div>
			<label for="newname" class="form-control">Tên mới:</label>
			<input type="text" editable=false name="newname">
		</div>
	</div>
</div>
@endsection