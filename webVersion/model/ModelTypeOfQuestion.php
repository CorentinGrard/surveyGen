<?php
class ModelTypeOfQuestion extends Model{

	private $id;
	private $description;

	static protected $object ='TypeOfQuestion';
	protected static $primary='id';

	public static function selectAll(){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		try {
			$rep=Model::$pdo->query("SELECT * FROM $table_name");
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // affiche un message d'erreur
			} else {
				echo 'Une erreur est survenue <a href="./index.php"> retour a la page d\'accueil </a>';
			}
			die();
			}
		$rep->setFetchMode(PDO::FETCH_ASSOC);
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
	
	///constructeur
	public function __construct($id=NULL, $description=NULL){
		if (!is_null($id) && !is_null($description)){
			$this->id=$id;
			$this->description=$description;
		}
	}
}
?>
