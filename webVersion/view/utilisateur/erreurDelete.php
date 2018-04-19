<?php
    $login=htmlspecialchars($login);
    echo "L'utilisateur avec le login ".$login." ne peut pas etre supprimé, erreur";
    require (File::build_path(array ("view","utilisateur","list.php")));
?>
