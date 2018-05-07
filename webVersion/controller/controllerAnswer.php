<?php
require_once (File::build_path(array ("model","ModelSurvey.php")));
require_once (File::build_path(array ("model","ModelQuestion.php")));
require_once (File::build_path(array ("model","ModelAnswer.php")));
require_once (File::build_path(array ("model","ModelExplanation.php")));
require_once (File::build_path(array ("model","ModelExtraOption.php")));
require_once (File::build_path(array ("model","ModelFreeAnswer.php")));
require_once (File::build_path(array ("model","ModelOptionAnswer.php")));
require_once (File::build_path(array ("model","ModelSurveyAnswered.php")));
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
		if($survey==false){
			require (File::build_path(array ("view",static::$object,"inexistantSurvey.php")));
		}else{
			$questions = ModelQuestion::selectByIdSurvey($idSurvey);
			foreach($questions as $key => $question){
				$questions[$key]['options']= ModelQuestionOption::selectByQuestion(array($question['id'], $question['idsurvey']));
			};
			require (File::build_path(array ("view",static::$object,"answerForm.php")));
		}
	}

	public static function created(){
		$answer=json_decode(Util::myGet('json_string'));
		ModelAnswer::Init("survey_".Util::myGet('idSurvey'));
		
		//CONTROL DATA
		//TO DO


		//Saving Data
		$surveyAnsered=ModelSurveyAnswered::save(array(
			"iduser" => $_SERVER['REMOTE_ADDR'],
		));
		foreach($answer as $key => $question){
			if($question->type==1 ||$question->type==2 ||$question->type==3 ||$question->type==4 ||$question->type==5){
				ModelFreeAnswer::save(array(
					"id" => ModelFreeAnswer::maxId(array($surveyAnsered->get('id'),$question->id)),
					"idSurveyAnswered" => $surveyAnsered->get('id'),
					"idQuestion" => $question->id,
					"answer" => $question->answer
				));
			}else if($question->type==6 ||$question->type==7 ||$question->type==8 ||$question->type==9 ){
				ModelOptionAnswer::save(array(
					"idSurveyAnswered" => $surveyAnsered->get('id'),
					"idQuestion" => $question->id,
					"answer" => $question->answer
				));
			}
			if($question->type==7 ||$question->type==9 ){
				ModelExtraOption::save(array(
					"idSurveyAnswered" => $surveyAnsered->get('id'),
					"idQuestion" => $question->id,
					"answer" => $question->extraAnswer
				));
			}
		}
		echo "OK";
	}
}
?>
