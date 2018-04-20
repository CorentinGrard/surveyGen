<form method=<?php echo $postOrGet?> action="index.php">
    <input type='hidden' name='id' value=<?php echo $project->get('id');?>>
	<input type='hidden' name='controller' value='project'>
	<input type='hidden' name='action' value='updated'>
  	<div class="form-group">
		<label for="name_id">Name</label>
		<input type="text" class="form-control w-25" id="name_id" aria-describedby="emailHelp" placeholder="Enter Name of the  project" name="name" value=<?php echo htmlspecialchars($project->get('name'));?>>
  	</div>
  	<div class="form-group">
		<label for="description_id">Description</label>
		<textarea class="form-control" rows="5" id="description_id" name="description"><?php echo htmlspecialchars($project->get('description'));?></textarea>
  	</div>
  	<button type="submit" class="btn btn-primary">Update project</button>
</form>