@extends('layout')
@section('content')

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">
			<i class="fa fa-calendar"></i>
			Event {{ $show['title'] }}
		</h3>
	</div>
	<div class="box-body">
		<table id="example2" class="table table-bordered table-striped">
			<thead>
				<tr class='thefilter' width="auto">
					<th style="width:300px;" class="text-center">Identitas</th>
					<th style="width:400px;" class="text-center">Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Event id</td>
					<td>{{ $show['id'] }}</td>
				</tr>
				<tr>
					<td>Title</td>
					<td>{{ $show['title'] }}</td>
				</tr>
				<tr>
					<td>Description</td>
					<td>{{ $show['description'] }}</td>
				</tr>
				<tr>
					<td>Start event</td>
					<td>{{ date('d M Y H:i', $show['time_start']) }}</td>
				</tr>
				<tr>
					<td>End of event</td>
					<td>{{ date('d M Y H:i', $show['time_end']) }}</td>
				</tr>
				<tr>
					<td>Event category</td>
					<td>{{ $show['event_category_id'] }}</td>
				</tr>
				<tr>
					<td>Location</td>
					<td>{{ $show['location'] }}</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>{{ $show['address'] }}</td>
				</tr>
				@if( $show['status'] == 1 )
				<tr>
					<td>Event status</td>
					<td>{{ $show['status'] }}</td>
				</tr>
				@elseif( $show['status'] == 2 )
				<tr>
					<td>Event status</td>
					<td>{{ $show['status'] }}</td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<a href="{{ route('index_event') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
	</div>
</div>
@endsection