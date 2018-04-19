<?php
class Conf{
	static private $databases = array(
		'hostname' => 'localhost',
		'database' => 'surveys',
		'login' => 'postgres',
		'password' => '1234'
	);

	static private $debug = true;

	static public function getDebug() {
		return self::$debug;
	}

	static public function getPostOrGet(){
		if(self::$debug){
			return 'get';
		}else{
			return 'post';
		}
	}

	static public function getLogin() {
		return self::$databases['login'];
	}
	static public function getHostname() {
		return self::$databases['hostname'];
	}
	static public function getDatabase() {
		return self::$databases['database'];
	}
	static public function getPassword() {
		return self::$databases['password'];
	}

}
?>
