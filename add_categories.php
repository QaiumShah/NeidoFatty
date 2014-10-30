<?php 
require_once('resources/nfsite_config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){


	if(isset($_POST['submitted']))
	{	
		$cate->addCategory();
	}
}

?>
<?php include('header.php'); ?>
	
	<h3 class="page-header">Add a category</h3>
	<div class="row">
		<div class="col-sm-6">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal" role ="form">
			<input type='hidden' name='submitted' id='submitted' value='1'>			
			<fieldset>	
				<div class="form-group">
					<label for="category" class="col-xs-4 control-label">Category Name : </label>
					<div class="col-xs-8">
						<input type = "text" name="category" class ="form-control" placeholder="Insert Category" onfocus="if(this.placeholder === 'Insert Category') this.placeholder = '';" onblur="if(this.placeholder === '') this.placeholder = 'Insert Category';" >
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-offset-4 col-xs-8">
						<button type ="submit" value="Addcategory" class="btn btn-primary">Add Category</button>
					</div>
				</div>
			</fieldset>
		</form>
		</div>
	</div>
<?php include("footer.php");?> 
	
