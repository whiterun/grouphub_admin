<?php

class AdminStatistic extends Eloquent{

	/**
	 * Laravel Model Eloquent
	 *
	 * @var string
	 **/
	protected $model;
	/**
	 * Time start
	 *
	 * @var integer
	 **/
	protected $time_start 	= null;
	/**
	 * Time end
	 *
	 * @var integer
	 **/
	protected $time_end 	= null;

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Kornelius Kristian Rayani
	 **/
	public function __construct(Community $model)
	{
		$this->model = $model;
	}
	/**
	 * Data for chart result display
	 *
	 * @return array
	 * @author
	 **/
	public function getResultChart()
	{
		$timeRange = $this->getTimeRangeDefault();
		$end = $timeRange['end'];
		if($test = is_numeric($end)) {
			$end = date('Y-m', $end);
		}

		/**
		 * Get previous 30 months from $end date for data chart.
		 * Google chart only maximum load just 30 month
		 *
		 * @var date
		 */
		$start 	= date('Y-m', strtotime($end . ' - 30 month'));

		$intersection = $this->setTime($start, $end)->getResultIntersection();

		return $intersection;
	}

    /**
     * Get all statistic data for table display
     *
     * @return void
     * @author
     **/
    public function getResultUser()
    {
    	/**
    	 * Formatted array of user data
    	 *
    	 * @var array
    	 **/
    	$array_user_all 		= $this->collectUserAll();

    	// $array_user_paginate 	= $this->collectUserPaginate();

    	// $array_result 			= array_intersect_key($array_user_all, $array_user_paginate);
		// $array_result 	= array_intersect_key($array_user_all, $intersection);

		// return $array_result;
		return $array_user_all;
    }
    /**
     * Combine all data result
     *
     * @return array
     * @author
     **/
    public function getResultIntersection()
    {
    	/**
    	 * Get all user statistic data first
    	 *
    	 * @var array  Combined data statistic
    	 */
    	$all 			= $this->collectUserAll();

    	$timeRange = $this->getTimeRange();
    	extract($timeRange);
    	/**
    	 * Get only data with selected date
    	 *
    	 * @var array
    	 */
    	$intersection 	= $this->intersection($start, $end);
    	/**
    	 * Only return data that in selected date
    	 */
    	return 	array_intersect_key($all, $intersection);
    }

    /**
     * Make key for ntersecting existing date
     *
     * @return  array  with key is date in format 'Y-m'
     * @author
     **/
    protected function intersection($start, $end)
    {

		$data 	= [];
		$start 	= strtotime($start);
		$end 	= strtotime($end);

		while($start <= $end)
		{
			$month = date('Y-m', $start);
			// Just need the key for intersection array
			$data[$month] = $month;

			$start = strtotime("+1 month", $start);
		}

		return $data;
    }

	/**
	 * Get user data from database table.
	 * User is someone who has been confirmed their email.
	 *
	 * @param string  syntax where for query
     * @param string  <= show all data users, = show only email confirmed users
     * @author Kornelius Kristian Rayani
     * @return object  Object with $items and $totalItems for pagination
     */
	public function getUserConfirm()
	{
		$data = $this->getUserStatisticAll($where = 'email_confirmed = 1', $symbol = '=');

		return $data;
	}

