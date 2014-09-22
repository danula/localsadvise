<?php
class AnswersController extends BaseController {
	
	public function __construct() {

        $this->beforeFilter('auth');
    }

	public function add(){
		
		//get the input post data
		$data = Input::all();
		
		//add question
		$answer = new Answer;
		$answer->answerText = $data['answerText'];
		$answer->userId = $data['userId'];
		$answer->questionId = $data['questionId'];
		$answer->locationId = $data['locationId'];
		$answer->save();

		//return response
		return Response::json($data);
	}

}