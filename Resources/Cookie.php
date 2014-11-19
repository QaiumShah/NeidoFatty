<?php
class Cookie{
	
	public function exists($uname){
		if(isset($_COOKIE[$uname])){
			return true;
		}else{return false;}
	}

	public function get($uname){
		return $_COOKIE[$uname];
	}

	public function set($uname, $value, $expiry){
		if(setcookie($uname, $value, time() + $expiry, '/')){
		 return true;
		}
		return false;
	}

	public function remove($uname){
		$this->set($uname, '' , time()- 1);
	}
}

?>