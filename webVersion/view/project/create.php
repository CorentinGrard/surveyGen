<form method=<?php echo $postOrGet?> action="index.php">
	<input type='hidden' name='controller' value='project'>
	<input type='hidden' name='action' value='created'>
  	<div class="form-group">
		<label for="name_id">Name</label>
		<input type="text" class="form-control w-25" id="name_id" aria-describedby="emailHelp" placeholder="Enter Name of the  project" name="name">
  	</div>
  	<div class="form-group">
		<label for="description_id">Description</label>
		<textarea class="form-control" rows="5" id="description_id" name="description"></textarea>
  	</div>
  	<button type="submit" class="btn btn-primary">Create project</button>
</form>
