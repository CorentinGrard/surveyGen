<?php

require_once (File::build_path(array ("config","Conf.php")));

class ModelAnswer{
	public static $pdo;

	/**
	 * Connection to the database
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function Init($database){
		$hostname=Conf::getHostname();
		$database_name=$database;
		$login=Conf::getLogin();
		$password=Conf::getPassword();
		try {
			self::$pdo = new PDO("pgsql:dbname=$database_name;host=$hostname", $login, $password);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
			echo $e->getMessage();//an error message
			} else {
			echo 'An error occured <a href="./index.php">back to the home page</a>';
			}
			die();
		}
	}
	
	/**
	 * Requests all the  projects/surveys/users...
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function selectAll(){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		try {
			$rep=ModelAnswer::$pdo->query("SELECT * FROM $table_name");
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
			echo $e->getMessage(); //an error message
			} else {
			echo 'An error occured <a href="./index.php">back to the home page</a>';
			}
			die();
			}
		$rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		return $rep->fetchAll();
	}

  	 /**
	 * Requests a specific project/survey/user identified by $data
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function select($data){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$primary_key=static::$primary;
		$sql = "SELECT * from $table_name WHERE";
		foreach($data as $key => $value){
			$sql.=" $key=:$key AND";
		}
		$sql=rtrim($sql," AND");
		$req_prep = ModelAnswer::$pdo->prepare($sql);
		try{
			$req_prep->execute($data);
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
		if (empty($tab))
			return false;
		return $tab[0];
	}

	/**
	 * Delete a specific project/survey/user identified by $primary
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function delete($primary){
		$table_name=static::$object;
		$primary_key=static::$primary;
		$sql= "DELETE FROM $table_name WHERE $primary_key=:primary_v";
		$req_prep=ModelAnswer::$pdo->prepare($sql);
		$values = array(
			"primary_v" => $primary,
		);
		try{
			$req_prep->execute($values);
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); //an error message
			} else {
				echo 'An error occured <a href="./index.php">back to the homepage</a>';
			}
			return false;
		}
		return true;
	}

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
		return $class_name::select($data);
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
    
    public function __construct($id=NULL,$description=NULL){
		if (!is_null($id) && !is_null($description)){
			$this->id=$id;
			$this->description=$description;
		}
	}
}
?>
