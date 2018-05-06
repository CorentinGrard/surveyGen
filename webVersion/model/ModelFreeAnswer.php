<?php
class ModelFreeAnswer extends ModelAnswer{

	private $id;
	private $idSurveyAnswered;
	private $idQuestion;
	private $answer;

	static protected $object ='freeanswer';
	protected static $primary=array('id','idSurveyAnswered','idQuestion');

	public static function maxId($data){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$primary_key_1=static::$primary[1];
		$primary_key_2=static::$primary[2];
		$sql = "SELECT MAX(id) FROM $table_name WHERE $primary_key_1=:primary_v_1 $primary_key_2=:primary_v_2";
		$req_prep = ModelAnswer::$pdo->prepare($sql);
		$values = array(
			"primary_v_1" => $data[0],
			"primary_v_2" => $data[1],
		);
		try{
			$req_prep->execute($values);
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
			echo $e->getMessage(); // an error message
			} else {
				echo 'An error occured <a href="./index.php">back to the homepage</a>';
			}
			die();
		}
		//We get the results in a table
		$req_prep->setFetchMode(PDO::FETCH_ASSOC);
		$tab = $req_prep->fetchAll();
		//If there is no result, we return false
		if (!isset($tab[0]['max'])){
			return -1;
		}
		return $tab[0]['max'];	
	}

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
	public function __construct($id=NULL, $idSurveyAnswered=NULL, $idQuestion=NULL, $answer=NULL){
		if (!is_null($id) && !is_null($idSurveyAnswered) && !is_null($idQuestion) && !is_null($answer)){
				$this->id=$id;
				$this->idSurveyAnswered=$idSurveyAnswered;
				$this->idQuestion=$idQuestion;
				$this->answer=$answer;
		}
	}
}
?>
