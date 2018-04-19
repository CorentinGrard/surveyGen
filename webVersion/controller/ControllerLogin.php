<?php
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerLogin {

    public static function default(){
        if(isset($_SESSION['login'])){
            ControllerDashboard::default();
        }
        $postOrGet=Conf::getPostOrGet();
        require (File::build_path(array ("view","login.php")));
    }
}
?>
