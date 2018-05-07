<?php
class ModelSurveyAnswered extends ModelAnswer{

	private $id;
	private $idUser;

	static protected $object ='surveyanswered';
	protected static $primary='id';

		/**
	 * Saves a new project/survey/user in the database
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function save($data){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$sql= "INSERT INTO $table_name(";
		foreach ($data as $cle => $valeur){
			$sql .=" $cle,";
		}
		$sql=rtrim($sql,",").")";
		$sql.=" VALUES (";
		foreach ($data as $cle => $valeur){
			$sql .=" :$cle,";
		}
		$sql=rtrim($sql,",").")";
		$req_prep=ModelAnswer::$pdo->prepare($sql);
		try{
			$req_prep->execute($data);
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // an error message
			}
			return false;
		}
		$lastid=ModelAnswer::$pdo->lastInsertId();
		return $class_name::select(array("id" => $lastid));
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

	public static function getNbAnswers() {
		$table_name="surveyanswered";
		$primary_key=static::$primary;
		$sql= "SELECT id FROM $table_name";
		$req_prep=ModelAnswer::$pdo->prepare($sql);
		try{
			$req_prep->execute();
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); //an error message
			} else {
				echo 'An error occured <a href="./index.php">back to the homepage</a>';
			}
			return false;
		}
		$req_prep->setFetchMode(PDO::FETCH_ASSOC);
		$tab = $req_prep->fetchAll();
		return sizeof($tab);
	}
	
	///constructor
	public function __construct($id=NULL, $idUser=NULL){
		if (!is_null($id) && !is_null($idUser)){
				$this->id=$id;
				$this->idUser=$idUser;
		}
	}
}
?>
