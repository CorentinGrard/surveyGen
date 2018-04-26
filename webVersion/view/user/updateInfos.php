<?php
require(File::build_path(array("view","head.php")));
?>
<p>
    Edit your profile
</p>

<form action="updated.php" method="post">
Current e-mail : <?php echo $User->get('email')?>;
<br>
<br>
New e-mail: <input type="text" name="email">
<br>
<br>
<input type="submit">
</form>