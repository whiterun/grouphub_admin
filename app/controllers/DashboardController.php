<?php

class DashboardController extends \BaseController
{
	
	public function __construct()
	{
		$this->dashboard = new Dashboard ();
	}

	public function index()
	{
		$show['community'] = Community::where('status', '=', 1)->count();
		$show['user'] = User::where('status', '=', 1)->count();
		$show['member'] = Members::where('is_approved', '=', 1)->count();
		$show['event'] = Events::where('status', '=', 1)->count();
		return View::make('Dashboard.index', $show);
	}
}