<?php
require(File::build_path(array("view","head.php")));
?>

<h1> Edit your profile</h1

<form action="updated.php" method="post">
Current e-mail : <?php echo $User->get('email')?>;
<br>
<br>
New e-mail: <input type="text" name="email">
<br>
<br>
<input type="submit">
</form>