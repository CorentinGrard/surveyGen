<?php
class ModelQuestionOption extends Model{

	private $idoption;
    private $idquestion;
    private $idsurvey;

	static protected $object ='questionOption';
	static protected $primary=array('idoption','idquestion',"idsurvey");

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
		return $class_name::select($data);
	}

	public static function select($data){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$primary_key_1=static::$primary[0];
		$primary_key_2=static::$primary[1];
		$primary_key_3=static::$primary[2];
		$sql = "SELECT * from $table_name WHERE $primary_key_1=:idoption AND $primary_key_2=:idquestion AND $primary_key_3=:idsurvey";
		$req_prep = Model::$pdo->prepare($sql);
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

	public static function selectByQuestion($data){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$primary_key_1=static::$primary[1];
		$primary_key_2=static::$primary[2];
		$sql = "SELECT * from $table_name WHERE $primary_key_1=:idquestion AND $primary_key_2=:idsurvey";
		$req_prep = Model::$pdo->prepare($sql);
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

	///constructor
	public function __construct($idoption=NULL,$idquestion=NULL, $idsurvey=NULL){
		if (!is_null($idoption) && !is_null($idquestion) && !is_null($idsurvey)){
			$this->idoption=$idoption;
            $this->idquestion=$idquestion;
            $this->idsurvey=$idsurvey;
		}
	}
}
?>
