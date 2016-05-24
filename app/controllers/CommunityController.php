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
			// "kolom" => ['id', 'name', 'contact_person', 'phone', 'status'],
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
			// insertnya belum 
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
		return $member = Members::where('community_id')->get();
		//$member = 
	}

	public function approveMember($id)
	{
		$approve = Members::where(['is_approve', 1])->get();

		if ($approve['status'] == 'success') {
			return Redirect::back()->with('flash_notice', 'Success to Approve member');
		}
		return Redirect::back()->with('flash_notice', 'Failed to Approve member');
	}

	public function removeMember($id)
	{
		$remove = Members::where('role', 3)->where('id', $id)->delete();

		if ($remove['status'] == 'success') {
			return Redirect::back()->with('flash_notice', 'Delete success');
		}
		return Redirect::back()->with('flash_notice', 'Delete failed');
	}
}