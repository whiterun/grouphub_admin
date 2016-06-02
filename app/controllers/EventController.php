<?php

class EventController extends BaseController {

	public function __construct(){
		$this->event = new Events();
    }

    public function index()
    {
    	$show = "";
		if(Input::get('search')) {
	        $show = $this->event->where('id', 'LIKE', '%'. Input::get('search') . '%')
	                        ->orwhere('title', 'LIKE', '%'. Input::get('search') . '%')
	                        ->orwhere('location', 'LIKE', '%'. Input::get('search') . '%')
	                        ->paginate(20);
	    } else {
	       	$show = $this->event->paginate(20);
	    }
		
		$data = array(
			"kolom" => array('id','title','location'),
			//"kolom" => Schema::getColumnListing('Event'),
			"tabel" => $show
		);
		
		return View::make ( 'event.index', compact ( 'data' ) );
    }

    public function detail($id)
    {
    	$data['show'] = $this->event->find($id);
    	return View::make('event.detail', $data);
    }
}
