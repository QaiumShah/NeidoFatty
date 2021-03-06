<?php require_once('Resources/nfsite_config.php');	


if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['submitted']))
	{	
		if(empty($_POST['email']) || empty($_POST['password'])){
			$nfsite->setErrorMessage('Fields are empty');	
		}		
		else{

			$useract->UserLogin();					
		}		
	}
}	

include('header.php'); ?>

<div class="container">
	<div class="row">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-signin" role ="form">
			<input type='hidden' name='submitted' id='submitted' >
				<h2 class="form-signin-heading page-header">Login with your email address</h2>
	  			<div class="form-group">	
			  		<input type="text" class ="form-control" name="email" value="" size="12" maxlength="25" placeholder="Email address" onfocus="if(this.placeholder === 'Email address') this.placeholder = '';" onblur="if(this.placeholder === '') this.placeholder = 'Email address';">
				</div>
				<div class="form-group">		
					<input type="password" class ="form-control" name="password" size="12" maxlength="16" placeholder="Password" onfocus="if(this.placeholder === 'Password') this.placeholder = '';" onblur="if(this.placeholder === '') this.placeholder = 'Password';" >
					<span class="error"><?php echo $nfsite->GetErrorMessage();?>
					</span>
				</div>
				<div class="form-group">
					<input type="checkbox" name="remember"> Remember Me  / <a href="forgetpassword.php">Forgot password</a>	
				</div>
				<div class="form-group">					
					<button class="btn btn-primary " type="submit"  value="Login" >Log in</button>

				</div>
			</fieldset>	
		</form>
	</div>	
</div>

<?php include('footer.php');?>