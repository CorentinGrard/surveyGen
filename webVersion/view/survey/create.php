<form id="survey">
	<input type='hidden' name='controller' value='survey'>
	<input type='hidden' name='action' value='created'>
	<div class="form-group">
		<label for="project_id">Project</label>
		<select id="project_id" name="project">
			<option value=0>Choose a project</option>
			<?php
			foreach($projects as $project){?>
			<option value="<?php echo $project->get('id');?> "><?php echo $project->get('name'); ?> </option>
			<?php } ?>
		</select>
  	</div>
  	<div class="form-group">
		<label for="name_id">Name</label>
		<input type="text" class="form-control w-25" id="name_id" aria-describedby="namelHelp" placeholder="Enter Name of the survey" name="name">
  	</div>
  	<div class="form-group">
		<label for="description_id">Description</label>
		<textarea class="form-control" rows="5" id="description_id" name="description"></textarea>
  	</div>
    <div class="form-group">
		<label for="objective_id">Objective</label>
		<input type="text" class="form-control w-25" id="objective_id" aria-describedby="objectiveHelp" placeholder="Enter the objective of the survey" name="objective">
  	</div>
    <div class="form-group">
		<label for="sDate_id">Start date</label>
		<input type="date" class="form-control w-25" id="sDate_id" name="sDate" min=<?php echo $today;?>>
  	</div>
    <div class="form-group">
		<label for="eDate_id">End date</label>
		<input type="date" class="form-control w-25" id="eDate_id" name="eDate" min=<?php echo $today;?>>
  	</div>
		<div id="questions">
		</div>
		<button id="addQuestion" type="button"><i class="fa fa-plus-circle"></i> Add a question</button>
		<br>
		<br>
  	<button class="btn btn-primary">Create survey</button>
</form>
<<<<<<< HEAD
<script src="./js/classSurvey.js" defer></script>
<script src="./js/createSurvey.old.js" defer></script>
=======
<script src="./js/createSurvey.js" defer></script>
>>>>>>> 9c6aeb115b711b572787aacdea2409bdb337ba6e
