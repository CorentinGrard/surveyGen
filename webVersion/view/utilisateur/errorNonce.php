<?php
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Attention ! </strong> Vous n\'avez pas validé votre mail, regardez vos mails !
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>';
  require(File::build_path(array ("view","utilisateur","connect.php")));
 ?>
