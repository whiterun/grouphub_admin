<?php

class CommunityController extends BaseController
{
	function __construct()
	{
		$this->community = new Community();
	}

	public function index()
	{
		$show = "";
		if (Input::get('search')) {
			$show = $this->community->where('name', 'LIKE', '%'. Input::get('search') . '%')
	                        ->orwhere('call_for_members', 'LIKE', '%'. Input::get('search') . '%')
	                        ->orwhere('contact_person', 'LIKE', '%'. Input::get('search') . '%')
	                        ->orwhere('phone', 'LIKE', '%'. Input::get('search') . '%')
	                        ->paginate(30);
		}else{
			$show = $this->community->paginate(30);
		}
		$data = array(
			"kolom" => ['id', 'name', 'contact_person', 'status'],
			//"kolom" => ['id', 'name', 'contact_person', 'phone', 'status'],
			"tabel" => $show
		);
		return View::make('community.index', compact ( 'data' ));
	}
	
	public function create()
	{
		$show = $this->community->all();
		$data = array(
			"kolom" => Schema::getColumnListing('community'),
			"tabel" => $show
		);
		return View::make('community.create', compact('data'));
	}

	public function store()
	{
		$id = Input::get('id');
		$community = new community;
		if(!isset($id)):
			// insert menyusul
		else:
			$update = $this->community->find($id);
			$update->name_uri = Input::get('name_uri');
			$update->community_category_id = Input::get('community_category_id');
			$update->description = Input::get('description');
			$update->looking_for = Input::get('looking_for');
			$update->call_for_members = Input::get('call_for_members');
			$update->email = Input::get('email');
			$post = $update->save();
			if($post):
				Session::flash('success','Update Success');
				return Redirect::to('/community');
			else:
				Session::flash('error', 'Update Failed');	
				return Redirect::to('/community');
			endif;	
		endif;
	}

	public function detail($id)
	{
		$show = $this->community->find($id);
		$data = array(
			"kolom" => Schema::getColumnListing('community'),
			"tabel" => $show
		);
		return View::make('community.detail', compact('data'));
	}

	public function edit($id)
	{
		$data['show'] = $this->community->find($id);
		return View::make('community.edit', $data);
	}

	public function setInactive($id)
	{
		$community = Community::find($id);
		$community->status = 2;
		$community->save();

		return Redirect::to('/community');	
	}

	public function setActivate($id)
	{
		$community = Community::find($id);
		$community->status = 1;
		$community->save();

		return Redirect::to('/community');
	}

	public function Member($id)
	{
		$member = Members::with('user')->where('community_id', $id)->where('role', 3)->get();
		$community = $this->community->find($id);
		$data = [ 
			'members' => $member,
			'community' => $community,
		];
		return View::make('community.member', $data);
	}

	public function approveMember()
	{
			$id = Input::get('id');
			$approve = Members::find($id);
			$approve->is_approved = 1;
			$approve->save();

			return Redirect::back();
	}

	public function removeMember()
	{
		$id = Input::get('id');
		$remove = Members::where('role', 3)->where('id', $id)->delete();

		return Redirect::back();
	}
	
	public function organizer($id)
	{
		$community = $this->community->find($id);
		$organizer = Members::with('user')->where('community_id', $id)->get();
		$data = [
			'organizer' => $organizer,
			'community' => $community,
		];
		return View::make('community.organizer', $data);
	}

	public function setOrganizer()
	{
		$id = Input::get('id');
		$set = Members::find($id);
		$set->role = 2;
		$set->save();

		return Redirect::back();
	}

	public function removeOrganizer()
	{
		$id = Input::get('id');
		$removeOrg = Members::where('role', 2)->where('id', $id)->update(['role' => '3']);

		return Redirect::back();
	}

	public function creator($id)
	{
		$creator = Members::with('user')->where('community_id', $id)->whereBetween('role', array(1,2))->get();
		$community = $this->community->find($id);
		$data = [ 
			'creator' => $creator,
			'community' => $community,
		];
		return View::make('community.creator', $data);
	}

	public function transferCreator()
	{
		$id = Input::get('id');
		$setCreator = Members::find($id);
		$setCreator->role = 1;
		$setCreator->save();

		return Redirect::back();
	}
}