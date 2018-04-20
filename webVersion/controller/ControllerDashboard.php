<?php
require_once (File::build_path(array ("model","Model.php")));
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerDashboard {

	protected static $object='Dashboard';

	public static function default(){
		$view=array("view", static::$object, "dashboard.php");
		$pagetitle='SGS Dashboard';
		require (File::build_path(array ("view","view.php")));
	}
}
?>
