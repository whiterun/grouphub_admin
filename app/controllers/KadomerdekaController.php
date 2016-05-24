<?php

class KadomerdekaController extends BaseController { 
	
	public function __construct(){
         $this->Kadomerdeka = new Kadomerdeka();
    }

	public function index()
	{	
		$show = "";
		if(Input::get('search')) {
	        $show = $this->Kadomerdeka->where('community_id', 'LIKE', '%'. Input::get('search') . '%')
	                        ->orwhere('youtube_url', 'LIKE', '%'. Input::get('search') . '%')
	                        ->paginate(20);
	    } else {
	       	$show = $this->Kadomerdeka->paginate(20);
	    }
		$data = array(
			"kolom" => Schema::getColumnListing('kadomerdeka'),
			"tabel" => $show
		);
		return View::make ( 'kadomerdeka.index', compact ( 'data' ) );
	}

	public function create()
	{
		$show = $this->Kadomerdeka->all();
		$data = array(
			"kolom" => Schema::getColumnListing('kadomerdeka'),
			"tabel" => $show
		);
		return View::make ('kadomerdeka.create',compact('data'));
	}

	public function store()
	{
		$id = Input::get('id');
		$kadomerdeka = new Kadomerdeka;
		if(!isset($id)):
			$community_id = Input::get('community_id');
			$community_id = !empty($community_id) ? $community_id : 'null';
			$youtube_url = Input::get('youtube_url');
			$findme   = 'http:://www.grouphub.me';
			$pos = strpos($community_id, $findme);
			if($pos == 0 && isset($community_id) && isset($youtube_url)):
					$community_id = str_replace("http://www.grouphub.me/", "", $community_id);
					if(count(Input::get()) > 1):
						$b = 0;
						$errno = 0;
						for($i=0;$i<count(Input::get('youtube_url'));$i++):
							$postMultiple = new Kadomerdeka;
							//$postMultiple->community_id = $community_id[$i];
							$postMultiple->community_id = $community_id;
							$postMultiple->youtube_url  = $youtube_url[$i];
							$post = $postMultiple->save();		
							if($post):
								$b += 1;
							endif;
						endfor;
						if($b > 0):
							return Redirect::to('/kadomerdeka/?aksi=simpansukses');
						else:	
							return Redirect::to('/kadomerdeka/?aksi=simpangagal');
						endif;
					else:
						$kadomerdeka->community_id = Input::get('community_id');
						$kadomerdeka->youtube_url = Input::get('youtube_url');
						$post = $kadomerdeka->save();
						if($post):
							return Redirect::to('/kadomerdeka/?aksi=simpansukses');
						else:	
							return Redirect::to('/kadomerdeka/?aksi=simpangagal');
						endif;
					endif;
			else:
				return Redirect::to('/kadomerdeka/?aksi=simpangagal&error=0');
			endif;
		else:
			$update = $this->Kadomerdeka->find($id);
			$update->community_id = Input::get('community_id');
			$update->youtube_url = Input::get('youtube_url');
			$post = $update->save();
			if($post):
				return Redirect::to('/kadomerdeka/?aksi=updatesukses');
			else:	
				return Redirect::to('/kadomerdeka/?aksi=updategagal');
			endif;	
		endif;
	}
	/*
	public function show($id)
	{

	}
	*/

	public function edit($id)
	{
		$show = $this->Kadomerdeka->find($id);
		$data = array(
			"kolom" => Schema::getColumnListing('kadomerdeka'),
			"tabel" => $show
		);
		return View::make ( 'kadomerdeka.edit', compact ( 'data' ) );
	}

	public function destroy($id)
	{		
		$delete = $this->Kadomerdeka->find($id);
		$delete->delete();	
		return Redirect::to('/kadomerdeka/?aksi=hapussukses');
	}
	
	public function staticPage()
	{
		// get all video
		$videos = Kadomerdeka::all()->toArray();

		foreach ($videos as $i => $video)
		{
			$embed_html = EmbedVideo::convert($video['youtube_url'], 217, 147);

			$videos[$i]['embed_html'] = $embed_html;
		}
		
		return View::make ('kadomerdeka.staticpage', compact ('videos'));
	}	
}
