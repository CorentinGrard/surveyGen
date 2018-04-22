<?php
require_once (File::build_path(array ("controller","ControllerUser.php")));
require_once (File::build_path(array ("controller","ControllerProject.php")));
require_once (File::build_path(array ("controller","ControllerSurvey.php")));
require_once (File::build_path(array ("controller","ControllerDashboard.php")));
require_once (File::build_path(array ("controller","Controller.php")));

$controller_default="user";
if(!is_null(Util::myGet('controller'))){
	$controller_class = 'Controller'.ucfirst(Util::myGet('controller'));
}else{
	$controller_class = 'Controller'.ucfirst($controller_default);
}
if(class_exists($controller_class)){
	if(!is_null(Util::myGet('action'))){
		$action = Util::myGet('action');
	}else{
		$action = 'default';
	}
	if(in_array($action, get_class_methods($controller_class))){
		$controller_class::$action();
	}else{
		Controller::error();
	}
}else{
	Controller::error();
}
?>
