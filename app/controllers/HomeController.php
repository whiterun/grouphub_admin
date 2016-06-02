<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
	
	public function doLogin()
	{
		// set the remember me cookie if the user check the box
		$remember = ( Input::has('remember') ? true : false );

		// attempt to do the login
		$auth = Auth::attempt(
			[
				'username'  => strtolower( Input::get('username') ),
				'password'  => md5( Input::get('password') )
			], $remember
		);
		
		if ( $auth )
		{
			return Redirect::to('/dashboard');
		}
		else
		{
			// validation not successful, send back to form 
			return Redirect::back()
				->withInput( Input::except('password') )
				->with('flash_notice', 'Your username / password combination was incorrect.');
		}
	}

	public function doLogout()
	{
		Auth::logout();
		return Redirect::to('login');
	}

}
