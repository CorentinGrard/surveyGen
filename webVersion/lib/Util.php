<?php

class Util {

	public static function aff($array) {
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}

	public static function myGet($nomvar){
		if(isset($_GET[$nomvar])){
			return $_GET[$nomvar];
		}else if(isset($_POST[$nomvar])){
			return $_POST[$nomvar];
		}else{
			return NULL;
		}
	}
}

?>