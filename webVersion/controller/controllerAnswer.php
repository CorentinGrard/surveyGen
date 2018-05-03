<?php
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerAnswer {

	protected static $object='answer';

	public static function default(){
    	ControllerSurvey::readAll();
	}

}
?>
