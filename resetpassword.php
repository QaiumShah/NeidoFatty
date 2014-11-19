<?php
require_once('resources/nfsite_config.php');

if(null!==($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email'])){
	$email = $_GET['email'];	 
}

if (null!==($_GET['key'] ) && (strlen($_GET['key']) == 32 )) {
	$key = $_GET['key'];
}


if(isset($email) && isset($key)){
	include('header.php'); ?>
	<div class="container">
		<div class="row">
			<?php if($useract->emailActivation($email, $key) == true){ ?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal" role ="form">
					<input type='hidden' name='submitted' id='submitted' >
					<h4>Your email is verified. Please enter your new password below: </h4>
					<div class="form-group ">
						New Password: <input type="password" class ="form-control" name="password" size="12" maxlength="16" placeholder="New Password" onfocus="if(this.placeholder === 'New Password') this.placeholder = '';" onblur="if(this.placeholder === '') this.placeholder = 'New Password';" >
					</div>
					<div class="form-group col-md-5">		
						Retype Password: <input type="password" class ="form-control" name="retypepass" size="12" maxlength="16" placeholder="Retype Password" onfocus="if(this.placeholder === 'Retype Password') this.placeholder = '';" onblur="if(this.placeholder === '') this.placeholder = 'Retype Password';" >
						<span class="error"><?php echo $nfsite->GetErrorMessage();?>
						</span>
					</div>
					<div class="form-group col-md-2">					
						<button class="btn btn-primary " type="submit"  value="Login" >Log in</button>
					</div>
				</form>
			<?php } 
			else{ ?>
				<p>Oops! Email Activation is failed. Please contact the system administrator. Thank you! </p>
			<?php } ?>
		</div>	
	</div>

	
<?php include('footer.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

if(isset($_POST['submitted']))
{
	if($pass = ($_POST['password'] == $_POST['retypepass'])){	
		$useract->changePassword($pass, $email);
		echo'<p> Your password has been changed. Please <a href="login.php">login</a> with your new password to enjoy our site. </p>';
	}
	else{
		$nfsite->setErrorMessage("Sorry password doesn't match. Please enter your new password again.");
	}
}
}	

?>

