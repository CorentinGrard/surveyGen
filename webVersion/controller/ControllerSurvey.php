<?php
require_once (File::build_path(array ("model","Model.php")));
require_once (File::build_path(array ("model","ModelSurvey.php")));
require_once (File::build_path(array ("model","ModelProject.php")));
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
	 * @throws "account isn't validated"
	 * @throws "Email or password incorrect"
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
