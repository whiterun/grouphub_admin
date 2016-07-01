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
			$data['cities'] = $this->city->where('name', 'LIKE', '%'. Input::get('search') . '%')
				->with('country')
				->paginate(20);
			
			$count = count( $data['cities'] );
			
			Session::flash( 'class', ( $count > 0 ? 'success' : 'danger' ) );
			Session::flash( 'message', 'Found '.$count.' City(es) with &ldquo;'.Input::get('search').'&rdquo; keyword' );
		}
		else
		{
			$data['cities'] = $this->city->with('country')->paginate(20);
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
