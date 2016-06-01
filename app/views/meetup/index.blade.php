@extends('layout')
@section('content')

<div class="alert alert-{{ count($data['tabel']) > 0 ? 'success' : 'danger' }}" {{ Input::get('search') ? '' : 'style="display:none;"' }} >
	<button type="button" class="close"  data-dismiss="alert">×</button>
		@if(count($data['tabel']))
		<h4> Ditemukan {{ count($data['tabel']) }} data</h4>
		@else
		<h4> Data yang anda cari tidak ditemukan </h4>
		@endif
</div>
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">
			<i></i>
			Meetup
		</h3>
		<div class="box-tools pull-right">
	      <div class="has-feedback">
			<form style="float:right;" action="{{ route('index_meetup') }}" method="get">
				<input type="text" name="search" class="form-control input-sm"  placeholder="Search meetup" value="{{ Input::get('search')}}" />
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
					<th> Action </th>
				</tr>
			</thead>
			<tbody>
						@foreach($data['tabel'] as $table)
				<tr>
						@foreach($data['kolom'] as $db)
						@if ($db == 'time_start' || $db == 'time_end')
							<td style="width:auto;">{{ date('d M Y H:i',$table->$db) }}</td>
						@else
							<td style="width:auto;">{{ $table->$db }}</td>
						@endif
						@endforeach
					<td style="width:140px;" >
						<a href="meetup/detail/{{ $table->id }}" class="btn btn-primary">Show</a>
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