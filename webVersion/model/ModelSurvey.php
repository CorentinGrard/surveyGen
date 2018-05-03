<?php
class ModelSurvey extends Model{

	private $id;
	private $projectid;
	private $name;
	private $description;
	private $objective;
	private $startdate;
	private $finaldate;
	private $dbname;

	static protected $object ='survey';
	protected static $primary='id';
	
	/**
	 * Requests all the surveys of a specific project
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function selectByProject($projectid){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		try {
			$rep=Model::$pdo->query("SELECT * FROM $table_name WHERE projectid=$projectid");
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
			echo $e->getMessage(); // an error message
			} else {
			echo 'An error occured<a href="./index.php">back to the home page</a>';
			}
			die();
			}
		$rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		return $rep->fetchAll();
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

	public static function createSurveyDatabase($newSurveyId) {
		$table_name = "survey_".$newSurveyId;
		$sql = "CREATE DATABASE $table_name WITH TEMPLATE=\"finalDatabase\"";
		$req_prep=Model::$pdo->prepare($sql);
		try{
			$req_prep->execute();
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // an error message
			} else {
				echo 'An error occured <a href="./index.php">back to the homepage </a>';
			}
			return false;
		}
		return true;
	}

	///constructor
	public function __construct($id=NULL, $projectid=NULL, $name=NULL,$description=NULL,$objective=NULL, $startdate=NULL, $finaldate=NULL, $dbname=NULL){
		if (!is_null($id) && !is_null($projectid) && !is_null($name) && !is_null($description) && !is_null($objective) && !is_null($startdate) &&!is_null($finaldate)&&!is_null($dbname)){
			$this->id=$id;
			$this->projectid=$projectid;
			$this->name=$name;
			$this->description=$description;
			$this->objective=$objective;
			$this->startdate=$startdate;
			$this->finaldate=$finaldate;
			$this->dbname=$dbname;
		}
	}
}
?>
