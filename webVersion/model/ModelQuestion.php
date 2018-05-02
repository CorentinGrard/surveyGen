<?php
class ModelQuestion extends Model{

	private $id;
	private $idSurvey;
	private $idType;
	private $title;
	private $description;

	static protected $object ='question';
	protected static $primary=array('id','idSurvey');

	///constructor
	public function __construct($id=NULL, $idSurvey=NULL, $idType=NULL,$description=NULL,$title=NULL, $startDate=NULL, $finalDate=NULL, $DBnName=NULL){
		if (!is_null($id) && !is_null($idSurvey) && !is_null($idType) && !is_null($description) && !is_null($title)){
			$this->id=$id;
			$this->idSurvey=$idSurvey;
			$this->idType=$idType;
			$this->description=$description;
			$this->title=$title;
		}
	}
}
?>
