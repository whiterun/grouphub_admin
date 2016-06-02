@extends('layout')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="box box-solid box-info">
			<div class="box-header">
				<h4>
					<i class="fa fa-pencil"></i>
					Edit {{ $show['name'] }}
				</h4>
			</div>
			<div class="box-body">
				{{ Form::open(array('route' => 'store_community', 'class' => 'form-horizontal')) }}    
				<div class="form-group">
					{{ Form::label('name_uri', 'Name_uri', array('class' => 'col-sm-2 control-group')) }}
					<div class="col-sm-10">
						{{ Form::text('name_uri', $show['name_uri'], array('class' => 'form-control')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('community_category_id', 'Community_category_id', array('class' => 'col-sm-2 control-group')) }}
					<div class="col-sm-10">
						{{ Form::text('community_category_id', $show['community_category_id'], array('class' => 'form-control')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('email', 'E-mail', array('class' => 'col-sm-2 control-group')) }}
					<div class="col-sm-10">
						{{ Form::text('email', $show['email'], array('class' => 'form-control')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('description', 'Description', array('class' => 'col-sm-2 control-group')) }}
					<div class="col-sm-10">
						{{ Form::textarea('description', $show['description'], array('class' => 'form-control')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('looking_for', 'Looking for', array('class' => 'col-sm-2 control-group')) }}
					<div class="col-sm-10">
						{{ Form::text('looking_for', $show['looking_for'], array('class' => 'form-control')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('call_for_members', 'Call for members', array('class' => 'col-sm-2 control-group')) }}
					<div class="col-sm-10">
						{{ Form::text('call_for-members', $show['call_for_members'], array('class' => 'form-control')) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<input type="hidden" name="id" value="{{ $show['id'] }}">
						{{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
						<a href="{{ route('index_community') }}" class="btn btn-warning">Cancel</a>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection