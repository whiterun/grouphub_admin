<?php

class Community extends Eloquent {
	
	public $table = 'community';
	
	public $timestamps = FALSE;
	
	public $guarded = FALSE;

	public function members()
	{
		return $this->hasMany('Members', 'community_id');
	}
}