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

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">
    	<i class="fa fa-calendar"></i>
    	Events
    </h3>
    <div class="box-tools pull-right">
      <div class="has-feedback">
		<form style="float:right;" action="event" method="get">
			<input type="text" name="search" class="form-control input-sm"  placeholder="Search Events" value="{{ Input::get('search')}}" />
			<span class="glyphicon glyphicon-search form-control-feedback"></span>
		</form>
      </div>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
  	<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
  		<thead>
  			<tr role="row">
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
				@if ($db == 'created_at' || $db == 'updated_at')
				<td>{{ $table->$db->format('M jS, Y') }}</td>
				@else
				<td style="width:auto;">{{ $table->$db }}</td>
				@endif
				@endforeach
				<td style="width:180px;">
					<div class="btn-group">
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"">
							<span>Action</span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a href="event/detail/{{ $table->id }}"><i class="fa fa-search-plus"></i> Preview</a>
							</li>
						    <li>
						    	<a href="#"><i class="fa fa-users"></i> Manage Guest</a>
						    </li>
						    <li>
						    	<a href="#"><i class="fa fa-hand-o-right"></i> Set Organizer</a>
						    </li>
						    <li>
						    	<a href="#"><i class="fa fa-pencil"></i> Transfer Creator</a>
						    </li>
						</ul>
					</div>
					<a href="#" class="btn btn-warning"><i class="fa fa-pencil-square"></i> Edit</a>
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