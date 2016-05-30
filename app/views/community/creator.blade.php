@extends('layout')
@section('content')

<div class="box box-info">
	<div class="box-header with-border">
		<h4 class="box-title">
			<i class="fa fa-user-plus"></i>
			Creator {{ $community->name }}
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
					<th>Transfer Creator</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $creator as $db )
				<tr>
					<td>{{ $db['user']['id'] }}</td>
					<td>{{ $db['user']['name'] }}</td>
					<td>{{ $db['user']['email'] }}</td>
					@if( $db['role'] == 2 )
					<td style="width:150px;">Approved Organizer</td>
					@elseif( $db['role'] == 1 )
					<td style="width:150px;">Creator</td>
					@endif
					<td>
						@if( $db['role'] == 2 )
						<a data-id="{{ $db->id }}" class="btn btn-success creator"><i class="fa fa-user-plus"></i> Set Creator</a>
						@elseif( $db['role'] == 1)
						<span class="label label-primary"><i class="fa fa-ban"></i> Creator</span>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<a href="{{ route('index_community') }}" class="btn btn-default"><i class="fa fa-reply"></i> back</a>
	</div>
</div>
@endsection
@section('script')
@parent
<script type="text/javascript">
$(function(){
	$(".creator").click(function(e) {
		e.preventDefault();
		$.post('/community/transfer_creator',{id:$(this).attr('data-id')},function(html){
			alert('Set Creator Success');
			window.location.reload();
		});     
	});
});
</script>
@stop