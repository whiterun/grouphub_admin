<?php

class UserController extends \BaseController {

	public function __construct()
	{
		$this->user = new User();
    }
	
	public function index()
	{
		Session::forget([ 'class', 'message' ]);
		
		if ( Input::has('search') )
		{
			$data['users'] = $this->user->where('name', 'LIKE', '%'. Input::get('search') . '%')
				->orwhere('email', 'LIKE', '%'. Input::get('search') . '%')
				->orwhere('username', 'LIKE', '%'. Input::get('search') . '%')
				->orwhere('password', 'LIKE', '%'. Input::get('search') . '%')
				->paginate(20);
			
			$count = count( $data['users'] );
			
			Session::flash('class', ( $count > 0 ? 'success' : 'danger' ) );
			Session::flash('message', 'Found '.$count.' User(s) with &ldquo;'.Input::get('search').'&rdquo; keyword');
		}
		else
		{
			$data['users'] = $this->user->paginate(20);
		}

		return View::make ( 'user.index', $data );
	}

	public function create()
	{
		$show = $this->user->all();
		$data = array(
			"kolom" => Schema::getColumnListing('user'),
			"tabel" => $show
		);
		return View::make ('user.create',compact('data'));
	}

	public function store()
	{
		$id = Input::get('id');
		$user = new user;
		if(!isset($id)):
			// insert menyusul 
		else:
			$targetdir = public_path().'/img/user/';
			$_FILES['imagefile']['name'];
        	if(!empty($file)){
        		$split =  preg_split('/[.]/', $file, -1, PREG_SPLIT_NO_EMPTY);
	        	$newname = str_replace($split[0],Input::get('id'),$file);
				$tem  = $_FILES['imagefile']['tmp_name'];
				move_uploaded_file($tem, $targetdir.$newname);
        	}        	
			$update = $this->user->find($id);
			$update->name = Input::get('username');
			$update->description = Input::get('description');
			$update->email = Input::get('email');
			$post = $update->save();
			if($post):
				Session::flash('success','Update Success');
				return Redirect::to('/user');
			else:	
				Session::flash('error','Update Failed');
				return Redirect::to('/community');
			endif;	
		endif;
		
	}

	public function detail($id)
	{
		$data['show'] = $this->user->find($id);
		return View::make ( 'user.detail', compact ( 'data' ) );
	}

	public function edit($id)
	{
		$data['show'] = $this->user->find($id);
		return View::make('user.edit', $data);
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->status = 3;
		$user->save();
		Session::flash('delete_success', 'Delete Success');
		return Redirect::back();
	}
}