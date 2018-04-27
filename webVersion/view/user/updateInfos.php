<?php
require(File::build_path(array("view","head.php")));
?>

<h1> Edit your profile</h1>

<form method="<?php echo $postOrGet; ?>" action="index.php">
<input type='hidden' name='controller' value='user'>
<input type='hidden' name='action' value='updated'>
<input type="text" name="email" value=<?php echo $u->get('email');?>>
<br>
<br>
<input type="submit">
</form>
