<?php
class ModelQuestion extends Model{

	private $id;
	private $idSurvey;
	private $idType;
	private $title;
	private $description;

	static protected $object ='question';
	protected static $primary='id';

	public static function maxId($primary_value){
		$table_name=static::$object;
		$class_name='Model'.ucfirst($table_name);
		$primary_key=static::$primary;
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
			return 0;
		return $tab[0];
	}

	///constructor
	public function __construct($id=NULL, $idSurvey=NULL, $idType=NULL,$description=NULL,$title=NULL, $startDate=NULL, $finalDate=NULL, $DBnName=NULL){
		if (!is_null($id) && !is_null($idSurvey) && !is_null($idType) && !is_null($description) && !is_null($title)){
			$this->id=$id;
			$this->idSurvey=$idSurvey;
			$this->idType=$idType;
			$this->description=$description;
			$this->title=$title;
		}
	}
}
?>
