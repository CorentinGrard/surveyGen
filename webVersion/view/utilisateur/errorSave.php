<?php
    $login=htmlspecialchars($login);
    echo'<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        Le login <strong>'.$login.'</strong> existe déjà, veuillez changer de login.
       </div>';
    require (File::build_path(array ("view","utilisateur","create.php")));
?>
