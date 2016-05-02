<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login', function()
{
	if ( !Auth::check() )
	{
		return View::make('login');
	}
	else
	{
		return Redirect::to('/');
	}
});

Route::post('login', [ 'as' => 'admin.do.login', 'uses' => 'HomeController@doLogin' ]);

Route::group([ 'before' => 'auth' ], function()
{
	Route::get('/', function()
	{
		return View::make('layout');
	});
});
