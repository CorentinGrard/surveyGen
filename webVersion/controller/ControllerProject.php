<?php
require_once (File::build_path(array ("model","Model.php")));
require_once (File::build_path(array ("model","ModelProject.php")));
require_once (File::build_path(array ("model","ModelSurvey.php")));
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerProject {

	protected static $object='project';

	/**
	 * By default we diplay the list of Projects if the user is log
	 *
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */
	public static function default(){
        ControllerProject::readAll();
	}

	/**
	 * To display the list of project of the user
	 *
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */
	public static function readAll(){
		$tabP=ModelProject::selectProjects($_SESSION['email']);
		$view=array("view", static::$object, "list.php");
		$pagetitle='Project SGS';
		require (File::build_path(array ("view","view.php")));
	}


	/**
	 * Allow the user to see the details of one of his survey
	 *
	 * @param string Util::myGet('id') the id of the survey that we want to view
	 *
	 * @author Corentin Grard <corentin.grard@gmail.com>
	*/
	public static function read(){
		$project=ModelProject::select(Util::myGet('id'));
		$tab_surveys=ModelSurvey::selectByProject($project->get('id'));
		$view=array("view", static::$object, "detail.php");
		$pagetitle=$project->get('name');
		require (File::build_path(array ("view","view.php")));
	}

	/**
	 * To display the form page to create a new project
	 *
	 * @author Corentin Grard <corentin.grard@gmail.com>
	*/
	public static function create(){
		$postOrGet=Conf::getPostOrGet();
		$view=array("view", static::$object, "create.php");
		$pagetitle='Create Project';
		require (File::build_path(array ("view","view.php")));
	}

	/**
	 * To process and save into the database the information send by the page of create()
	 *
	 * @param string Util::myGet('description') description of the project
	 * @param string Util::myGet('name') name of the project
	 *
	 * @author Corentin Grard <corentin.grard@gmail.com>
	*/
	public static function created(){
		$info=array(
			"description"=>Util::myGet('description'),
			"Useremail"=>$_SESSION['email'],
			"name"=>Util::myGet('name'),
		);
		if(ModelProject::save($info)){
				$project=ModelProject::selectByInfo($info);
				header("location:?controller=project&action=read&id=".$project->get('id'));
		}else{
			$error="Error while saving the project";
			$view=array("view", static::$object, "create.php");
			$pagetitle='Create Project';
			require(File::build_path(array ("view","view.php")));
		}
	}

	/**
	 * To display the page for updating your project
	 *
	 * @param string Util::myGet('id') id of the project
	 *
	 * @author Corentin Grard <corentin.grard@gmail.com>
	*/
	public static function update(){
		$project=ModelProject::selectWithEmail(Util::myGet('id'),$_SESSION['email']);
		$postOrGet=Conf::getPostOrGet();
		$view=array("view", static::$object, "update.php");
		$pagetitle='Update '.$project->get('name');
		require (File::build_path(array ("view","view.php")));
	}

	/**
	 * To process and save into the database the information send by the page of update()
	 *
	 * @param string Util::myGet('description') description of the project
	 * @param string Util::myGet('name') name of the project
	 *
	 * @author Corentin Grard <corentin.grard@gmail.com>
	*/
	public static function updated(){
		$info=array(
			"id"=>Util::myGet('id'),
			"description"=>Util::myGet('description'),
			"Useremail"=>$_SESSION['email'],
			"name"=>Util::myGet('name'),
		);
		if(ModelProject::update($info)){
			header("location:?controller=project&action=read&id=".Util::myGet('id'));
		}else{
			$error="Error while updating the project";
			$view=array("view", static::$object, "update.php");
			$pagetitle='Update Project';
			require(File::build_path(array ("view","view.php")));
		}
	}

	public static function deleted(){//TO DO
	}
}
?>
