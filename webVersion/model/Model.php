<?php

require_once (File::build_path(array ("config","Conf.php")));

class Model{
	public static $pdo;

	/**
	 * Connection to the database
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function Init(){
		$hostname=Conf::getHostname();
		$database_name=Conf::getDatabase();
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
			$rep=Model::$pdo->query("SELECT * FROM $table_name");
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
	 * Requests a specific project/survey/user identified by $primary_value
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function select($primary_value){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$primary_key=static::$primary;
		$sql = "SELECT * from $table_name WHERE $primary_key=:primary_v";
		$req_prep = Model::$pdo->prepare($sql);
		$values = array(
			"primary_v" => $primary_value,
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
		$req_prep=Model::$pdo->prepare($sql);
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
		$req_prep=Model::$pdo->prepare($sql);
		try{
			$req_prep->execute($data);
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // an error message
			}
			return false;
		}
		$lastid=Model::$pdo->lastInsertId();
		return $class_name::select($lastid);
	}
	/**
	 * Updates a specific project/survey/user
	 * 
	 * @throws "Database error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function update($data){
		$table_name=static::$object;
		$primary_key=static::$primary;
		$sql= "UPDATE $table_name SET";
		foreach ($data as $cle => $valeur){
			$sql .=" $cle=:$cle,";
		}
		$sql=rtrim($sql,",");
		$sql.=" WHERE $primary_key=:$primary_key";
		$req_prep=Model::$pdo->prepare($sql);
		try{
			$req_prep->execute($data);
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // affiche un message d'erreur
			} else {
				echo 'An error occured <a href="./index.php">back to the homepage</a>';
			}
			return false;
		}
		return true;
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

}
Model::Init();
?>
