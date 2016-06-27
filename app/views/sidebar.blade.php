<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
	<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ asset('assets/dist/img/avatar5.png') }}" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>{{ Auth::user()->name }}</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		{{--
		<!-- search form -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>
		<!-- /.search form -->
		--}}
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="treeview">
				<a href="{{ route('index_dashboard') }}">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="treeview">
				<a href="{{ route('index_user') }}">
					<i class="fa fa-user"></i> <span>User</span>
				</a>
			</li>
			<li class="treeview">
				<a href="{{ route('index_community') }}">
					<i class="fa fa-group"></i> <span>Community</span>
				</a>
			</li>
			<li class="treeview">
				<a href="{{ route('index_event') }}">
					<i class="fa fa-calendar"></i> <span>Event</span>
				</a>
			</li>
			<li class="treeview">
				<a href="{{ route('index_channel') }}">
					<i class="fa fa-share-alt"></i> <span>Channel</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-credit-card"></i> <span>Transaction</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<span>Newsletter</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="#">Newsleter Type</a></li>
					<li><a href="#">Newsleter Reminder</a></li>
				</ul>
			</li>
		</ul><!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>