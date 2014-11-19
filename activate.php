<?php
require_once('resources/nfsite_config.php');

if(null!==($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email'])){
	$email = $_GET['email'];	 
}

if (null!==($_GET['key'] ) && (strlen($_GET['key']) == 32 )) {
	$key = $_GET['key'];
}

if(isset($email) && isset($key)){
	if($useract->emailActivation($email, $key) == true){
		echo 'Your email is activated. Please <a href="login.php">Login</a> to continue enjoying our site.';
	}
	else{
		echo'Oops! Email Activation is failed. Please contact the system administrator';
	}
}


?>

