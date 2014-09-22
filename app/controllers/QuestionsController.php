<?php
// Controller responsible for adding quesitons
class QuestionsController extends BaseController {
	
	public function __construct() {

        $this->beforeFilter('auth');
    }

	public function add(){
		
		//get all data from the response
		$data = Input::all();

		//check if the place is already in the database
		$c = Location::where('placeId','=',$data['placeId'])->count();
		 if($c==0){
		// add the location
		$loc = new Location;
		$loc->locationName = $data['locationName'];
		$loc->longitude = $data['longitude'];
		$loc->latitude = $data['latitude'];
		$loc->address = $data['address'];
		$loc->placeId = $data['placeId'];
		$loc->save();		
		}
	 	//get the location Id
	 	$loc = Location::where('placeId','=',$data['placeId'])->first();
	 	$locationId = $loc->locationId;

		//add question
		$question = new Question;
		$question->questionText = $data['questionText'];
		$question->userId = $data['userId'];
		$question->locationId = $locationId;
		$question->save();

		//send the response
		return Response::json($locationId);
	}

}
