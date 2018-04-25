<?php

require_once (File::build_path(array ("config","Conf.php")));

class Model{
	public static $pdo;

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
			echo $e->getMessage(); // affiche un message d'erreur
			} else {
			echo 'Une erreur est survenue <a href="./index.php"> retour a la page d\'accueil </a>';
			}
			die();
		}
	}
	
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
		$rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		return $rep->fetchAll();
	}

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
			echo $e->getMessage(); // affiche un message d'erreur
			} else {
				echo 'Une erreur est survenue <a href="./index.php"> retour a la page d\'accueil </a>';
			}
			die();
		}
		// On récupère les résultats comme précédemment
		$req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		$tab = $req_prep->fetchAll();
		// Attention, si il n'y a pas de résultats, on renvoie false
		if (empty($tab))
			return false;
		return $tab[0];
	}

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
				echo $e->getMessage(); // affiche un message d'erreur
			} else {
				echo 'Une erreur est survenue <a href="./index.php"> retour a la page d\'accueil </a>';
			}
			return false;
		}
		return true;
	}

	public static function save($data){
		$table_name=static::$object;
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
				echo $e->getMessage(); // affiche un message d'erreur
			}
			return false;
		}
		return true;
	}

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
				echo 'Une erreur est survenue <a href="./index.php"> retour a la page d\'accueil </a>';
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
