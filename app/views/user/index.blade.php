@extends('layout')
@section('content')

<div class="alert alert-{{ count($data['tabel']) > 0 ? 'success' : 'danger' }}" {{ Input::get('search') ? '' : 'style="display:none;"' }} >
	<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
	@if(count($data['tabel']))
	<h4><i class="fa fa-check"></i> {{ count($data['tabel']) }} User data found</h4>
	@else
	<h4><i class="fa fa-ban"></i> User not found </h4>
	@endif
</div>
@if(!empty(Session::get('success')))
	<div class="alert alert-success">
		<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
		<i class="fa fa-check"></i> {{ Session::get('success') }}
	</div>
@endif

@if(!empty(Session::get('error')))
	<div class="alert alert-success">
		<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
		<i class="fa fa-ban"></i> {{ Session::get('error') }}
	</div>
@endif

@if(!empty(Session::get('delete_success')))
	<div class="alert alert-success">
		<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
		<i class="fa fa-check"></i> {{ Session::get('delete_success') }}
	</div>
@endif
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">
    	<i class="fa fa-user"></i>
    	User Account
    </h3>
    <div class="box-tools pull-right">
      <div class="has-feedback">
		<form style="float:right;" action="{{ route('index_user') }}" method="get">
			<input type="text" name="search" class="form-control input-sm"  placeholder="Search User" value="{{ Input::get('search')}}" />
			<span class="glyphicon glyphicon-search form-control-feedback"></span>
		</form>
      </div>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
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
				@if ($db == 'created_at' || $db == 'updated_at')
				<td style="width:10px;">{{ $table->$db->format('M jS, Y') }}</td>
				@elseif($db == 'email')
				<td style="width:10px;">{{ $table->$db }}</td>
				@else
				<td style="width:100px;">{{ ($db == 'name_uri') ? url('').'/'.$table->$db : $table->$db }}</td>
				@endif
			@endforeach
			<td style="width:30px;">
				<div class="btn-group">
  					<button type="button" class="btn btn-primary">Action</button>
  					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    				<span class="caret"></span>
   	 				<span class="sr-only">Toggle Dropdown</span>
  					</button>
				  <ul class="dropdown-menu">
				  	<li><a href="user/edit/{{ $table->id }}"><i class="fa fa-pencil"></i> Manage profile</a></li>
				  	<li><a href="user/destroy/{{ $table->id }}"><i class="fa fa-trash"></i> Delete User</a></li>
				  </ul>
				</div>
			</td>
			</tr>
			@endforeach
			</tbody>
			</table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
<ul class="pager">
	{{ $data['tabel']->appends(array('search' => Input::get('search')))->links() }}
</ul>
@endsection