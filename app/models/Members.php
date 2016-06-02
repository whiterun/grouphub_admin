<?php

class Members extends \Eloquent {
	
	protected $table = 'members';

	public $timestamps = FALSE;

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}
}