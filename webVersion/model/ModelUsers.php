<?php
class ModelUsers extends Model{

	private $email;
	private $idProfession;
	private $name;
	private $lastName;
	private $passord;
	private $birthDate;
	private $nonce;

	static protected $object ='Users';
	protected static $primary='email';

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
	public function __construct($email=NULL, $idProfession=NULL, $name=NULL, $lastName=NULL, $passord=NULL, $birthDate=NULL, $nonce=NULL){
		if (!is_null($email) && !is_null($idProfession) && !is_null($name) && !is_null($lastName) && !is_null($passord) && !is_null($birthDate) &&!is_null($nonce)){
				$this->email=$email;
				$this->idProfession=$idProfession;
				$this->name=$name;
				$this->lastName=$lastName;
				$this->passord=$passord;
				$this->birthDate=$birthDate;
				$this->nonce=$nonce;
		}
	}
}
?>
