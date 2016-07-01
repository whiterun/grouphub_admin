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
		return Redirect::to('/dashboard');
	}
});

Route::post('login', [ 'as' => 'admin.do.login', 'uses' => 'HomeController@doLogin' ]);
Route::get('logout', [ 'as' => 'admin.do.logout', 'uses' => 'HomeController@doLogout' ]);

Route::group([ 'before' => 'auth' ], function()
{
	Route::get('/', function()
	{
		return View::make('layout');
	});

});

// dashboard
Route::group([ 'prefix' => 'dashboard' ], function()
{
	Route::get('/', [
		'as'	=> 'dashboard.index',
		'uses'	=> 'DashboardController@index'
	]);
});

// User
Route::group([ 'prefix' => 'user' ], function()
{	
	Route::get('/', [
		'as'	=> 'user.index',
		'uses'	=> 'UserController@index'
	]);
	Route::get('create', [
		'as'	=> 'user.create',
		'uses'	=> 'UserController@create'
	]);
	Route::post('store', [
		'as'	=> 'user.store',
		'uses'	=> 'UserController@store'
	]);
	Route::get('edit/{id}', [
		'as'	=> 'user.edit',
		'uses'	=> 'UserController@edit'
	]);
	Route::get('destroy/{id}', [
		'as'	=> 'user.destroy',
		'uses'	=> 'UserController@destroy'
	]);
});

// Community
Route::group([ 'prefix' => 'community' ], function()
{
	Route::get('/', [
		'as'	=> 'community.index',
		'uses'	=> 'CommunityController@index'
	]);
	Route::get('create', [
		'as'	=> 'community.create',
		'uses'	=> 'CommunityController@create'
	]);
	Route::post('store', [
		'as'	=> 'community.store',
		'uses'	=> 'CommunityController@store'
	]);
	Route::get('edit/{id}', [
		'as'	=> 'community.edit',
		'uses'	=> 'CommunityController@edit'
	]);
	Route::get('destroy/{id}', [
		'as'	=> 'community.delete',
		'uses'	=> 'CommunityController@destroy'
	]);
	Route::get('detail/{id}', [
		'as'	=> 'community.detail',
		'uses'	=> 'CommunityController@detail'
	]);
	Route::post('/set-inactive/{id}', [ 'as' => 'community.set.inactive', 'uses' => 'CommunityController@setInactive' ]);
	Route::post('/set-Activate/{id}', [ 'as' => 'community.set.active', 'uses' => 'CommunityController@setActivate' ]);
	Route::get('/member/{id}', [ 'as' => 'member_community', 'uses' => 'CommunityController@Member' ]);
	Route::post('/approve_member', [ 'as' => 'admin.community.approveMember', 'uses' => 'CommunityController@approveMember' ]);
	Route::post('/remove_member', [ 'as' => 'admin.community.removeMember', 'uses' => 'CommunityController@removeMember' ]);
	Route::post('/setOrganizer', [ 'as' => 'admin.set.organizer', 'uses' => 'CommunityController@setOrganizer' ]);
	Route::post('/removeOrganizer', [ 'as' => 'admin.remove.organizer', 'uses' => 'CommunityController@removeOrganizer' ]);
	Route::post('/transfer_creator', [ 'as' => 'admin.transfer.creator', 'uses' => 'CommunityController@transferCreator' ]);
});

// Event
Route::group([ 'prefix' => 'event' ], function(){
	Route::get('/', [ 'as' => 'index_event', 'uses' => 'EventController@index' ]);
	Route::get('/create', [ 'as' => 'create_event', 'uses' => 'EventController@create' ]);
	Route::post('/store', [ 'as' => 'store_event', 'uses' => 'EventController@store' ]);
	Route::get('/edit/{id}', [ 'as' => 'edit_event', 'uses' => 'EventController@edit' ]);
	Route::get('/destroy/{id}', [ 'as' => 'destroy_event', 'uses' => 'EventController@destroy' ]);
	Route::get('/detail/{id}', [ 'as' => 'detail_event', 'uses' => 'EventController@detail' ]);
});

// Channel
Route::group([ 'prefix' => 'channel' ], function() {
	Route::get('/', [ 'as' => 'index_channel', 'uses' => 'ChannelController@index' ]);
	Route::get('/detail/{id}', [ 'as' => 'detail_channel', 'uses' => 'ChannelController@detail' ]);
});

// City
Route::group([ 'prefix' => 'city' ], function()
{
	Route::get('/', [
		'as'	=> 'city.index',
		'uses'	=> 'CityController@index'
	]);
	Route::get('create', [
		'as'	=> 'city.create',
		'uses'	=> 'CityController@create'
	]);
	Route::post('store', [
		'as'	=> 'city.store',
		'uses'	=> 'CityController@store'
	]);
});