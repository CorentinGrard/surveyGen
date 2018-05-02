<?php
class ModelAnswer extends Model{

	private $id;
	private $description;

	static protected $object ='answer';
	protected static $primary='id';

	///constructor
	public function __construct($id=NULL,$description=NULL){
		if (!is_null($id) && !is_null($description)){
			$this->id=$id;
			$this->description=$description;
		}
	}
}
?>
