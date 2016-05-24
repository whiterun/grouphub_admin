 <?php

class StatisticController extends Controller{

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	protected $model;
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	public function __construct(AdminStatistic $model)
	{
		$this->model = $model;
	}
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	public function index()
	{

		$end 	= date('Y-m');
		$start 	= date('Y-m', strtotime($end . ' - 3 month'));
		// return strtotime($end) . '<br>'. strtotime($start);

		$table = $this->model->getResultUser();

		$chart = $this->model->getResultChart();
		// echo '<pre>';
		// print_r($chart);
		// exit();
		arsort($table);
		// asort($chart);

		return View::make('statistic.index')->with('data', $table)->with('dataChart', $chart);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	public function search()
	{
		$validator = $this->getSearchValid();
		if($validator->passes())
		{
			$input = $this->getSearch();
			// print_r($input);
			// exit();
			extract($input);
			// $start 	= strtotime($start);
			// $end 	= strtotime($end);
			if( strtotime($start) <= strtotime($end) )
			{
				$user_object_array = $this->model->setTime($start, $end)->getResultIntersection();
				krsort($user_object_array);
				return View::make('statistic.index')->with('data', $user_object_array)->with('dataChart', $user_object_array);
			}
			return Redirect::route('admin.statistic')->withErrors(['start'=> 'End date muss greater than start date!']);

		}
		return Redirect::route('admin.statistic')->withErrors($validator);
	}
	/**
	 * Retrive form input in admin statistic page
	 *
	 * @return array
	 * @author
	 **/
	protected function getSearch()
	{
		return ['start' => Input::get('start'), 'end' => Input::get('end')];
	}
	/**
	 * Validation for statistic search input
	 *
	 * @return \Illuminate\Facades\Validator;
	 * @author
	 **/
	protected function getSearchValid()
	{
		return Validator::make(Input::all(), ['start' => 'required', 'end'=> 'required']);
	}
}
