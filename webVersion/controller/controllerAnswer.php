<?php
require_once (File::build_path(array ("model","ModelSurvey.php")));
require_once (File::build_path(array ("model","ModelQuestion.php")));
require_once (File::build_path(array ("model","ModelQuestionOption.php")));
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerAnswer {

	protected static $object='answer';

	public static function default(){
    	require (File::build_path(array ("view",static::$object,"inexistantSurvey.php")));//TO DO
	}

	public static function create(){
		$postOrGet=Conf::getPostOrGet();
		$idSurvey=Util::myGet('idSurvey');
		$survey=ModelSurvey::select($idSurvey);
		$questions = ModelQuestion::selectByIdSurvey($idSurvey);
		foreach($questions as $key => $question){
			$questions[$key]['options']= ModelQuestionOption::selectByQuestion(array($question['id'], $question['idsurvey']));
		};
		require (File::build_path(array ("view",static::$object,"answerForm.php")));
	}

	public static function addAnswer(){
		$answer=json_decode(Util::myGet('Json-string'));
		Util::aff($answer);

		//CONTROL DATA
		//TO DO


		//Saving Data
		foreach($answer as $key => $question){

		}

	}

}
?>
