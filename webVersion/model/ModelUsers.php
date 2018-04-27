<?php
class ModelUsers extends Model{

	private $email;
	private $idprofession;
	private $name;
	private $lastname;
	private $password;
	private $birthdate;
	private $nonce;

	static protected $object ='Users';
	protected static $primary='email';

	// public static function update($data){
	// 	$sql= "UPDATE users SET";
	// 	foreach ($data as $key => $value){
	// 		$sql .=" $key=:$key,";
	// 	}
	// 	$sql=rtrim($sql,",");
	// 	$sql.=" WHERE $primary_key=:$primary_key";
	// 	$req_prep=Model::$pdo->prepare($sql);
	// }
	public static function checkPassword($email,$password){
		$u=ModelUsers::select($email);
		if(!$u==false && $u->get('email')==$email && $u->get('password')==$password){
			return true;
		}else{
			return false;
		}
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
	public function __construct($email=NULL, $idprofession=NULL, $name=NULL, $lastname=NULL, $passord=NULL, $birthdate=NULL, $nonce=NULL){
		if (!is_null($email) && !is_null($idprofession) && !is_null($name) && !is_null($lastname) && !is_null($password) && !is_null($birthdate) &&!is_null($nonce)){
				$this->email=$email;
				$this->idprofession=$idprofession;
				$this->name=$name;
				$this->lastname=$lastname;
				$this->password=$password;
				$this->birthdate=$birthdate;
				$this->nonce=$nonce;
		}
	}


}
?>
