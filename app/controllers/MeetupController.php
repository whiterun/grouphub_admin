<?php

class MeetupController extends \BaseController
{
	
	public function __construct()
	{
		$this->meetup = new Meetup();
	}

	public function index()
	{
		$show = "";
		if(Input::get('search')) {
	        $show = $this->meetup->where('title', 'LIKE', '%'. Input::get('search') . '%')
	                        ->orwhere('location', 'LIKE', '%'. Input::get('search') . '%')
	                        ->orwhere('time_start', 'LIKE', '%'. Input::get('search') . '%')
	                        ->orwhere('time_end', 'LIKE', '%'. Input::get('search') . '%')
	                        ->paginate(20);
	    } else {
	       	$show = $this->meetup->paginate(20);
	    }
		$data = array(
			//"kolom" => array('id','title','location','description','time_start','time_end'),
			"kolom" => array('id','title','location','time_start','time_end'),
			//"kolom" => Schema::getColumnListing('meetup'),
			"tabel" => $show
		);
		return View::make ( 'meetup.index', compact ( 'data' ) );
	}

	public function detail($id)
	{
		$show['data'] = $this->meetup->find($id);
		return View::make('meetup.detail', $show);
	}
}