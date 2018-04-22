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
        if(isset($_SESSION['email'])){
            ControllerSurvey::readAll();
        }else{
			ControllerUser::default();
		}
	}

	public static function create(){
		if(isset($_SESSION['email'])){
			$projects=ModelProject::selectProjects($_SESSION['email']);
			$today = date('Y-m-d');
			$view=array("view", static::$object, "create.php");
			$pagetitle='SGS - Create survey';
			require (File::build_path(array ("view","view.php")));
		}else{
			ControllerUser::default();
		}
	}

	public static function getTypeOfQuestion(){
		$typeOfQuestionTab=ModelTypeOfQuestion::selectAll();
		echo json_encode($typeOfQuestionTab);
	}
}
?>
