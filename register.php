<?php
require_once('resources/nfsite_config.php');



if($_SERVER['REQUEST_METHOD'] == 'POST'){


	if(isset($_POST['register']))
	{	
		$useract->Registration();
	}
}	
 
include('header.php');

?>
	
	<div class="container highlight">
		<div class="row">

			<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="POST" class="form-horizontal" role ="form">
				<input type='hidden' name='register' id='submitted' value='1'>
					<div class="page-header">
						<h2>Hello!!</h2>
						<h4>We have created this page for your fun. Share your happiness with others by registering in our website.</h4>
					</div>
					<div class="form-group">
						<label for="fname" class="col-sm-3 control-label">Full Name :</label>
						<div class="col-sm-4">
							<input type="text" class ="form-control" name="fname" placeholder="Full name" onfocus="if(this.placeholder === 'Full name') this.placeholder = '';" onblur="if(this.placeholder === '') this.placeholder = 'Full name';">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email :</label>	
						<div class="col-sm-4">
							<input type="text" class ="form-control" name="email" placeholder="Email" onfocus="if(this.placeholder === 'Email') this.placeholder = '';" onblur="if(this.placeholder === '') this.placeholder = 'Email';">
						</div>
					</div>
					<div class="form-group">
						<label for="passwd" class="col-sm-3 control-label">Password :</label>	
						<div class="col-sm-4">
							<input type="password" class ="form-control" name="passwd" placeholder="Password" onfocus="if(this.placeholder === 'Password') this.placeholder = '';" onblur="if(this.placeholder === '') this.placeholder = 'Password';">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-4">
							<button class="btn btn-primary " type="submit"  value="Register">Register</button>						
						</div>	
					</div>		
				</fieldset>			
			</form>
		</div>
	</div>

<?php include('footer.php');?>