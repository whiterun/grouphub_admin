@extends('layout')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h4>
					<i class="fa fa-user"></i>
					{{ $show['name'] }}
				</h4>
			</div>
			<div class="box-body">
				<div class="container-fluid">
					<div class="row-fluid">
						{{ Form::open(array('route' => 'store_user', 'class' => 'form-horizontal')) }}
						<div class="form-group">
							{{ Form::label('name', 'Name', array('class' => 'col-sm-3 control-group')) }}
							<div class="col-sm-10">
								{{ Form::text('name', $show['name'], array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('email', 'E-mail', array('class' => 'col-sm-3 control-group')) }}
							<div class="col-sm-10">
								{{ Form::text('email', $show['email'], array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('description', 'Description', array('class' => 'col-sm-3 control-group')) }}
							<div class="col-sm-10">
								{{ Form::textarea('description', $show['description'], array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-10">
								{{ Form::file('image', '', ['class' => 'col-sm-3']) }}
							</div>
						</div>
						<div class="box-footer">
							<input type="hidden" name="id" value="{{ $show['id'] }}">
							{{ Form::submit('Modify', ['class' => 'btn btn-primary'], array('files'=> true)) }}
							{{ HTML::linkRoute('index_user', 'Cancel', array(), array('class' => 'btn btn-default')) }}
						</div>
						{{ Form::close() }}
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection