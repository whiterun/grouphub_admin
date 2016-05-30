@extends('layout')
@section('content')
<div class="box box-info">
	<div class="box-header with-border">
		<h4 class="box-title">
			<i class="fa fa-user-plus"></i>
			Organizer {{ $community->name }}
		</h4>
		<div class="box-tools pull-right">
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div><!-- /.box-tools -->
	</div>
	<div class="box-body">
		<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
			<thead>
				<tr class='thefilter' width="auto">
					<th>User Id</th>
					<th>Users</th>
					<th>Email</th>
					<th>Organizer</th>
					<th>Set Organizer</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $organizer as $db )
				<tr>
					<td>{{ $db['user']['id'] }}</td>
					<td>{{ $db['user']['name'] }}</td>
					<td>{{ $db['user']['email'] }}</td>
					@if( $db['role'] == 3 )
					<td style="width:150px;">Member</td>
					@elseif( $db['role'] == 2)
					<td style="width:150px;">Approved Organizer</td>
					@elseif( $db['role'] == 1 )
					<td style="width:150px;">Creator</td>
					@endif
					<td>
						@if( $db['role'] == 3 )
						<a data-id="{{ $db->id }}" class="btn btn-success set"><i class="fa fa-user-plus"></i> Set Organizer</a>
						@elseif( $db['role'] == 2)
						<a data-id="{{ $db->id }}" class="btn btn-danger remove"><i class="fa fa-close"></i> Remove</a>
						@elseif( $db['role'] == 1 )
						<span class="label label-primary"><i class="fa fa-ban"></i> Not yet approved</span>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<a href="{{ route('index_community') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> back</a>
	</div>
</div>
@endsection
@section('script')
@parent
<script type="text/javascript">
$(function(){
	$(".remove").click(function(event) {
		event.preventDefault();
		$.post('/community/removeOrganizer',{id:$(this).attr('data-id')},function(html){
			alert('Remove Organizer Success');
			window.location.reload();
		});     
	});

	$(".set").click(function(event) {
		event.preventDefault();
		$.post('/community/setOrganizer',{id:$(this).attr('data-id')},function(html){
			alert('Set Organizer Success');
			window.location.reload();
		});     
	});
});
</script>
@stop