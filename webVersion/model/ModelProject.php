<?php
class ModelProject extends Model{

	private $id;
	private $name;
  	private $description;
  	private $userEmail;

  	static protected $object ='project';
  	protected static $primary='id';
	/**
	 * Select all the projects for a specific user
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
  	public static function selectProjects($email){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$sql = "SELECT * FROM $table_name WHERE useremail=:email";
		$req_prep = Model::$pdo->prepare($sql);
		$values = array(
			"email" => $email,
		);
		try {
			$req_prep->execute($values);
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
			echo $e->getMessage();
			} else {
			echo 'An error occured<a href="./index.php">back to the homepage</a>';
			}
			die();
		}
		$req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		return $req_prep->fetchAll();;
	}

	public static function selectByInfo($data){
		$class_name='Model'.ucfirst($table_name);
		$table_name=static::$object;
		$sql= "SELECT * FROM $table_name WHERE";
		foreach ($data as $cle => $valeur){
			$sql .=" $cle=:$cle AND";
		}
		$sql=rtrim($sql," AND");
		$req_prep=Model::$pdo->prepare($sql);
		try{
			$req_prep->execute($data);
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // an error message
				} else {
					echo 'An error occured<a href="./index.php">back to the homepage</a>';
				}
			die();
		}
		$req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		$tab = $req_prep->fetchAll();
		if (empty($tab))
			return false;
		return $tab[0];
	}

	public static function selectWithEmail($id,$email){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$sql= "SELECT * FROM $table_name WHERE id=:id AND useremail=:email";
		$req_prep=Model::$pdo->prepare($sql);
		$data=array(
			"id"=>$id,
			"email"=>$email,
		);
		try{
			$req_prep->execute($data);
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // affiche un message d'erreur
				} else {
					echo 'Une erreur est survenue <a href="./index.php"> retour a la page d\'accueil </a>';
				}
			die();
		}
		$req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		$tab = $req_prep->fetchAll();
		if (empty($tab))
			return false;
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
	public function __construct($id=NULL, $name=NULL, $description=NULL, $userEmail=NULL){
		if (!is_null($id) && !is_null($description) && !is_null($userEmail)){
			$this->id=$id;
			$this->name=$name;
			$this->description=$description;
			$this->userEmail=$userEmail;
		}
	}
}
?>
