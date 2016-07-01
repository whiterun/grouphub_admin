<?php

class Cities extends \Eloquent {
	
	protected $table = 'sys_cities';

	public $timestamps = FALSE;
	
	protected $fillable = [ 'country_id', 'name' ];

	public function country()
	{
		return $this->belongsTo('Countries', 'country_id');
	}
	
	public static function validate( $input, $custom = '' )
	{
		$rules = [
			'country_id'	=>	'required|exists:sys_countries,id,status,1',
			'name'			=>	'required|min:3|max:40|unique:sys_cities,name',
		];
		
		if ( !empty($custom) ) $rules = $custom + $rules;

		return Validator::make( $input, $rules );
	}
}