<?php $i = $communities->getFrom(); ?>
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

	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">
				<i class="fa fa-users"></i> Community
			</h3>
			<div class="box-tools pull-right">
				<div class="has-feedback">
					<form style="float:right;" action="community" method="get">
						<input type="text" name="search" class="form-control input-sm" placeholder="Search Community" value="{{ Input::get('search')}}" />
						<span class="glyphicon glyphicon-search form-control-feedback"></span>
					</form>
				</div>
			</div><!-- /.box-tools -->
		</div><!-- /.box-header -->
		<div class="box-body">
			<table class="table table-bordered">
				<thead>
					<th>No.</th>
					<th>Name</th>
					<th>Category</th>
					<th>Status</th>
					<th style="width:auto;">Action</th>
				</thead>
				<tbody>
				@foreach( $communities as $community )
					<tr>
						<td>{{ $i }}</td>
						<td>{{ $community->name }}</td>
						<td>{{ $community->category->name }}</td>
						<td>
							@if ( $community->status == 3 )
								<p class="text-danger">Freezed</p>
							@elseif ( $community->status == 2 )
								<p class="text-warning">Suspended</p>
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
										<a href="{{ route('community.detail', $community->id) }}">
											<i class="fa fa-search-plus"></i> Preview
										</a>
									</li>
									<li>
										<a href="community/member/{{ $community->id }}">
											<i class="fa fa-users"></i> Manage Member
										</a>
									</li>
									<li>
										<a href="community/organizer/{{ $community->id }}">
											<i class="fa fa-hand-o-right"></i> Set Organizer
										</a>
									</li>
									<li>
										<a href="community/creator/{{ $community->id }}">
											<i class="fa fa-paper-plane"></i> Transfer Creator
										</a>
									</li>
									@if( $community->status == 1 )
									<li>
										<a class="inactive" href="community/set-inactive/{{ $community->id }}">
											<i class="fa fa-lock"></i> Set Inactive
										</a>
									</li>
									@endif
									@if( $community->status == 2 )
									<li>
										<a class="activate" href="community/set-Activate/{{ $community->id }}">
											<i class="fa fa-unlock"></i> Set Activate
										</a>
									</li>
									@endif
									<li>
										<a href="{{ route('community.edit', $community->id) }}">
											<i class="fa fa-pencil"></i> Edit
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
		</div>
		<div class="box-footer clearfix">
			{{ $communities->appends([ 'search' => Input::get('search') ])->links() }}
		</div>
	</div>
@endsection

@section('script')
	@parent
	
	<script type="text/javascript">
	$(".inactive").click(function(event) {
		event.preventDefault();
		$.post($(this).attr('href'), function(html){
			alert('success set inactive');
			window.location.reload();
		});     
	});

	$(".activate").click(function(e){
		e.preventDefault();
		// alert data
		$.post($(this).attr('href'), function(data){
			alert('success set activate');
			window.location.reload();
		});
	});
	</script>
@stop