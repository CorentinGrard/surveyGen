<?php
class ModelUser extends Model{

  private $login;
  private $pass;
  private $name;
  private $email;
  private $birthD;
  private $nonce;

  static protected $object ='Utilisateur';
  protected static $primary='login';

  public static function checkPassword($login,$mot_de_passe_chiffre){
    $u=ModelUser::select($login);
    if(!$u==false && $u->get('login')==$login && $u->get('pass')==$mot_de_passe_chiffre){
      return true;
    }else{
      return false;
    }
  }

  public static function getNameByLogin($login){
    $table_name=static::$object;
    $primary_key=static::$primary;
    $sql = "SELECT name from $table_name WHERE $primary_key=:primary_v";
    $req_prep = Model::$pdo->prepare($sql);
    $values = array(
        "primary_v" => $login,
    );
    try{
      $req_prep->execute($values);
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
        } else {
          echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
        die();
    }
    $tab = $req_prep->fetchAll(PDO::FETCH_ASSOC);
    if (empty($tab))
        return false;
    return $tab[0]['name'];
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
