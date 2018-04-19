<?php
class Security{

	private static $seed = 'e8MBGmWskrQJXrBKHOWZ';

	public static function encode($texte_en_clair) {
	 	$texte_chiffre = hash('sha256', $texte_en_clair.Security::$seed);
	  	return $texte_chiffre;
	}

	public static function getSeed() {
   		return self::$seed;
	}
	public static function generateRandomHex() {
		// Generate a 32 digits hexadecimal number
		$numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
		$bytes = openssl_random_pseudo_bytes($numbytes);
		$hex   = bin2hex($bytes);
		return $hex;
	}
}
?>
