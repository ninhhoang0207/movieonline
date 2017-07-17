@extends('templates.master')

@section('title')
	{{$data->title}}
@endsection

@section('content')
<div class="container">
	<div class="header">
		@if (Session::has('responseData'))
			@if (Session::get('responseData')['statusCode'] == 1)
				<div class="alert alert-success">{{ Session::get('responseData')['message'] }}</div>
			@elseif (Session::get('responseData')['statusCode'] == 2)
				<div class="alert alert-danger">{{ Session::get('responseData')['message'] }}</div>
			@endif
		@endif
		<h3>Edit</h3>
	</div>
	<div class="section">
		<div class="row">
			{!! Form::open(['method'=>'post','files'=>true]) !!}
			<input type="hidden" name="id" value="{{$data->id}}">
			<div class="col-md-4">
				<div class="form-group">
					<label for="title">Title<span style="color:red"> *</span></label>
					<input type="text" name="title" id="title" class="form-control" value="{{$data->title}}">
				</div>
				<div class="form-group">
					<label for="imdb">IMDB</label>
					<input type="text" value="{{$data->imdb}}" name="imdb" id="imdb" class="form-control">
				</div>
				<div class="form-group">
					<label for="length">Length</label>
					<input type="text" value="{{$data->length}}" name="length" id="length" class="form-control">
				</div>
				<div class="form-group">
					<label for="companies">Company</label>
					<textarea name="companies" id="companies" rows="3" class="form-control" value="{{$data->companies}}"></textarea>
				</div>
				<div class="form-group">
					<label for="quality">Quality</label>
					<input type="text" name="quality" id="quality" class="form-control" value="{{$data->quality}}"> 
				</div>
				<div class="form-group">
	              	<div><label for="countries">Country</label></div>
	              	<select name="countries_id" class="form-control">
	              		@foreach($data->countries as $countries)
	              			@if($data->countries_id == $countries->id)
						    <option value="{{ $countries->id}} " selected="">{{$countries->name}}</option>
						    @else
						    <option value="{{ $countries->id}} ">{{$countries->name}}</option>
						    @endif
	              		@endforeach
	              	</select>
	            </div>
	            <div class="form-group">
					<label for="date">Date</label>
					<input class="form-control" type="text" id="date" name="date" value="{{$data->date}}" />
				</div>
				<div class="form-group">
					<label for="directors">Directors</label>
					<textarea name="directors" id="directors" rows="3" class="form-control" value="{{$data->directors}}"></textarea>
				</div>
				<div class="form-group">
					<label>Type's Film</label>
					@foreach($data->categories as $categories)
					<?php $check = -1; ?>
					@foreach($data->categories_id as $value)
						@if ($categories->id == $value->categories_id)
							<?php $check = $categories->id; ?>
						@endif
					@endforeach
					<div class="form-control col-md-4">
						@if($check != -1)
						<input type="checkbox" name="type{{$categories->id}}" value="{{$categories->type}}" checked>
						@else
						<input type="checkbox" name="type{{$categories->id}}" value="{{$categories->type}}">
						@endif
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
				<div class="form-group">
					<input type="submit" name="upload" id="upload" class="btn btn-primary col-md-5 " value="Edit">
				</div>
				<div class="form-group">
					<a href="./film_list">
					<input type="button" name="cancel" id="cancel" class="btn btn-danger col-md-5 " value="Back" style="float:right">
					</a>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="url">Film URL</label>
					<input class="form-control" type="file" name="url" id="url">
				</div>
				<div class="form-group">
					<label for="trailer">Trailer URL</label>
					<input class="form-control" type="file" name="trailer" id="trailer">
				</div>
				<div class="form-group">
					<label for="image">Image URL</label>
					<input class="form-control" type="file" name="image" id="image">
				</div>
				<div class="form-group">
					<label for="content">Content</label>
					<textarea name="content" id="content" rows="5" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for = "film-imgs">Images on film:</label>
					<div class="form-control">
						<input type="file" name="img[]">
					</div>
					<div type="file" class="form-control">
						<input type="file" name="img[]">
					</div>
					<div type="file" class="form-control">
						<input type="file" name="img[]">
					</div>
				</div>
				<div class="form-group">
					<div class="table table-responsive">
					<label>Actors</label>
					<table class="table table-striped table-bordered" id="actorstbl">
						 <thead>
				            <tr>
				                <th>Name</th>
				                <th>Image</th>
				                <th>Country</th>
				                <th>Select</th>
				            </tr>
        				</thead>
						<tbody>
				            @foreach($data->actors as $actors)
				            	<?php $index = -1 ?>
					            @foreach($data->actors_id as $value)
					            	@if($actors->id == $value->actors_id)
					            		<?php $index = $actors->id ?>
					            	@endif
					            @endforeach
				            <tr>
				                <td>{{$actors->name}}</td>
				                <td><img src="{{$actors->image
				                }}" class="img img responsive" height="75px"></td>
				                <td>{{$actors->countries}}</td>
				                @if($index == -1)
				                <td><input type="checkbox"  value = "{{$actors->id}}" name="actor{{$actors->id}}"></td>
				                @else
				                <td><input type="checkbox" checked=""  value = "{{$actors->id}}" name="actor{{$actors->id}}"></td>
				                @endif
				            </tr>
				            @endforeach  
				        </tbody>
					</table>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
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