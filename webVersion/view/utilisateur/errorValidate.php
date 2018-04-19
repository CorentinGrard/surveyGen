<?php
  echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Erreur </strong> lors de la validation de votre mail !
</div>';
  require(File::build_path(array ("view","utilisateur","connect.php")));
 ?>
