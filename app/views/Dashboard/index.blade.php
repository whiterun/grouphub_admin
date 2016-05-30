@extends('layout')
@section('content')

<div class="row">
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="small-box bg-yellow">
	        <div class="inner">
	        	<h3>{{ $user }}</h3>
	        	<p>Users Total</p>
	        </div>
	        <div class="icon">
	            <i class="ion ion-ios-people-outline"></i>
	        </div>
	        <a href="{{ route('index_user') }}" class="small-box-footer">
	            More info <i class="fa fa-arrow-circle-right"></i>
	        </a>
    	</div>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="small-box bg-red">
	        <div class="inner">
	        	<h3>{{ $community }}</h3>
	        	<p>Comunity Total</p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-users"></i>
	        </div>
	        <a href="{{ route('index_community') }}" class="small-box-footer">
	            More info <i class="fa fa-arrow-circle-right"></i>
	        </a>
    	</div>
	</div>
	<div class="clearfix visible-sm-block"></div>
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="small-box bg-green">
	        <div class="inner">
	        	<h3>{{ $event }}</h3>
	        	<p>Events Total</p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-calendar"></i>
	        </div>
	        <a href="{{ route('index_event') }}" class="small-box-footer">
	            More info <i class="fa fa-arrow-circle-right"></i>
	        </a>
    	</div>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="small-box bg-aqua">
	        <div class="inner">
	        	<h3>{{ $member }}</h3>
	        	<p>Members Total</p>
	        </div>
	        <div class="icon">
	            <i class="ion ion ion-person-add"></i>
	        </div>
	        <a href="{{ route('index_community') }}" class="small-box-footer">
	            More info <i class="fa fa-arrow-circle-right"></i>
	        </a>
    	</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="box">
			<div class="box-header with-border box-primary">
				<h3 class="box-title">
					Grouphub Statistic
				</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-8">
						<p class="text-center">
							<strong>Statistic</strong>
						</p>
						<div class="chart">
							<canvas id="areaChart" style="height: 200px; width: 542px;" width="542" height="139"></canvas>
						</div>
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="box">
			<div class="box-header with-border box-primary">
				<h4 class="box-title">
					Browser Usage
				</h4>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-8">
		                <div class="chart-responsive">
		                   <canvas id="pieChart" height="160" width="200" style="width: 200px; height: 160px;"></canvas>
		                </div>
                  		<!-- ./chart-responsive -->
                  	</div>
                  	<div class="col-md-4">
	                  <ul class="chart-legend clearfix">
	                    <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
	                    <li><i class="fa fa-circle-o text-green"></i> IE</li>
	                    <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
	                    <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
	                    <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
	                    <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
	                  </ul>
                	</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@include('dashboard.script')
@stop
@endsection