	/**
	 * Get all user data
	 *
	 * @param string  syntax where for query
     * @param string  <= show all data users, = show only email confirmed users
     * @author Kornelius Kristian Rayani
     * @return object  Object with $items and $totalItems for pagination
     */
	public function getUserAll()
	{
		$data = $this->getUserStatisticAll($where = 'email_confirmed <= 1', $symbol = '<=');

		return $data;
	}
	/**
	 * Get meetup data
	 *
	 * @return object
	 * @author
	 **/
	public function meetup()
	{
		return $this->statisticAll('meetup');

	}
	/**
	 * Get event data
	 *
	 * @return object
	 * @author
	 **/
	public function event()
	{
		return $this->statisticAll('event');
	}
	/**
	 * Get blogs data
	 *
	 * @return object
	 * @author
	 **/
	public function blogs()
	{
		return $this->statisticAll('blogs');
	}
	/**
	 * Get all data community
	 *
	 * @return  object
	 */
	public function communities()
	{
		return $this->statisticAll('community');
	}
  /**
     * Get data for Chart view
     *
     * @param string  syntax where for query
     * @param string  <= show all data users, = show only email confirmed users
     * @return object  Object with $items and $totalItems for pagination
     */
	protected function getUserStatisticAll($where, $symbol)
	{
		$query = $this->model->select(
		DB::raw('FROM_UNIXTIME(time_created,"%Y-%m") as tgl, count(id) as totals'))
		->from('user')
		->whereRaw($where)
		->groupBy('tgl')
		->orderBy('tgl', 'asc')
		->get();

		$data = new \StdClass();
		$data->items = $query;
		$data->totalItems = $this->countStat($symbol);

		return $data;
	}
  /**
  * Get number of users
  *
  * @param sign Sign '<' to show all data users, '=' show only confirmed users
  * @return int number of users
  */
	protected function countStat($symbol)
	{
		return $this->model->from('user')->where('email_confirmed', $symbol, '1')->count();
	}
 /**
  * GET Statistic table data
  *
  * @param string 	table : meetup, event, blogs, community
  * @return object
  */
	protected function statisticAll($table)
	{
		$query = $this->model->select(
		DB::raw('FROM_UNIXTIME(time_created,"%Y-%m") as tgl, count(id) as totals'))
		->from($table)
		->groupBy('tgl')
		->orderBy('tgl', 'asc')
		->get();

		$data = new \StdClass();
		$data->items = $query;
		$data->totalItems = $this->countStatisticAll($table);

		return $data;
	}
  /**
  * COUNT Statistic table data
  *
  * @param string table: meetup, event, blogs, community
  * @return int number of data
  */
	protected function countStatisticAll($table)
	{
		return $this->model->from($table)->count();
	}

