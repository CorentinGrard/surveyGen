<?php
require_once (File::build_path(array ("model","Model.php")));
require_once (File::build_path(array ("model","ModelProject.php")));
require_once (File::build_path(array ("model","ModelSurvey.php")));
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerProject {

	protected static $object='project';

	public static function default(){
        if(isset($_SESSION['email'])){
            ControllerProject::readAll();
        }else{
			ControllerUser::default();
		}
	}
	
	public static function readAll(){
		if(isset($_SESSION['email'])){
			$tabP=ModelProject::selectProjects($_SESSION['email']);
			$view=array("view", static::$object, "list.php");
			$pagetitle='Project SGS';
			require (File::build_path(array ("view","view.php")));
		}else{
			ControllerUser::default();
		}
	}

	public static function read(){
		if(isset($_SESSION['email'])){
			$project=ModelProject::select(Util::myGet('id'));
			$tab_surveys=ModelSurvey::selectByProject($project->get('id'));
			$view=array("view", static::$object, "detail.php");
			$pagetitle=$project->get('name');
			require (File::build_path(array ("view","view.php")));
		}else{
			ControllerUser::default();
		}
	}

	public static function create(){
		if(isset($_SESSION['email'])){
			$postOrGet=Conf::getPostOrGet();
			$view=array("view", static::$object, "create.php");
			$pagetitle='Create Project';
			require (File::build_path(array ("view","view.php")));
		}else{
			ControllerUser::default();
		}
	}

	public static function created(){
		if(isset($_SESSION['email'])){
			$info=array(
				"description"=>Util::myGet('description'),
				"Useremail"=>$_SESSION['email'],
				"name"=>Util::myGet('name'),
			);
			if(ModelProject::save($info)){
					$project=ModelProject::selectByInfo($info);
					header("location:?controller=project&action=read&id=".$project->get('id'));
			}else{
				$view=array("view", static::$object, "errorSave.php");// TO DO
				$pagetitle='Jeu non sauvegardée';
				require(File::build_path(array ("view","view.php")));
			}
		}else{
			ControllerUser::default();
		}
	}

	public static function update(){
		if(isset($_SESSION['email'])){
			$project=ModelProject::selectWithEmail(Util::myGet('id'),$_SESSION['email']);
			$postOrGet=Conf::getPostOrGet();
			$view=array("view", static::$object, "update.php");
			$pagetitle='Update '.$project->get('name');
			require (File::build_path(array ("view","view.php")));
		}else{
			ControllerUser::default();
		}
	}

	public static function updated(){
		if(isset($_SESSION['email'])){
			$info=array(
				"id"=>Util::myGet('id'),
				"description"=>Util::myGet('description'),
				"Useremail"=>$_SESSION['email'],
				"name"=>Util::myGet('name'),
			);
			if(ModelProject::update($info)){
				header("location:?controller=project&action=read&id=".Util::myGet('id'));
			}
		}else{
			ControllerUser::default();
		}
	}

	public static function deleted(){
		if(isset($_SESSION['email'])){

		}else{
			ControllerUser::default();
		}
	}
}
?>
