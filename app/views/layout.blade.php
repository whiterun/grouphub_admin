<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{ $page_title or "Grouphub Dashboard" }}</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.2 -->
		<link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<!-- Font Awesome Icons -->
		<link href="{{ asset('assets/font-awesome-4.6.3/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
		<link href="{{ asset('assets/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
		<link href="{{ asset('assets/dist/css/skins/skin-blue.min.css') }}" rel="stylesheet" type="text/css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
	</head>
	<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
	<!-- the fixed layout is not compatible with sidebar-mini -->
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<!-- Site wrapper -->
		    <!-- Header -->
			@include('header')

			<!-- Sidebar -->
			@include('sidebar')

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				{{--
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						{{ $page_title or "Groubhub admin" }}
						<small>{{ $page_description or null }}</small>
					</h1>
					<!-- You can dynamically generate breadcrumbs here -->
					<ol class="breadcrumb">
						<li><a href="{{ route('index_dashboard') }}"><i class="fa fa-dashboard"></i>dashboard</a></li>
						<li class="active">Here</li>
					</ol>
				</section>
				--}}

				<!-- Main content -->
				<section class="content">
					<!-- Your Page Content Here -->
					@yield('content')
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

			<!-- Footer -->
			@include('footer')

		<!-- ./wrapper -->
        @section('script')
        	<!-- jQuery 2.1.4 -->
			<script src="{{ asset('assets/js/jquery/jquery-2.1.4.min.js') }}"></script>
			<!-- Bootstrap 3.3.2 -->
			<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
			<!-- SlimScroll -->
			<script src="{{ asset('assets/js/slimScroll/jquery.slimscroll.min.js') }}"></script>
			<!-- FastClick -->
			<script src="{{ asset('assets/js/fastclick/fastclick.min.js') }}"></script>
			<!-- AdminLTE App -->
			<script src="{{ asset('assets/dist/js/app.min.js') }}"></script>
	    @show
	</body>
</html>