<?php
require_once (File::build_path(array ("model","Model.php")));
require_once (File::build_path(array ("model","ModelSurvey.php")));
require_once (File::build_path(array ("model","ModelProject.php")));
require_once (File::build_path(array ("model","ModelQuestion.php")));
require_once (File::build_path(array ("model","ModelQuestionOption.php")));
require_once (File::build_path(array ("model","ModelOption.php")));
require_once (File::build_path(array ("model","ModelTypeOfQuestion.php")));
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerSurvey {

	protected static $object='survey';

	public static function default(){
    	ControllerSurvey::readAll();
	}

	 /**
	 * manages survey creation form.
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function create(){
		$projects=ModelProject::selectProjects($_SESSION['email']);
		$today = date('Y-m-d');
		$view=array("view", static::$object, "create.php");
		$pagetitle='SGS - Create survey';
		require (File::build_path(array ("view","view.php")));
	}

	/**
 	 * Save the form's result into the database, create the new database, create a webpage for the answers
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
 	*/
	public static function created(){

		//Get the data from the form
		$survey=json_decode($_POST['json_string']);

		//Control data
		

		//Saving the survey in the database
		$newSurvey=ModelSurvey::save(array(
			"projectId" => $survey->projectId,
			"name" => $survey->name,
			"description" => $survey->description,
			"objective" => $survey->objective,
			"startDate" => $survey->startDate,
			"finalDate" => $survey->finalDate,
			"dbName" => "todefine"//TO DO
		));
		foreach($survey->questions as $key => $question){
			Util::aff(ModelQuestion::maxId($newSurvey->get('id')));
			$newQuestion=ModelQuestion::save(array(
				"id" => ModelQuestion::maxId($newSurvey->get('id')),
				"idSurvey" => $newSurvey->get('id'),
				"idType" => $question->type,
				"title" => $question->title,
				"description" => "todo",//TO DO
			));
			foreach($question->answers as $answer){
				$description=strtolower($answer->description);
				$newAnswer=ModelOption::selectByDescription($description);
				if($newAnswer==false){
					$newAnswer=ModelOption::save(array(
						"description" => $description
					));
				}
				ModelQuestionOption::save(array(
					"idOption" => $newAnswer->get('id'),
					"idQuestion" => $question->get('id'),
					"idSurvey" => $newSurvey->get('id'),
				));
			}
		}

		//Creating the new database for the answers
		// TO DO


		//Creating the web page for the answers
		//TO DO

	}

	/**
	 * Finds the surveys in the databse
	 * Transfer them to list.php for display
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function readAll(){
		$tabP=ModelProject::selectProjects($_SESSION['email']);
		$tabS=array();
		foreach($tabP as $project){
			$tabS=array_merge($tabS,ModelSurvey::selectByProject($project->get('id')));
		}
		$view=array("view", static::$object, "list.php");
		$pagetitle='Surveys SGS';
		require (File::build_path(array ("view","view.php")));
	}
	 /**
	 * Gets question type in the database
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function getTypeOfQuestion(){
		$typeOfQuestionTab=ModelTypeOfQuestion::selectAll();
		echo json_encode($typeOfQuestionTab);
	}
}
?>
