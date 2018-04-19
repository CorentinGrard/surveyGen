<?php
    $login=htmlspecialchars($login);
    echo 'L\'utilisateur '.$login." n'a pas été mis à jour, erreur";
    require (File::build_path(array ("view","accueil","accueil.php")));
?>
