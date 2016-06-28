<?php

class Cities extends \Eloquent {
	
	protected $table = 'sys_cities';

	public $timestamps = FALSE;

	public function country()
	{
		return $this->belongsTo('Countries', 'country_id');
	}
}