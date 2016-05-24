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

@if(Session::has('inactive'))
	<div class="alert alert-success">
		<button type="button" class="close fa fa-close"  data-dismiss="alert"></button>
		<i class="fa fa-check"></i> {{ Session::get('inactive') }}
	</div>
@endif

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">
    	<i class="fa fa-users"></i>
    	Community
    </h3>
    <div class="box-tools pull-right">
      <div class="has-feedback">
		<form style="float:right;" action="community" method="get">
			<input type="text" name="search" class="form-control input-sm"  placeholder="Search Community" value="{{ Input::get('search')}}" />
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
				<td style="width:20px;">{{ $table->$db->format('M jS, Y') }}</td>
				@elseif ( $db == 'status' )
				@if ( $table->$db == 1 )
				<td class="text-success" style="width:20px;">Active</td>
				@elseif ( $table->$db == 2 )
				<td class="text-error" style="width:20px;">Inactive</td>
				@endif
				@else
				<td style="width:20px;">{{ ($db == 'name_uri') ? url('').'/'.$table->$db : $table->$db }}</td>
				@endif
			@endforeach
			<td style="width:70px;">
				<div class="btn-group">
  					<button type="button" class="btn btn-primary">Action</button>
  					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    				<span class="caret"></span>
   	 				<span class="sr-only">Toggle Dropdown</span>
  					</button>
				  <ul class="dropdown-menu">
				    <li><a href="community/detail/{{ $table->id }}"><i class="fa fa-search-plus"></i> Preview</a></li>
				    <li><a href="community/member/{{ $table->id }}"><i class="fa fa-users"></i> Manage Member</a></li>
				    <li><a href="#"><i class="fa fa-hand-o-right"></i> Set Organizer</a></li>
				    <li><a href="#"><i class="fa fa-paper-plane"></i> Transfer Creator</a></li>
				 	
				 	@if( $table->status == 1 )
				 	<li>
				 		<a class="inactive" href="community/set-inactive/{{$table->id}}"><i class="fa fa-lock"></i> Set Inactive</a>
				 	</li>
				 	@endif
				 	
				 	@if( $table->status == 2 )
				 	<li>
				 		<a class="activate" href="community/set-Activate/{{$table->id}}"><i class="fa fa-unlock"></i> Set Activate</a>
				 	</li>
				 	@endif
				 	<li><a href="community/edit/{{ $table->id }}"><i class="fa fa-pencil"></i> Edit</a></li>
				  </ul>
				</div>
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
@section('script')
@parent
<script type="text/javascript">
$(".inactive").click(function(event) {
	event.preventDefault();
	$.post($(this).attr('href'), function(html){
		alert('success set inactive');
		window.location.reload();
	});     
});

$(".activate").click(function(e){
	e.preventDefault();
	// alert data
	$.post($(this).attr('href'), function(data){
		alert('success set activate');
		window.location.reload();
	});
});
</script>
@stop