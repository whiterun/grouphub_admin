<?php

class ChannelController extends \BaseController
{
	
	public function __construct()
	{
		$this->channel = new Channel();
	}

	public function index()
	{
		$show = "";
		if(Input::get('search')) {
	        $show = $this->channel->where('name', 'LIKE', '%'. Input::get('search') . '%')
	                        ->paginate(20);
	    } else {
	       	$show = $this->channel->paginate(20);
	    }
		$data = array(
			"kolom" => array('id','name','time_created','time_updated'),
			//"kolom" => Schema::getColumnListing('channel'),
			"tabel" => $show
		);

		return View::make ( 'channel.index', compact ( 'data' ) );
	}

	public function detail($id)
	{
		$data['show'] = $this->channel->find($id);
		return View::make('channel.detail', $data);
	}
}