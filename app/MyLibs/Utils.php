<?php

namespace App\MyLibs;

class Utils {
	public static function array_until($array, $callback){
		$r = [];
		foreach($array as $a) {
			if( $callback($a) ) break;
			$r[] = $a;
		}
		return $r;
	}
}

?>