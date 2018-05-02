<?php
require_once (File::build_path(array ("model","Model.php")));
require_once (File::build_path(array ("model","ModelSurvey.php")));
require_once (File::build_path(array ("model","ModelProject.php")));
require_once (File::build_path(array ("model","ModelQuestion.php")));
require_once (File::build_path(array ("model","ModelQuestionOption.php")));
require_once (File::build_path(array ("model","ModelOptions.php")));
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
		if(!((isset($survey->projectId) && is_int(intval($survey->projectId)) && ModelProject::select($survey->projectId)) &&  (isset($survey->name) && is_string($survey->name)) && (isset($survey->description) && is_string($survey->description)) && (isset($survey->objective) && is_string($survey->objective)) && (isset($survey->name) && is_string($survey->name)) && (isset($survey->startDate) && is_string($survey->startDate) && (DateTime::createFromFormat('Y-m-d', $survey->startDate) !== false)) && (isset($survey->finalDate) && is_string($survey->finalDate) && (DateTime::createFromFormat('Y-m-d', $survey->finalDate) !== false)))){
			echo "Incorrect data, try again.";
		}else{
			
			//Saving the survey in the database
			$newSurvey=ModelSurvey::save(array(
				"projectId" => $survey->projectId,
				"name" => $survey->name,
				"description" => $survey->description,
				"objective" => $survey->objective,
				"startDate" => $survey->startDate,
				"finalDate" => $survey->finalDate,
				"DBName" => "todefine"//TO DO
			));
			if($newSurvey==false) $error= "Error while saving survey";
			else{
				foreach($survey->questions as $key => $question){
					$newQuestion=ModelQuestion::save(array(
						"id" => ModelQuestion::maxId($newSurvey->get('id'))+1,
						"idSurvey" => $newSurvey->get('id'),
						"idType" => $question->type,
						"title" => $question->title,
						"description" => "todo",//TO DO
					));
					if($newQuestion==false) $error= "Error while saving question";
					else{
						foreach($question->answers as $answer){
							$description=strtolower($answer->description);
							$newAnswer=ModelOptions::selectByDescription($description);
							if($newAnswer==false){
								$newAnswer=ModelOptions::save(array(
									"description" => $description
								));
							}
							if($newAnswer==false) $error= "Error while saving new option";
							else{
								$newQuestionOption=ModelQuestionOption::save(array(
									"idoption" => $newAnswer->get('id'),
									"idquestion" => $newQuestion->get('id'),
									"idsurvey" => $newSurvey->get('id'),
								));
								if($newQuestionOption==false) $error= "Error while saving option";
							}
						}
					}
				}
			}

			//Creating the new database for the answers
			// TO DO
			ModelSurvey::createSurveyDatabase($newSurvey->get('id'));
			//Creating the web page for the answers
			//TO DO

			//If everything worked, return OK else return the error
			if(isset($error)) echo $error;
			else echo $newSurvey->get('id');
		}
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
		require (File::build_path(array ("view","view.php")));
	}

	/**
	 * Display the detail of a survey
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function read(){
		$id=Util::myGet('id');
		$tabP=ModelProject::selectProjects($_SESSION['email']);
		$survey=ModelSurvey::select($id);
		if($survey!=false){
			foreach($tabP as $project){
				if($survey->get('projectid') == $project->get('id')){
					$view=array("view", static::$object, "detail.php");
					require (File::build_path(array ("view","view.php")));
					exit;
				}
			}
			$error="Survey non existant";
			$tabP=ModelProject::selectProjects($_SESSION['email']);
			$tabS=array();
			foreach($tabP as $project){
				$tabS=array_merge($tabS,ModelSurvey::selectByProject($project->get('id')));
			}
			$view=array("view", static::$object, "list.php");
			require (File::build_path(array ("view","view.php")));
		}else{
			$error="Survey non existant";
			$tabP=ModelProject::selectProjects($_SESSION['email']);
			$tabS=array();
			foreach($tabP as $project){
				$tabS=array_merge($tabS,ModelSurvey::selectByProject($project->get('id')));
			}
			$view=array("view", static::$object, "list.php");
			require (File::build_path(array ("view","view.php")));
		}

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
