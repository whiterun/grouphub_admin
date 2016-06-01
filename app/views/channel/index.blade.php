@extends('layout')
@section('content')

<div class="alert alert-{{ count($data['tabel']) > 0 ? 'success' : 'danger' }}" {{ Input::get('search') ? '' : 'style="display:none;"' }} >
	<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
	@if(count($data['tabel']))
	<h4><i class="fa fa-check"></i> {{ count($data['tabel']) }} data found</h4>
	@else
	<h4><i class="fa fa-ban"></i> not found </h4>
	@endif
</div>

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">
			<i class="fa fa-share-alt"></i>
			Channels
		</h3>
		<div class="box-tools pull-right">
     	 	<div class="has-feedback">
				<form style="float:right;" action="channel" method="get">
					<input type="text" name="search" class="form-control input-sm"  placeholder="Search Channel" value="{{ Input::get('search')}}" />
					<span class="glyphicon glyphicon-search form-control-feedback"></span>
				</form>
     	 	</div>
    	</div>
	</div>
	<div class="box-body">
		<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
			<thead>
				<tr class='thefilter'>
					@foreach($data['kolom'] as $db)
					<th>{{ $db }}</th>
					@endforeach
					<th> Aksi </th>
				</tr>
			</thead>
			<tbody>
				@foreach($data['tabel'] as $table)
				<tr>
					@foreach($data['kolom'] as $db)
					@if ($db == 'time_created' || $db == 'time_updated')
						<td style="width:auto;">{{ date('d M Y H:i',$table->$db) }}</td>
					@else
						<td style="width:auto;">{{ $table->$db }}</td>
					@endif
					@endforeach
					<td style="width:140px;" >
						<a href="channel/detail/{{ $table->id }}" class="btn btn-primary">Show</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<ul class="pager">
	{{ $data['tabel']->appends(array('search' => Input::get('search')))->links() }}
</ul>
@endsection