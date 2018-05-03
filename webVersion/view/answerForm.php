private static function blockQuestionHTML($name,$label, $type, $description, $idQuestion){
		$block = "<div>\n";
		if ($type == "free"){
			$block += "<label for=\"Q$idQuestion\">$label</label>\n
			<input id=\"Q$idQuestion\" type=\"text\" name=\"$name\" aria-describedby=\"datelHelp\">\n
			</div>\n"
			return $block;
		}
		if (type == option) {
			$options=ModelOptions::selectA();
			foreach ()
		}
	}
	private static function createHTMLSurvey($survey){
		$label = "<h1>$survey->name</h1>";

		foreach($survey->questions as $key => $question){
			Util::aff(ModelQuestion::maxId($newSurvey->get('id')));
			$newQuestion=ModelQuestion::save(array(
				"id" => ModelQuestion::maxId($newSurvey->get('id')),
				"idSurvey" => $newSurvey->get('id'),
				"idType" => $question->type,
				"title" => $question->title,
				"description" => $question->description//TO DO
			));
			foreach($question->answers as $answer){
				$description=strtolower($answer->description);
				$newAnswer=ModelOption::selectByDescription($description);
				if($newAnswer==false){
					$newAnswer=ModelOption::save(array(
						"description" => $description
					));
				}
				ModelQuestionOption::save(array(
					"idOption" => $newAnswer->get('id'),
					"idQuestion" => $question->get('id'),
					"idSurvey" => $newSurvey->get('id'),
				));
			}
		}
	}

	public static function createSurveyDatabase($newSurveyId) {
		$table_name = "survey_".$newSurveyId;
		$sql = "CREATE DATABASE $table_name TEMPLATE finalDatabase";
	}