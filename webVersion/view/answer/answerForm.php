<?php
require(File::build_path(array("view","head.php")));
?>
</head>
<script>
var questionsType=[<?php 
foreach($questions as $question){
	echo $question['idtype'].",";
}
?>]
</script>
<body class="backgroundPhoto">
	<div class="container">
		<div class="card card-register mx-auto mt-5">
			<div class="card-header">
				<div><?php echo htmlspecialchars($survey->get('name')); ?></div>
				<div><?php echo htmlspecialchars($survey->get('description')); ?></div>
			</div>
			<div class="card-body">
				<form id="answer">
					<?php foreach($questions as $key => $question){ ?>
					<div class="form-group">
						<label for="Q<?php echo $key; ?>_id"><?php echo htmlspecialchars($question['title']) ?></label>
						<?php switch($question['idtype']) {
							case 1:
								echo '<textarea id="Q'.$key.'_id" class="form-control" placeholder="Response"></textarea>';
								break;
							case 2:
								echo '<input id="Q'.$key.'_id" class="form-control" type="number" value=0>';
								break;
							case 3:
								echo '<input id="Q'.$key.'_id" class="form-control" type="number" step="0.01" value=0>';
								break;
							case 4:
								echo '<input id="Q'.$key.'_id" class="form-control" type="date">';
								break;
							case 5:
								echo '<input id="Q'.$key.'_id" class="form-control" type="range" min="0" max="10">';
								break;
							case 6:
								foreach($question['options'] as $key2 => $option){
									echo '<input class="form-control Q'.$key.'_class" type="radio" value='.pow(2,$key2).'> '. htmlspecialchars($option['description']);
								}
								break;
							case 7:
								foreach($question['options'] as $key2 => $option){
									echo '<input class="form-control Q'.$key.'_class" type="radio" value='.pow(2,$key2).'> '. htmlspecialchars($option['description']);
								}
								echo '<input class="form-control Q'.$key.'_class" type="radio" value='.pow(2,$key2+1).'><input type="text" placeholder=Other answer">';					
								break;
							case 8:
								foreach($question['options'] as $key2 => $option){
									echo '<input class="form-control Q'.$key.'_class" type="checkbox" value='.pow(2,$key2).'> '. htmlspecialchars($option['description']);
								}
								break;
							case 9:
								foreach($question['options'] as $key2 => $option){
									echo '<input class="form-control Q'.$key.'_class" type="checkbox" value='.pow(2,$key2).'> '. htmlspecialchars($option['description']);
								}
								echo '<input type="checkbox" class="Q'.$key.'_class" value='.pow(2,$key2+1).'><input type="text" placeholder=Other answer">';					
								break;
						}?>
					</div>
					<?php } ?> 
					<input class="btn btn-primary btn-block" type="button" value="Submit answer">
				</form>
			</div>
		</div>
		<script src="./js/answerForm.js" defer></script>
<?php
require(File::build_path(array("view","endFile.php")));
?>