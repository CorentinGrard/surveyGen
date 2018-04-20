<?php echo htmlspecialchars($project->get('name')); ?>
<a class="d-block small mt-3" href="?controller=project&action=update&id=<?php echo $project->get('id');?>">Update</a>
