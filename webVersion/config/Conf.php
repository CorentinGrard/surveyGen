<?php

class Conf{
	static private $databases = array(
		'hostname' => 'localhost',
		'database' => 'surveys',
		'login' => 'postgres',
		'password' => '1234'
	);

	static private $debug = true;

	/**
	 * To know if the website is in production or in creation
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 * @return boolean
	 */ 
	static public function getDebug() {
		return self::$debug;
	}

	/**
	 * If the website in in production we use POST if it's not we use GET
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 * @return string
	 */ 
	static public function getPostOrGet(){
		if(self::$debug){
			return 'get';
		}else{
			return 'post';
		}
	}

	/**
	 * To get Login of the database
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 * @return string
	 */ 
	static public function getLogin() {
		return self::$databases['login'];
	}

	/**
	 * To get hostname of the database
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 * @return string
	 */ 
	static public function getHostname() {
		return self::$databases['hostname'];
	}

	/**
	 * To get database name of the database
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 * @return string
	 */ 
	static public function getDatabase() {
		return self::$databases['database'];
	}

	/**
	 * To get the password of the database
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 * @return string
	 */ 
	static public function getPassword() {
		return self::$databases['password'];
	}

}
?>
