<?php
class ModelProfession extends Model{

  private $id;
  private $description;

  static protected $object ='Profession';
  protected static $primary='id';

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
  
  ///constructor
  public function __construct($id=NULL, $description=NULL){
    if (!is_null($id) && !is_null($description)){
        $this->id=$id;
        $this->description=$description;
    }
  }
}
?>
