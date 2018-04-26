<?php
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class Controller {

	public static function errorAction(){
		$error="Error nonexistent action";
		if(isset($_SESSION['email'])){
			$view=array("view", "dashboard", "dashboard.php");
			$pagetitle='SGS Dashboard';
			require (File::build_path(array ("view","view.php")));
		}else{
			$postOrGet=Conf::getPostOrGet();
			require (File::build_path(array ("view","user","login.php")));
		}
	}

	public static function errorClass(){
		$error="Error nonexistent controller";
		if(isset($_SESSION['email'])){
			$view=array("view", "dashboard", "dashboard.php");
			$pagetitle='SGS Dashboard';
			require (File::build_path(array ("view","view.php")));
		}else{
			$postOrGet=Conf::getPostOrGet();
			require (File::build_path(array ("view","user","login.php")));
		}
	}
}
?>
