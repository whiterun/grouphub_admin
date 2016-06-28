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
		Session::forget([ 'class', 'message' ]);
		
		if ( Input::get('search') )
		{
			$data['cities'] = $this->city->where('name', 'LIKE', '%'. Input::get('search') . '%')
				->with('country')
				->paginate(20);
			
			$count = count( $data['cities'] );
			
			Session::flash('class', ( $count > 0 ? 'success' : 'danger' ) );
			Session::flash('message', 'Found '.$count.' City(es) with &ldquo;'.Input::get('search').'&rdquo; keyword');
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
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
