<?php
    $login=htmlspecialchars($login);
    echo "Utilisateur ".$login." non trouvé";
    require (File::build_path(array ("view","utilisateur","list.php")));
?>
