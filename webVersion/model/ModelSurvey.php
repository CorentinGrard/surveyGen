<?php
class ModelSurvey extends Model{

  private $id;
  private $idProject;
  private $name;
  private $nonce
  private $password
  private $description;
  private $objective;
  private $startDate;
  private $finalDate;
  private $DBnName;

  static protected $object ='survey';
  protected static $primary='id';


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
  
  ///constructeur
  public function __construct($id=NULL, $idProject=NULL, $name=NULL,$description=NULL,$objective=NULL, $startDate=NULL, $finalDate=NULL, $DBnName=NULL){
    if (!is_null($id) && !is_null($idProject) && !is_null($name) && !is_null($description) && !is_null($objective) && !is_null($startDate) &&!is_null($finalDate)&&!is_null($DBnName)){
        $this->id=$id;
        $this->idProject=$idProject;
        $this->name=$name;
        $this->description=$description;
        $this->objective=$objective;
        $this->startDate=$startDate;
        $this->finalDate=$finalDate;
        $this->DBnName=$DBnName;
    }
  }
}
?>
