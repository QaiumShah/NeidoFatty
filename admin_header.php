<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NeidoFatty</title>
	<link rel="shortcut icon" href="images/icon.png" type="image/x-icon" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrap">
	<div class="">
      <nav class="navbar navbar-static-top navbar-inverse " role="navigation">
        <div class="container">
          <div class="navbar-header header-fix">
            <a href="admin_index.php?page=1" class="navbar-brand"><img src="images/icon.png" height="40" width="40"> NeidoFatty</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
				<li><a href="admin_index.php?page=POPULAR" target="_self">POPULAR</a></li>
				<li><a href="admin_index.php?page=LATEST" target="_self">LATEST</a></li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<?php if($useract->check_Login() == false){
						die('<li><a href="login.php">Please Login</a></li>');
						}
					else{?>	
					<li>
						<?php if($_SESSION['admin']=='1')
												{ ?>
													<a href="add_admin_post.php?id=<?php echo $_SESSION['userid'];?>"><span class="glyphicon glyphicon-cloud-upload"></span> ADD POST</a>
								<?php 	}
										elseif ($_SESSION['admin']=='0')
												{ ?>
													<a href="add_user_post.php?id=<?php echo $_SESSION['userid'];?>"><span class="glyphicon glyphicon-cloud-upload"></span> ADD POST</a>
								<?php	} ?>
					</li>				
					<li class="dropdown"> 
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?php echo "Welcome ".ucfirst($useract->getUserName());?>
							<b class = "caret"></b>
						</a>
						<ul class="dropdown-menu">
							<?php if($_SESSION['admin']=='1')
												{ ?>
													<li><a href="add_admin_post.php?id=<?php echo $_SESSION['userid'];?>">ADD POST</a></li>
								<?php 	}
										elseif ($_SESSION['admin']=='0')
												{ ?>
													<li><a href="add_user_post.php?id=<?php echo $_SESSION['userid'];?>">ADD POST</a></li>
								<?php	} ?>
							<li><a href="admin_all_post.php?id=<?php echo $_SESSION['userid'];?>">MANAGE POST</a></li>
							<li><a href="#">EDIT PROFILE</a></li>
							<li><a href="admin_all_user.php">VIEW USERS</a></li>
							
							<li class="divider"></li>
							<li><a href="logout.php">SIGN OUT</a></li>
						</ul>
					</li> 
					<?php } ?>
			   </ul> 
		   </div>
        </div>
      </nav>
	  
	  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>