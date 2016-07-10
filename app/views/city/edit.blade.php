@extends('layout')

@section('content')
	@if ( Session::has('message') )
	<div class="alert alert-{{ Session::get('class') }}">
		<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
		<strong>
		@if ( is_array(Session::get('message')) )
			<ul class="no-margin">
				@foreach ( Session::get('message') as $message )
				<li>{{ $message }}</li>
				@endforeach
			</ul>
		@else
			{{ Session::get('message') }}
		@endif
		</strong>
	</div>
	@endif
	
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">
				<i class="fa fa-flag"></i>&nbsp;Edit &ldquo;{{ $city['name'] }}&rdquo; City
			</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		{{ Form::open([ 'route' => [ 'city.update', $city['id'] ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Country</label>
					<div class="col-sm-5">
						<select class="form-control" name="country_id" required>
							<option value="">Choose a Country</option>
							@foreach ( $countries as $country )
							<option value="{{ $country->id }}" {{{ $city['country_id'] == $country->id ? 'selected' : '' }}}>{{ $country->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">City Name</label>
					<div class="col-sm-5">
						<input type="text" name="name" class="form-control" placeholder="Country Name" value="{{ $city['name'] }}" required>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-info">Update</button>
				<button type="button" class="btn btn-default" onclick="history.back()">Cancel</button>
			</div>
			<!-- /.box-footer -->
		{{ Form::close() }}
	</div>
@endsection