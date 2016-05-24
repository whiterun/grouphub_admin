<?php

class eventController extends BaseController {

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

	public function create()
	{
		$show = $this->event->all();
		$data = array(
			"kolom" => Schema::getColumnListing('event'),
			"tabel" => $show
		);
		return View::make ('event.create',compact('data'));
	}

	public function store()
	{
		$id = Input::get('id');
		if(!isset($id)):
			// insert menyusul 
		else:
			
			$update = $this->event->find($id);
			$update->title = Input::get('title');
			$update->city_id  = Input::get('city_id');
			$update->location = Input::get('location');
			$update->address  = Input::get('address');
			$update->community_id  = Input::get('community_id');
			$post = $update->save();
			if($post):
				return Redirect::to('/event/?aksi=updatesukses');
			else:	
				return Redirect::to('/event/?aksi=updategagal');
			endif;
		endif;
	}

	public function detail($id)
	{
		$show = $this->event->find($id);
			$data = array(
			"kolom" => Schema::getColumnListing('event'),
			"tabel" => $show
		);
		return View::make ( 'event.detail', compact ( 'data' ) );
	}

	public function edit($id)
	{
		$show = $this->event->find($id);
		$data = array(
			"kolom" => Schema::getColumnListing('event'),
			"tabel" => $show
		);
		return View::make ( 'event.edit', compact ( 'data' ) );
	}

	public function destroy($id)
	{		
		//$delete = $this->event->find($id);
		//$delete->delete();	
		return Redirect::to('/event/?aksi=hapussukses');
	}
	
	public function guest( $id )
	{
		$perPage = 15;
		
		$page = (int) Input::get('page');

		$event	= AppEvents::getSingleData( $id, NULL, TRUE, 'events' );
		
		$totalItems = API::get('graph/events/'.$event['slug'].'/guests?limit=no&get=total');
		
		$totalItems = (int) $totalItems['data']['total'];
		
		$totalPages = ceil($totalItems / $perPage);

		if ( $page > $totalPages || $page < 1 ) $page = 1;

		$guests = API::get('graph/events/'.$event['slug'].'/guests?limit='.$perPage.'&page='.$page);
		
		$data = [
			'event'		=> $event,
			'view'		=> $guests['data'],
			'paging'	=> Paginator::make( $guests['data'], $totalItems, $perPage )->links(),
		];
		
		return View::make ( 'event.guest', compact ( 'data' ) );
	}
	
	public function approveGuest( $id )
	{
		$m = API::put('graph/guests/'.$id, [ 'is_approve' => 1 ]);

		if( $m['status'] == 'success' )
		{
			return Redirect::back()->with('success', 'Success Approved');
		}

		return Redirect::back()->with('failed', 'Failed to Approved user');
	}
	
	public function removeGuest( $id )
	{
		$m = API::delete('graph/guests/'.$id);

		if( $m['status'] == 'success' )
		{
			return Redirect::back()->with('success', $m['message']);
		}

		return Redirect::back()->with('failed', $m['message']);
	}
	
	public function organizer( $id )
	{
		$perPage = 15;
		
		$page = (int) Input::get('page');

		$event	= AppEvents::getSingleData( $id, NULL, TRUE, 'events' );
		
		$totalItems = API::get('graph/events/'.$event['slug'].'/all_guests?is_approved=yes&limit=no&get=total');
		
		$totalItems = (int) $totalItems['data']['total'];
		
		$totalPages = ceil($totalItems / $perPage);

		if ( $page > $totalPages || $page < 1 ) $page = 1;

		$guests = API::get('graph/events/'.$event['slug'].'/all_guests?is_approved=yes&limit='.$perPage.'&page='.$page);
		
		$data = [
			'event'		=> $event,
			'view'		=> $guests['data'],
			'paging'	=> Paginator::make( $guests['data'], $totalItems, $perPage )->links(),
		];
		
		return View::make ( 'event.organizer', compact ( 'data' ) );
	}
	
	public function setOrganizer( $id )
	{
		$get = API::get('graph/guests/'.$id);
		
		$coreTotal = API::get('graph/events/'.$get['data']['event_id'].'/organizers?is_approved=yes&limit=no&get=total');
		
		$api = API::post('graph/organizers', [
			'alias'		=> 'organizer',
			'position'	=> $coreTotal['data']['total'] + 1,
			'event_id'	=> $get['data']['event_id'],
			'user_id'	=> $get['data']['user_id'],
		]);
		
		if( $api['status'] == 'success' )
		{
			return Redirect::back()->with('success', 'Success set Organizer');
		}

		return Redirect::back()->with('failed', 'Failed to set Organizer');
	}
	
	public function removeOrganizer( $id )
	{
		$m = API::delete('graph/organizers/'.$id);

		if( $m['status'] == 'success' )
		{
			return Redirect::back()->with('success', $m['message']);
		}

		return Redirect::back()->with('failed', $m['message']);
	}
	
	public function transferCreator( $id )
	{
		$perPage = 15;
		
		$page = (int) Input::get('page');

		$event	= AppEvents::getSingleData( $id, NULL, TRUE, 'events' );
		
		$totalItems = API::get('graph/events/'.$event['slug'].'/organizers?is_approved=yes&limit=no&get=total');
		
		$totalItems = (int) $totalItems['data']['total'];
		
		$totalPages = ceil($totalItems / $perPage);

		if ( $page > $totalPages || $page < 1 ) $page = 1;

		$creator = API::get('graph/events/'.$event['slug'].'/creators');
		
		$guests = API::get('graph/events/'.$event['slug'].'/organizers?is_approved=yes&limit='.$perPage.'&page='.$page);
		
		$data = [
			'event'		=> $event,
			'view'		=> $guests['data'],
			'creator'	=> $creator['data'][0],
			'paging'	=> Paginator::make( $guests['data'], $totalItems, $perPage )->links(),
		];
		
		return View::make ( 'event.creator', compact ( 'data' ) );
	}
	
	public function setCreator( $slug, $id )
	{
		$event		= AppEvents::getSingleData( $slug, NULL, TRUE, 'events' );
		$creator	= AppEvents::getSingleData( $slug, 'creators', TRUE, 'events' );
		$coreTotal	= AppEvents::getSingleData( $slug, 'organizers?is_approved=yes&limit=no&get=total', TRUE, 'events' );
		
		$result = API::put('graph/events/'.$slug.'/creators', [
			'new_creator'		=> $id,
			'old_creator'		=> $creator[0]['id'],
			'total_organizer'	=> $coreTotal['total'],
		]);
		
		if( $result['status'] == 'success' )
		{
			return Redirect::back()->with('success', 'Success Transfer Ownership');
		}
		
		return Redirect::back()->with('failed', 'Failed to Transfer Ownership');
	}
}
