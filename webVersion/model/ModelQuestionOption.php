<?php
class ModelQuestionOption extends Model{

	private $idOption;
    private $idQuestion;
    private $idSurvey;

	static protected $object ='questionOption';

	///constructor
	public function __construct($idOption=NULL,$idQuestion=NULL, $idSurvey=NULL){
		if (!is_null($idOption) && !is_null($idQuestion) && !is_null($idSurvey)){
			$this->idOption=$idOption;
            $this->idQuestion=$idQuestion;
            $this->idSurvey=$idSurvey;
		}
	}
}
?>
