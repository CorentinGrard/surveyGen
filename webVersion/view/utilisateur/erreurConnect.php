<?php
  echo '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Mince !</strong> La connexion a échoué :(</div>';
  require(File::build_path(array ("view","utilisateur","connect.php")));
?>
