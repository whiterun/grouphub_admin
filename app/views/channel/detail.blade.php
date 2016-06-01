@extends('layout')
@section('content')

<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">
			<i class="fa fa-share-alt"></i>
			{{ $show['name'] }}
		</h3>
	</div>
	<div class="box-body">
		<table id="example2" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th style="width:300px;" class="text-center">Identitas</th>
					<th style="width:400px;" class="text-center">Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Id</td>
					<td>{{ $show['id'] }}</td>
				</tr>
				<tr>
					<td>Name</td>
					<td>{{ $show['name'] }}</td>
				</tr>
				<tr>
					<td>Description</td>
					<td>{{ $show['description'] }}</td>
				</tr>
				<tr>
					<td>Community ID</td>
					<td>{{ $show['community_id'] }}</td>
				</tr>
				<tr>
					<td>Total Subscriber</td>
					<td>{{ $show['total_subscribers'] }}</td>
				</tr>
				<tr>
					<td>Total Activity</td>
					<td>{{ $show['total_activities'] }}</td>
				</tr>
				@if( $show['type'] == 1 )
				<tr>
					<td>Type</td>
					<td>Public</td>
				</tr>
				@elseif( $show['type'] == 2 )
				<tr>
					<td>Type</td>
					<td>Private</td>
				</tr>
				@endif
				@if ( $show['status'] == 1 )
				<tr>
					<td>Status</td>
					<td>Active</td>
				</tr>
				@elseif( $show['status'] == 2 )
				<tr>
					<td>Status</td>
					<td>Inactive</td>
				</tr>
				@elseif( $show['status'] == 3 )
				<tr>
					<td>Status</td>
					<td>Deleted</td>
				</tr>
				@endif
				<tr>
					<td>Time Created</td>
					<td>{{ date('d M Y H:i', $show['time_created']) }}</td>
				</tr>
				<tr>
					<td>Time Updated</td>
					<td>{{ date('d M Y H:i', $show['time_updated']) }}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<a href="{{ route('index_channel') }}" class="btn btn-default">
			<i class="fa fa-arrow-circle-left"></i>
			Back
		</a>
	</div>
</div>
@endsection