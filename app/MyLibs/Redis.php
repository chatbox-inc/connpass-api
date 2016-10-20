<?php

namespace App\MyLibs;

class Redis {
	private static $client = null;
	
	function __construct() {
		if(is_null(self::$client)) {
			self::$client = new \Predis\Client();
		}
	}

	function get($key) {
		return json_decode(self::$client->get($key),TRUE);
	}

	function set($key,$value) {
		$json_string = json_encode($value);
		self::$client->set($key,$json_string);
	}
};