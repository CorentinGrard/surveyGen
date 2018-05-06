<?php
class ModelOptionAnswer extends ModelAnswer{

  private $idSurveyAnswered;
  private $idQuestion;
  private $answer;

  static protected $object ='optionanswer';
  protected static $primary=array('idSurveyAnswered','idQuestion');

  //getter
  public function get($attribut) {
    if (property_exists($this, $attribut)) {
      return $this->$attribut;
    }
  }

  //setter
    public function set($attribut,$valeur) {
      if (property_exists($this, $attribut)) {
        $this->$attribut=$valeur;
     }
  }
  
  ///constructor
  public function __construct($idSurveyAnswered=NULL, $idQuestion=NULL, $answer=NULL){
    if (!is_null($idSurveyAnswered) && !is_null($idQuestion) && !is_null($answer)){
        $this->idSurveyAnswered=$idSurveyAnswered;
        $this->idQuestion=$idQuestion;
        $this->answer=$answer;
    }
  }
}
?>
