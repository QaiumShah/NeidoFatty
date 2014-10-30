<?php
class Cookie{
	
	public static function exists($uname){
		if(isset($_COOKIE[$uname])){
			return true;
		}else{return false;}
	}

	public static function get($uname){
		return $_COOKIE[$uname];
	}

	public static function set($uname, $value, $expiry){
		if(setcookie($uname, $value, time() + $expiry, '/')){
		 return true;
		}
		return false;
	}

	public static function remove($uname){
		$this-> set($name, '' , time()- 1);
	}
}

?>