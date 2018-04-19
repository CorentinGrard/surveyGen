<?php
	echo '<div class="alert alert-dismissible alert-success panier">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	L\'utilisateur avec le login '.$login.' a bien été mis à jour !</div>';
	require (File::build_path(array ("view","utilisateur","detail.php")));
?>
