<?php $i = $users->getFrom(); ?>
@extends('layout')

@section('content')
	@if ( Session::has('message') )
	<div class="alert alert-{{ Session::get('class') }}">
		<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
		<strong>{{ Session::get('message') }}</strong>
	</div>
	@endif
	
	@if(!empty(Session::get('success')))
		<div class="alert alert-success">
			<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
			<i class="fa fa-check"></i> {{ Session::get('success') }}
		</div>
	@endif

	@if(!empty(Session::get('error')))
		<div class="alert alert-success">
			<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
			<i class="fa fa-ban"></i> {{ Session::get('error') }}
		</div>
	@endif

	@if(!empty(Session::get('delete_success')))
		<div class="alert alert-success">
			<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
			<i class="fa fa-check"></i> {{ Session::get('delete_success') }}
		</div>
	@endif
	
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">
				<i class="fa fa-user"></i>&nbsp;User Account
			</h3>
			<div class="box-tools pull-right">
				<div class="has-feedback">
					<form style="float:right;" action="{{ route('user.index') }}" method="get">
						<input type="text" name="search" class="form-control input-sm"  placeholder="Search User" value="{{ Input::get('search')}}" />
						<span class="glyphicon glyphicon-search form-control-feedback"></span>
					</form>
				</div>
			</div><!-- /.box-tools -->
		</div><!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
				<thead>
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>E-mail</th>
						<th style="width:auto;">Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach( $users as $user )
					<tr>
						<td>{{ $i }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-primary">Action</button>
								<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu pull-right">
									<li>
										<a href="{{ route('user.edit', $user->id) }}">
											<i class="fa fa-pencil"></i> Manage profile
										</a>
									</li>
									<li>
										<a href="{{ route('user.destroy', $user->id) }}">
											<i class="fa fa-trash"></i> Delete
										</a>
									</li>
								</ul>
							</div>
						</td>
					</tr>
					<?php $i++; ?>
				@endforeach
				</tbody>
			</table>
		</div><!-- /.box-body -->
		<div class="box-footer clearfix">
			{{ $users->appends([ 'search' => Input::get('search') ])->links() }}
		</div>
	</div><!-- /.box -->
@endsection