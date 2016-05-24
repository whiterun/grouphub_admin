@extends('layout')
@section('content')

<div class="container-fluid">
	<div class="box box-info">
		<div class="box-header">
			<h4>
				<i class="fa fa-check"></i>
				Detail Community
			</h4>
		</div>
		<div class="box-body">
			<table id="example2" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="width:300px;" class="text-center">Identitas</th>
						<th style="width:400px;" class="text-center">Keterangan</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data['kolom'] as $db)
						@if($db == 'time_created' || $db == 'time_updated' )
						<tr>
							<td>{{ $db }}</td>
							<td>{{ date('d M Y H:i',$data['tabel']->$db) }}</td>
						</tr>
						@else
						<tr>
							<td>{{ $db }}</td>
							<td> {{ $data['tabel']->$db }}</td>
						</tr>
						@endif
						@endforeach
				</tbody>
			</table>
		</div>
		<div class="box-footer">
			{{ HTML::linkRoute('index_community', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	</div>
</div>
@endsection