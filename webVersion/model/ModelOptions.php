<?php
class ModelOptions extends Model{

	private $id;
	private $description;

	static protected $object ='options';
	protected static $primary='id';

	public static function selectByDescription($description){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$primary_key=static::$primary;
		$sql = "SELECT * from $table_name WHERE description=:primary_v";
		$req_prep = Model::$pdo->prepare($sql);
		$values = array(
			"primary_v" => $description,
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
		$req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		$tab = $req_prep->fetchAll();
		//If there is no result, we return false
		if (empty($tab)) return false;
		return $tab[0];
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
	public function __construct($id=NULL,$description=NULL){
		if (!is_null($id) && !is_null($description)){
			$this->id=$id;
			$this->description=$description;
		}
	}
}
?>
