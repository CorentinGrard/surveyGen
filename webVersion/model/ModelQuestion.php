<?php
class ModelQuestion extends Model{

	private $id;
	private $idsurvey;
	private $idtype;
	private $title;
	private $description;

	static protected $object ='question';
	protected static $primary=array('id','idSurvey');

	public static function maxId($primary_value){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$primary_key=static::$primary[0];
		$sql = "SELECT MAX('id') FROM $table_name WHERE $primary_key=:primary_v";
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
		$req_prep->setFetchMode(PDO::FETCH_ASSOC);
		$tab = $req_prep->fetchAll();
		//If there is no result, we return false
		if (empty($tab['max']))
			return -1;
		return $tab[0];
	}

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
		return $class_name::select(array(
			"id" => $data['id'],
			"idSurvey" => $data['idSurvey'],
		));
	}

	public static function select($data){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$primary_key_1=static::$primary[0];
		$primary_key_2=static::$primary[1];
		$sql = "SELECT * from $table_name WHERE $primary_key_1=:id AND $primary_key_2=:idSurvey";
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
	public function __construct($id=NULL, $idsurvey=NULL, $idtype=NULL,$description=NULL,$title=NULL, $startDate=NULL, $finalDate=NULL, $DBnName=NULL){
		if (!is_null($id) && !is_null($idsurvey) && !is_null($idtype) && !is_null($description) && !is_null($title)){
			$this->id=$id;
			$this->idsurvey=$idsurvey;
			$this->idtype=$idtype;
			$this->description=$description;
			$this->title=$title;
		}
	}
}
?>
