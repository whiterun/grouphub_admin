<?php

class Dashboard extends \Eloquent {
	
	protected $table = 'tracker';

	public $timestamps = FALSE;

	public function graphUser()
	{
		return $this->belongsTo('User');
	}

	public function graphCommunity()
	{
		return $this->belongsTo('Community');
	}
}