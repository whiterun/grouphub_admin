<?php

class Community extends Eloquent {
	
	public $table = 'community';
	
	public $timestamps = FALSE;
	
	public $guarded = FALSE;
	
	public function category()
	{
		return $this->belongsTo('CommunityCategories', 'community_category_id');
	}

}