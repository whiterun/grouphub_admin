<?php

class Dashboard extends \Eloquent {
	
	protected $table = 'tracker';

	public $timestamps = FALSE;

	public function graphfirst()
	{
		if (Input::get('Start_date') && Input::get('End_date')) {
			# code...
		}
	}
}