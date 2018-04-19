<?php
  echo '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Attention !</strong> La confirmation du mot de passe est erronée !</div>';
  require(File::build_path(array ("view","utilisateur","create.php")));
?>
