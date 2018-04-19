<?php
	$login=htmlspecialchars($login);
	echo '<div class="alert alert-dismissible alert-success panier">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	L\'utilisateur '.$login.' a bien été créé !</div>';
	require (File::build_path(array ("view","utilisateur","connect.php")));
?>
