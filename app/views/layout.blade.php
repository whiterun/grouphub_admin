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
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Ionicons -->
		<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
		<link href="{{ asset('assets/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->
		<link href="{{ asset('assets/dist/css/skins/skin-blue.min.css') }}" rel="stylesheet" type="text/css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
	<!-- the fixed layout is not compatible with sidebar-mini -->
	<body class="hold-transition skin-blue fixed sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
		
			<!-- Header -->
			@include('header')
			
			<!-- Sidebar -->
			@include('sidebar')

		<!-- =============================================== -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		<h1>
		Fixed Layout
		<small>Blank example to the fixed layout</small>
		</h1>
		<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Layout</a></li>
		<li class="active">Fixed</li>
		</ol>
		</section>

		<!-- Main content -->
		<section class="content">
		<div class="callout callout-info">
		<h4>Tip!</h4>
		<p>Add the fixed class to the body tag to get this layout. The fixed layout is your best option if your sidebar is bigger than your content because it prevents extra unwanted scrolling.</p>
		</div>
		<!-- Default box -->
		<div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Title</h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
			<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
		  </div>
		</div>
		<div class="box-body">
		  Start creating your amazing application!
		</div><!-- /.box-body -->
		<div class="box-footer">
		  Footer
		</div><!-- /.box-footer-->
		</div><!-- /.box -->

		</section><!-- /.content -->
		</div><!-- /.content-wrapper -->
		
			<!-- Footer -->
			@include('footer')
		
		</div><!-- ./wrapper -->

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
	</body>
</html>