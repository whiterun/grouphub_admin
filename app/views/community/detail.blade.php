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
					<tr>
						<td>id</td>
						<td>{{ $data['id'] }}</td>
					</tr>
					<tr>
						<td>name</td>
						<td>{{ $data['name'] }}</td>
					</tr>
					<tr>
						<td>Community Category</td>
						<td>{{ $data['community_category_id'] }}</td>
					</tr>
					<tr>
						<td>Description</td>
						<td>{{ $data['description'] }}</td>
					</tr>
					<tr>
						<td>Benefit of joining</td>
						<td>{{ $data['benefit_of_joining'] }}</td>
					</tr>
					<tr>
						<td>Looking For</td>
						<td>{{ $data['looking_fir'] }}</td>
					</tr>
					<tr>
						<td>Call for members</td>
						<td>{{ $data['call_for_memebers'] }}</td>
					</tr>
					<tr>
						<td>Contact Person</td>
						<td>{{ $data['contact_person'] }}</td>
					</tr>
					<tr>
						<td>email</td>
						<td>{{ $data['email'] }}</td>
					</tr>
					<tr>
						<td>Website</td>
						<td><a href="{{ $data['website'] }}">{{ $data['website'] }}</a></td>
					</tr>
					<tr>
						<td>Facebook</td>
						<td><a href="{{ $data['facebook'] }}">{{ $data['facebook'] }}</a></td>
					</tr>
					<tr>
						<td>Twitter</td>
						<td><a href="{{ $data['twitter'] }}">{{ $data['twitter'] }}</a></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>{{ $data['address'] }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="box-footer">
			<a href="{{ route('index_community') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
		</div>
	</div>
</div>
@endsection