<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function __construct() {

        $this->beforeFilter('auth');
    }
	public function getIndex()
	{
		//get all the questions asked by user
		$locations = array();
		$questionsList = Question::where('userId','=',Auth::user()->id)->get();
		$questionsList = $questionsList->sortBy('created_at');
		$questionsList = $questionsList->reverse();
		//add all locations related to the user to the array $locations
		foreach ($questionsList as $q) {
			array_push($locations, $q->locationId);
		}

		//get all the answers by user
		$answersList = Answer::where('userId','=',Auth::user()->id)->get();
		$answersList = $answersList->sortBy('created_at');
		$answersList = $answersList->reverse();
		//add all locations related to the user to the array $locations
		foreach ($answersList as $a) {
			array_push($locations, $a->locationId);
		}

		//remove duplicates in the array
		$locations = array_unique($locations); 

		//create data array to be passed to the view
		$data = array(
			'locations' => $locations,
			'questions' => $questionsList,
			'answers'=> $answersList
			);

		//creating the view
		return View::make('home',$data);
	}

}
