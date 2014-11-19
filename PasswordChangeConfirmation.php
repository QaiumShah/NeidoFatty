<?php require_once('Resources/nfsite_config.php'); 

$email = $_GET['email'];

if(isset($_GET['submitted']))
{
	if($pass = ($_GET['password'] == $_GET['retypepass'])){	
		$useract->changePassword($pass, $email);
		echo'<p> Your password has been changed. Please <a href="login.php">login</a> with your new password to enjoy our site. </p>';
	}
	else{
		$nfsite->setErrorMessage("Sorry password doesn't match. Please enter your new password again.");
	}
}

include('header.php');
?>
	<p> Your password has been changed. Please <a href="login.php">login</a> with your new password to enjoy our site. </p>
<?php include('footer.php');?>



