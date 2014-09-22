<?php
//Map controller handles all the actions with related to the map interface
class MapController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth');
    }

	public function getAdd()
	{
		//create the map interface for adding questions 
		return View::make('mapscriptadd');
		
	}

	public function getIndex($defaultLocation = 0)
	{
		//get all the the locations
		$locations = Location::all();
		
		//declaring new arrays
		$answersList = array();
		$questionsList = array();
		$questionsList[0] = array();
		
		foreach ($locations as $loc) {
			//get all the questions asked about the particular location
			$questions = Question::where('locationId', '=',$loc->locationId)->get();			
			$questionsList[$loc->locationId] = $questions;
			$answersToQuestion = array();
			foreach ($questions as $q) {
				//find the answers provided for each question
				$answersToQuestion[$q->questionId] = Answer::where('questionId','=',$q->questionId)->get();
			}
			$answersList[$loc->locationId] = $answersToQuestion; 
		}

		//create data array to be sent to the view
		$data = array(
			'questions' => $questionsList,
			'locations' => $locations,
			'answers' => $answersList,
			'defaultLocation'=> $defaultLocation
		);

		//create the view with data
		return View::make('mapscript',$data);
		
	}

	public function findCloseLocations($latitude = 6.800376, $longitude= 79.893323,$limit = 5){

		//getting the closest places based on Haversine formula
		$results = DB::select(
				"SELECT locationId,placeId, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + 
				sin( radians(?) ) * sin( radians( latitude ) ) ) ) 
				AS distance FROM locations HAVING distance < ? 
				ORDER BY distance LIMIT 0 , 20;",
				array($latitude,$longitude,$latitude,$limit)
				);
		
		return $results;
	}

}