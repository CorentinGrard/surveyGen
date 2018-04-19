<?php
	$login=htmlspecialchars($login);
		echo '<div class="alert alert-dismissible alert-success panier">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		L\'utilisateur avec le login '.$login.' a été supprimé</div>';
    require (File::build_path(array ("view","utilisateur","list.php")));
?>
