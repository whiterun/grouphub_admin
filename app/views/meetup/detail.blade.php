@extends('layout')
@section('content')

<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">
			<i class="fa fa-calendar-o"></i>
			detail {{ $data['title'] }}
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
					<td>id</td>
					<td>{{ $data['id'] }}</td>
				</tr>
				<tr>
					<td>Title</td>
					<td>{{ $data['title'] }}</td>
				</tr>
				<tr>
					<td>Description</td>
					<td>{{ $data['description'] }}</td>
				</tr>
				<tr>
					<td>Time start</td>
					<td>{{ date('d M Y H:i', $data['time_start']) }}</td>
				</tr>
				<tr>
					<td>Time end</td>
					<td>{{ date('d M Y H:i', $data['time_end']) }}</td>
				</tr>
				<tr>
					<td>Community Category</td>
					<td>{{ $data['community_category_id'] }}</td>
				</tr>
				<tr>
					<td>Location</td>
					<td>{{ $data['location'] }}</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>{{ $data['address'] }}</td>
				</tr>
				@if( $data['status'] == 1 )
				<tr>
					<td>Status</td>
					<td>Active</td>
				</tr>
				@elseif( $data['status'] == 2 )
				<tr>
					<td>Status</td>
					<td>Deleted</td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<a href="{{ route('index_meetup') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
	</div>
</div>
@endsection