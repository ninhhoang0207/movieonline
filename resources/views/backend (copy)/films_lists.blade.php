@extends('templates.master')

@section('title')
List Film
@endsection

@section('content')
<div class="contaier">
	<div class="header">
		<h1>List Film</h1>
	</div>
	<div class="content">
		<div class="form-group">
			<div class="table table-responsive">
				<label>List</label>
				<table class="table table-striped table-bordered" id="list">
					<thead>
				        <tr>
				            <th>#</th>
				            <th>Title</th>
				            <th>Image</th>
				            <th>Country</th>
				            <th>Actors</th>
				            <th>Type</th>
				            <th>Date</th>
				           	<th></th>
				            
				         </tr>
        			</thead>
					<tbody>
				    @foreach($data as $key=>$data)
				    <tr>
				    	<td>{{$key+1}}</td>
				        <td>{{$data->title}}</td>
				        <td><img src="{{$data->image}}" class="img img responsive" height="100px"></td>
				        <td>{{$data->name}}</td>
				        <td>{{$data->actor_name}}</td>
				        <td>{{$data->categories}}</td>
				        <td>{{$data->date}}</td>
				 		<td><a href="./film_edit?id={{$data->id}}">Edit</a></td>
				      
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