	/**
	 * Get all table data for admin statistic
	 *
	 * @return array
	 * @author Kornelius Kristiarn R
	 **/
	public function collectUserAll()
	{
		/**
		 * Return new data collection
		 *
		 * @var array
		 **/
		$data 	= [];
		$range  = null;
		$range 	= $this->getTimeRangeDefault();
		// if(is_null($this->time_start) AND is_null($this->time_end)) {
		// } else {
		// 	$range 	= $this->getTimeRange();
		// }

		/**
		 * Check if $range is integer or in date format
		 * If its not numeric then coverse into numeric
		 */
		if(!is_numeric($range['start'])) {
			$range['start'] = strtotime($range['start']);
		}
		if(!is_numeric($range['end'])) {
			$range['end'] = strtotime($range['end']);
		}
		/**
		 * Add a month so, date now can be included in display
		 */
		$range['end'] = strtotime('+1 month', $range['end']);
		extract($range);
		// $start 	= $range['start']; // integer
		// $end 	= $range['end']; // integer

		$data_user_confirm 	= $this->getUserConfirm();
		$data_user_all 		= $this->getUserAll();
		$data_meetup 		= $this->meetup();
		$data_event 		= $this->event();
		$data_blogs 		= $this->blogs();
		$data_user_active 	= $this->getUserActive();
		$data_communities	= $this->communities();

		$user_confirmed 	= $this->getObjectArray($data_user_confirm);
		$user_all 			= $this->getObjectArray($data_user_all);
		$meetup 			= $this->getObjectArray($data_meetup);
		$event 				= $this->getObjectArray($data_event);
		$blogs 				= $this->getObjectArray($data_blogs);
		$user_active 		= $this->getObjectArray($data_user_active);
		$communities 		= $this->getObjectArray($data_communities);


		$total_users 		= 0;
		$total_user_all 	= 0;
		$total_meetup 		= 0;
		$total_event  		= 0;
		$total_blogs 		= 0;
		$total_user_active	= 0;
		$total_communities	= 0;

		while($start <= $end)
		{
			$month = date('Y-m', $start);

			if(isset($user_confirmed[$month]))
			{
				$data[$month]['month'] 				= $month;
				$data[$month]['users'] 				= $user_confirmed[$month];
				$data[$month]['total_users']		= ($total_users = $total_users + $user_confirmed[$month]);
			}
			else
			{
				$data[$month]['month'] 				= $month;
				$data[$month]['users'] 				= 0;
				$data[$month]['total_users'] 		= ($total_users);
			}

			// Check if meetup month exist
			if(isset($meetup[$month]))
			{
				$data[$month]['meetup'] 			= $meetup[$month];
				$data[$month]['total_meetup']		= ($total_meetup = $total_meetup + $meetup[$month]);
			}
			else
			{
				$data[$month]['meetup'] 			= 0;
				$data[$month]['total_meetup']		= ($total_meetup);
			}

			// Check if event month exist
			if(isset($event[$month]))
			{
				$data[$month]['event'] 				= $event[$month];
				$data[$month]['total_event']		= ($total_event = $total_event + $event[$month]);
			}
			else
			{
				$data[$month]['event'] 				= 0;
				$data[$month]['total_event']		= ($total_event);
			}

			// Check if blogs month exist
			if(isset($blogs[$month]))
			{
				$data[$month]['blogs'] 				= $blogs[$month];
				$data[$month]['total_blogs']		= ($total_blogs = $total_blogs + $blogs[$month]);
			}
			else
			{
				$data[$month]['blogs'] 				= 0;
				$data[$month]['total_blogs']		= ($total_blogs);
			}

			// Check month of user_active
			// Then Add User Active Data
			if(isset($user_active[$month]))
			{
				$data[$month]['user_active'] 		= $user_active[$month];
				$data[$month]['total_user_active']	= ($total_user_active = $total_user_active + $user_active[$month]);
			}
			else
			{
				$data[$month]['user_active'] 		= 0;
				$data[$month]['total_user_active']	= ($total_user_active);
			}
			/**
			 * Check if data with date as key has been added in variable $data
			 * If it exist then increase total numbers,
			 * when not add data into variable $data with total data in database table
			 */
			if(isset($communities[$month]))
			{
				$data[$month]['communities'] 		= $communities[$month];
				$data[$month]['total_communities']	= ($total_communities = $total_communities + $communities[$month]);
			}
			else
			{
				$data[$month]['communities'] 		= 0;
				$data[$month]['total_communities']	= ($total_communities);
			}

			$start = strtotime("+1 month", $start);
		}

		return $data;
	}

	/**
	 * Make data object from table being an array
	 *
	 * @param 	object Object data From Database Table
	 * @return 	array
	 * @author Kornelius Kristian Rayani
	 **/
	public function getObjectArray($data)
	{

		$result = [];

		if(is_object($data))
		{
			foreach($data->items as $item  )
			{
				//$result[$item->tanggal] = $item->totals;
				$result [$item->tgl] = $item->totals;
			}
		}
		else{
			throw new Exception('Not an Object');
		}
		return $result;
	}

	/**
	 * Get default time start and end to get all statistic adata
	 */
	protected function getTimeRangeDefault()
	{
		$time 	= $this->model->select(DB::raw('MIN(time_created) as time_start'))->from('user')->first();
		/**
		 * Set start time from field created_at table user
		 * @var integer
		 */
		$start  = $time['time_start'];
		/**
		 * Set end time from date now
		 * @var integer
		 */
		$end 	= strtotime(date('Y-m'));
		return ['start' => $start, 'end' => $end];
	}
	/**
	 * Get custom time range
	 *
	 * @return array integer
	 * @author Kornelius Kristian Rayani
	 **/
	public function getTimeRange()
	{
		$start 	= date('Y-m', $this->time_start);
		$end 	= date('Y-m', $this->time_end);

		$timeDefault  = $this->getTimeRangeDefault();
		if($start == null OR $end == null){
			throw new Exception('Time has not been set.');
		}

		return ['start'	=> $start, 'end' => $end];
	}

