<?php

class CityController extends \BaseController {

	public function __construct()
	{
		$this->city = new Cities();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( Input::get('search') )
		{
			$cities = $this->city->where('name', 'LIKE', '%'. Input::get('search') . '%')
				->where('status', '!=', 3)
				->with('country');
			
			$count = count( $cities->get() );
			
			Session::flash( 'class', ( $count > 0 ? 'success' : 'danger' ) );
			Session::flash( 'message', 'Found '.$count.' City(es) with &ldquo;'.Input::get('search').'&rdquo; keyword' );
			
			$data['cities'] = $cities->paginate(20);
		}
		else
		{
			$data['cities'] = $this->city->where('status', '!=', 3)
				->with('country')
				->paginate(20);
		}
		
		return View::make( 'city.index', $data );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['countries'] = Countries::where('status', 1)->get();
		
		return View::make( 'city.create', $data );
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::get();
		
		$validation = Cities::validate( $input );
		
		if ( $validation->passes() )
		{
			Cities::create( $input );
			
			Session::flash( 'class', 'success' );
			Session::flash( 'message', 'A new city has been added' );
			
			return Redirect::route('city.index');
		}
		else
		{
			Session::flash( 'class', 'danger' );
			Session::flash( 'message', $validation->messages()->all() );
			
			return Redirect::back()->withInput();
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data['city'] = Cities::find( $id );
		
		$data['countries'] = Countries::where('status', 1)->get();
		
		return View::make( 'city.edit', $data );
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::get();
		
		$rules = [ 'name'	=>	'required|min:3|max:40|unique:sys_cities,name,'.$id ];
		
		$validation = Cities::validate( $input, $rules );
		
		if ( $validation->passes() )
		{
			$update = Cities::find( $id );
			$update->name		= $input['name'];
			$update->country_id = $input['country_id'];
			$update->save();
			
			Session::flash( 'class', 'success' );
			Session::flash( 'message', 'A city has been updated' );
			
			return Redirect::route('city.index');
		}
		else
		{
			Session::flash( 'class', 'danger' );
			Session::flash( 'message', $validation->messages()->all() );
			
			return Redirect::back()->withInput();
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$city = Cities::find( $id );
		$city->status = 3;
		$city->save();
		
		if ( $city )
		{
			Session::flash( 'class', 'success' );
			Session::flash( 'message', '&ldquo;'.$city->name.'&rdquo; city has been deleted' );
		}
		else
		{
			Session::flash( 'class', 'danger' );
			Session::flash( 'message', 'Delete process failed. Please try again later...' );
		}
		
		return Redirect::back();
	}
	
	
	/**
	 * Set as Active the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function setActive($id)
	{
		//
	}


}
