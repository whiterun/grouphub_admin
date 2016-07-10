<?php $i = $cities->getFrom(); ?>
@extends('layout')

@section('content')
	@if ( Session::has('message') )
	<div class="alert alert-{{ Session::get('class') }}">
		<button type="button" class="close fa fa-close" data-dismiss="alert"></button>
		<strong>{{ Session::get('message') }}</strong>
	</div>
	@endif
	
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">
				<i class="fa fa-flag"></i>&nbsp;City List
			</h3>
			<div class="box-tools pull-right">
				<div class="has-feedback">
					<a class="btn btn-default btn-sm pull-left" href="{{ route('city.create') }}" style="margin-right:5px;">
						<i class="fa fa-plus"></i>&nbsp;Add New
					</a>
					<form action="" class="pull-left" method="get">
						<input type="text" name="search" class="form-control input-sm" placeholder="Search City" value="{{ Input::get('search')}}" />
						<span class="glyphicon glyphicon-search form-control-feedback"></span>
					</form>
				</div>
			</div><!-- /.box-tools -->
		</div><!-- /.box-header -->
		<div class="box-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Country</th>
						<th>Status</th>
						<th style="width:auto;">Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach( $cities as $city )
					<tr>
						<td>{{ $i }}</td>
						<td>{{ $city->name }}</td>
						<td>{{ $city->country->name }}</td>
						<td>
							@if ( $city->status == 3 )
								<p class="text-danger">Deleted</p>
							@elseif ( $city->status == 2 )
								<p class="text-warning">Inactive</p>
							@else
								<p class="text-success">Active</p>
							@endif
						</td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-primary">Action</button>
								<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu pull-right">
									<li>
										<a href="{{ route('city.edit', $city->id) }}">
											<i class="fa fa-pencil"></i> Edit
										</a>
									</li>
									@if ( $city->status != 1 )
									<li>
										<a href="{{ route('city.set.active', $city->id) }}">
											<i class="fa fa-check"></i> Set as Active
										</a>
									</li>
									@endif
									@if ( in_array( $city->status, [ 1, 2 ] ) )
									<li>
										<a href="{{ route('city.delete', $city->id) }}">
											<i class="fa fa-trash"></i> Delete
										</a>
									</li>
									@endif
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
			{{ $cities->appends([ 'search' => Input::get('search') ])->links() }}
		</div>
	</div><!-- /.box -->
@endsection