<?php
require_once (File::build_path(array ("model","Model.php")));
require_once (File::build_path(array ("model","ModelSurvey.php")));
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerSurvey {

	protected static $object='project';

	public static function default(){
        if(isset($_SESSION['email'])){
            ControllerSurvey::readAll();
        }else{
			ControllerUser::default();
		}
	}
}
?>
