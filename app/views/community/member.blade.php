@extends('layout')
@section('content')

<div class="box box-info">
	<div class="box-header with-border">
		<h4 class="box-title">
			<i class="fa fa-user-plus"></i>
			Member {{ $community->name }}
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
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $members as $member )
				<tr>
					<td>{{ $member['user']['id'] }}</td>
					<td>{{ $member['user']['name'] }}</td>
					<td>{{ $member['user']['email'] }}</td>
					@if( $member['role'] == 3 )
					<td style="width:150px;">Approved Member</td>
					@endif
					<td>
						@if( $member['is_approved'] == 0 )
						<a class="btn btn-success approve" data-id="{{ $member->id }}"><i class="fa fa-user-plus"></i> Approve</a>
						@elseif( $member['is_approved'] == 1 )
						<a class="btn btn-danger remove" data-id="{{ $member->id }}"><i class="fa fa-close"></i> Remove</a>
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
	$(".approve").click(function(event) {
		event.preventDefault();
		$.post('/community/approve_member',{id:$(this).attr('data-id')},function(html){
			alert('Approve Member Success');
			window.location.reload();
		});     
	});

	$(".remove").click(function(event) {
		event.preventDefault();
		$.post('/community/remove_member',{id:$(this).attr('data-id')},function(html){
			alert('Remove Member Success');
			window.location.reload();
		});     
	});
});
</script>
@stop