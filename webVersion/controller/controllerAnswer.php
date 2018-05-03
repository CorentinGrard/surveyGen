<?php
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerAnswer {

	protected static $object='answer';

	public static function default(){
    	ControllerSurvey::readAll();
	}

	public static  function createForm(){
		$idSurvey=$_GET['idSurvey'];

		$questions = ModelQuestion::selectByIdSurvey($idSurvey);
		$questions_options = array();
		foreach($questions as $key => $question){
			$question_options[$question->get('id')] = ModelQuestionOption::selectByQuestion(array($question->get('id'), $question->get('idSurvey')));
		}
		$view=array("view", "answerForm.php");
		require (File::build_path(array ("view","view.php")));
	}

}
?>
