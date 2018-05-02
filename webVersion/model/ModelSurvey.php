<?php
class ModelSurvey extends Model{

	private $id;
	private $idProject;
	private $name;
	private $description;
	private $objective;
	private $startDate;
	private $finalDate;
	private $DBnName;

	static protected $object ='survey';
	protected static $primary='id';
	
	/**
	 * Requests all the surveys of a specific project
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function selectByProject($idProject){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		try {
			$rep=Model::$pdo->query("SELECT * FROM $table_name WHERE projectid=$idProject");
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

	///constructor
	public function __construct($id=NULL, $idProject=NULL, $name=NULL,$description=NULL,$objective=NULL, $startDate=NULL, $finalDate=NULL, $DBnName=NULL){
		if (!is_null($id) && !is_null($idProject) && !is_null($name) && !is_null($description) && !is_null($objective) && !is_null($startDate) &&!is_null($finalDate)&&!is_null($DBnName)){
			$this->id=$id;
			$this->idProject=$idProject;
			$this->name=$name;
			$this->description=$description;
			$this->objective=$objective;
			$this->startDate=$startDate;
			$this->finalDate=$finalDate;
			$this->DBnName=$DBnName;
		}
	}
}
?>
