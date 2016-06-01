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
					<th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $members as $member )
				<tr>
					<td>{{ $member['user']['id'] }}</td>
					<td>{{ $member['user']['name'] }}</td>
					<td>{{ $member['user']['email'] }}</td>
					@if( $member['role'] == 1 )
					<td style="width:150px;"> Creator</td>
					@elseif( $member['role'] == 2 )
					<td style="width:150px;"> Organizer</td>
					@elseif( $member['role'] == 3 )
					<td style="width:150px;">
						@if( $member['is_approved'] == 1 )
						 Approved Member
						@elseif( $member['is_approved'] == 0 )
						Pending
						@endif
					</td>
					@endif
					<td>
						@if( $member['role'] == 1 )
						<span class="label label-warning">
							Creator
						</span>
						@elseif( $member['role'] == 2 )
						<div class="btn-group">
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"">
								<span>Action</span>
								<span class="caret"></span>
							</button>
		  					<ul class="dropdown-menu">
		  						<li>
		  							<a data-id="{{ $member->id }}" class="transfer"><i class="fa fa-hand-o-right"></i>Transfer Creator</a>
		  							<a data-id="{{ $member->id }}" class="remove_organizer"><i class="fa fa-trash"></i> Remove Organizer</a>
		  						</li>
		  					</ul>
						</div>
						@elseif( $member['role'] == 3 )
						<div class="btn-group">
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"">
								<span>Action</span>
								<span class="caret"></span>
							</button>
		  					<ul class="dropdown-menu">
		  						<li>
		  							@if( $member['is_approved'] == 0 )
		  							<a data-id="{{ $member->id }}" class="approve"><i class="fa fa-hand-o-right"></i>Aprrove Member</a>
		  							@endif
		  							@if( $member['is_approved'] == 1)
		  							<a data-id="{{ $member->id }}" class="set_organizer"><i class="fa fa-user-plus"></i> Set as Organizer</a>
		  							@endif
		  							<a data-id="{{ $member->id }}" class="remove_member"><i class="fa fa-trash"></i> Remove member</a>
		  						</li>
		  					</ul>
						</div>
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

	$(".remove_member").click(function(e) {
		e.preventDefault();
		$.post('/community/remove_member',{id:$(this).attr('data-id')},function(html){
			alert('remove Member Success');
			window.location.reload();
		});     
	});

	$(".remove_organizer").click(function(event) {
		event.preventDefault();
		$.post('/community/removeOrganizer',{id:$(this).attr('data-id')},function(html){
			alert('Remove Organizer Success');
			window.location.reload();
		});     
	});

	$(".set_organizer").click(function(event) {
		event.preventDefault();
		$.post('/community/setOrganizer',{id:$(this).attr('data-id')},function(html){
			alert('Set Organizer Success');
			window.location.reload();
		});     
	});

	$(".transfer").click(function(event) {
		event.preventDefault();
		$.post('/community/transfer_creator',{id:$(this).attr('data-id')},function(html){
			alert('Set creator success');
			window.location.reload();
		});     
	});
});
</script>
@stop