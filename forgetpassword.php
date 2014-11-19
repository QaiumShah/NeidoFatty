<?php require_once('Resources/nfsite_config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){


	if(isset($_POST['submitted']))
	{	
		$useract->resetConfirmation();
	}
}	

include('header.php');

?>

<div class="container">
	<div class="row">		
		<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="POST" class="form-horizontal" role ="form">
			<input type='hidden' name='submitted' id='submitted' >
			<h4 class="form-signin-heading page-header">Please enter you <font color="brown"><i>email address</i></font> here and we'll send you a <font color="brown"><u>link</u></font> to change your password. </h4>
			<hr>
			<div class="form-group col-md-5"	>					
				<input type="text" class ="form-control" name="email" value="" size="12" maxlength="25" placeholder="Email address" onfocus="if(this.placeholder === 'Email address') this.placeholder = '';" onblur="if(this.placeholder === '') this.placeholder = 'Email address';">
			</div>
			<div class="col-md-7"></div>
			<br><br><br>			
			
			<div class="form-group col-md-4">					
				<button class="btn btn-primary " type="submit"  value="Login" >Submit</button> &nbsp;&nbsp;   /    <a href="register.php">Sign up</a></div>
			</div>
		 </form>
	</div>
</div>

<?php include('footer.php'); ?>