	/**
	 * Set time start and time end
	 *
	 * @param  integer $input_start
	 * @param  integer $input_end
	 * @return void
	 * @author Kornelius Kristian Rayani
	 **/
	public function setTime($input_start, $input_end)
	{
		$this->time_start 	= strtotime($input_start);
		$this->time_end 	= strtotime($input_end);
		return $this;
	}
	 /**
     * Get data for Chart view
     *
     * @param string  syntax where for query
     * @param string  <= show all data users, = show only email confirmed users
     * @return object  Object with $items and $totalItems for pagination
     */
	public function getUserActive()
	{

		// SELECT * FROM user WHERE id IN (SELECT (user_id) FROM guests INNER JOIN event ON guests.event_id = event.id) AND id IN (SELECT (user_id) FROM members)
		/*
		 * SELECT * FROM user WHERE id IN (SELECT (user_id)
		 * FROM guests INNER JOIN event
		 * ON guests.event_id = event.id
		 * WHERE event.time_start >= 1422723600
		 * AND event.time_start <= 1430413200 )
		 * AND id IN (SELECT (user_id) FROM members)
		 */
		$end 	= date('Y-m');
		$start 	= date('Y-m', strtotime($end . ' - 1 month'));

		$end_integer 	= strtotime($end);
		$start_integer 	= strtotime($start);

		// $query = $this->model->select('*')
		// 				->from('user')
		// 				->whereIn('id', function($query){
		// 					$query->select('user_id')
		// 							->from('guests')
		// 							->join('event', 'event.id', '=', 'guests.event_id')
		// 							->where('event.time_start', '>=', $start_integer)
		// 							->where('event.time_start', '<=', $end_integer);
		// 				})
		// 				->whereIn('id', function($query){
		// 					$query->select('user_id')->from('members');
		// 				})
		// 				->get();

		$query = $this->model->select(DB::raw("
					SELECT * FROM user WHERE id IN (SELECT (user_id)
					FROM guests INNER JOIN event
					ON guests.event_id = event.id
					WHERE event.time_start >= {$start_integer}
					AND event.time_start <= {$end_integer} )
					AND id IN (SELECT (user_id) FROM members)"
				));

		$data 				= new \StdClass();
		$data->items 		= $query;
		$data->totalItems 	= $this->countUserActive($start_integer, $end_integer);

		return $data;
	}
  /**
  * COUNT Statistic table data
  *
  * @param string table: meetup, event, blogs
  * @return int number of data
  */
	protected function countUserActive($start_integer, $end_integer)
	{
		// $query = $this->model->select('*')
		// 				->from('user')
		// 				->whereIn('id', function($query){
		// 					$query->select('user_id')
		// 							->from('guests')
		// 							->join('event', 'event.id', '=', 'guests.event_id')
		// 							->where('event.time_start', '>=', $start_integer)
		// 							->where('event.time_start', '<=', $end_integer);
		// 				})
		// 				->whereIn('id', function($query){
		// 					$query->select('user_id')->from('members');
		// 				})
		// 				->count();
		$query = $this->model->select(DB::raw("
					SELECT count(*) FROM user WHERE id IN (SELECT (user_id)
					FROM guests INNER JOIN event
					ON guests.event_id = event.id
					WHERE event.time_start >= {$start_integer}
					AND event.time_start <= {$end_integer} )
					AND id IN (SELECT (user_id) FROM members)"
				));
		return $query;
	}

}
