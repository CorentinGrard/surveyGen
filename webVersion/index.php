<?php
require_once 'lib/File.php';
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Session.php")));
session_set_cookie_params(1800);
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (1800))) {
    // if last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
} else {
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}
require (File::build_path(array ("controller","routeur.php")));
?>
