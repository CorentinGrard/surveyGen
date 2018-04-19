<?php
class ModelUser extends Model{

  private $login;
  private $pass;
  private $name;
  private $email;
  private $birthD;
  private $nonce;

  static protected $object ='User';
  protected static $primary='email';

  public static function checkPassword($email,$password){
    $u=ModelUser::select($email);
    if(!$u==false && $u->get('email')==$login && $u->get('password')==$password){
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
  public function __construct($login=NULL, $pass=NULL, $name=NULL, $email=NULL, $nonce=NULL, $birthD=NULL){
    if (!is_null($login) && !is_null($pass) && !is_null($name) && !is_null($email) && !is_null($nonce) && !is_null($admin) &&!is_null($birthD)){
        $this->login=$login;
        $this->pass=$pass;
        $this->birthD=$birthD;
        $this->name=$name;
        $this->email=$email;
        $this->nonce=$nonce;
    }
  }
}
?>
