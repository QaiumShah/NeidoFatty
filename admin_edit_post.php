<?php
require_once('resources/nfsite_config.php');

if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_POST['submitted']))
	{	
		$postcon->updatePost();
	}
	
	if(isset($_POST['submit']))
	{
		$cate->addCategory();
	}
	
	if(isset($_POST['delete'])){
		$cate->deleteCategories();
	}
}
$postid = $_GET['id'];

?>

<?php include('admin_header.php'); ?>


<div class="container">
	<!-- <div = "row">
		<div class="md-col-12 ">-->
			<div class="row">
				<div class="panel-group" id ="accordion">
					<div class="panel panel-default ">
						<div class="col-sm-2 ">
							<div class="panel-heading ">
								<div class="panel-title nf_sidebar">
									<a data-toggle="collapse" data-prevent="#accordion" href="#post">POST</a>				
								</div>	
							</div>
						</div>
						<div class="col-sm-10 ">	
							<div id ="post" class="panel-collapse collapse">
								<div class="panel-body">
									<?php $post = $nfsite->getOnePost($postid); ?>
									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal " role ="form" enctype="multipart/form-data">
										<input type='hidden' name='submitted' id='submitted' value='<?php echo $postid; ?>'>					
										<fieldset>
											<div class="form-group">
												<label for="titlepost" class="col-sm-2 control-label">Title </label>
												<div class="col-sm-8">
													<input type ="text" name ="titlepost" class="form-control" value="<?php echo $post['title']; ?>">
												</div>
											</div>
											<div class="dropdown">
												<hr>							
												<div class="col-centered"	>
													<span class="glyphicon glyphicon-chevron-down " role="button" data-toggle="collapse"  data-target="#collapseOne"></span>
												</div>							
												<div id="collapseOne" class="collapsing">							
													<div class="panel-body">
														<div class="form-group">
															<label for="description" class="col-sm-2 control-label">Description </label>
															<div class="col-sm-8">
																<textarea name="description" rows="5" cols="20" class="form-control"><?php echo $post['description']; ?>"</textarea>
															</div>
														</div>
														<div class="form-group">
															<label for="source" class="col-sm-2 control-label">Source URL</label>
															<div class="col-sm-4">
																<input type="text" name="source" class="form-control" value="<?php echo $post['source']; ?>">
															</div>
															<label for="category" class="col-sm-2 control-label"> Category </label>
															<div class ="col-sm-2">										
																<div class="dropdown">
																	<a class="dropdown-toggle btn btn-default" data-toggle="dropdown" href="#">
																		Choose one
																		<b class="caret"></b>
																	</a>
																	<ul class="dropdown-menu dropdown-menu-form">
																		<?php $catgory = $nfsite->getCategories();
																		foreach($catgory as $row)	
																		{ ?>
																			<li class='list-item'><input type='checkbox' name='category' value='<?php echo $row['cateId'];?>'> <?php echo $row['catename']; ?></li>
																			
														<?php 	} ?>															  
																	</ul>		
																</div>
															</div>
														</div>	
													</div>	
												</div>
											</div>			
											<ul class="nav nav-tabs" id="myTab">
												<li class="active"><a href="#image" data-toggle="tab">Image</a></li>
												<li><a href="#video" data-toggle="tab">Video</a></li>
											</ul>			
											<div class="tab-content thumbnail">
												<div class="tab-pane fade in active" id="image">
													<div class="form-group">
														<label for="imagefile" class="col-sm-2 control-label">Content :  </label>
														<div class="col-sm-8">
															<input type="file" name="imagefile" >
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-offset-2 col-sm-8">
															<button type ="submit" value="Addpost" class="btn btn-primary">Add Post</button>
														</div>
													</div>									
												</div>
												<div class="tab-pane fade" id="video">
													<div class="form-group">
														<label for="videourl" class="col-sm-2 control-label">Content :  </label>
														<div class="col-sm-8">
															<input type="text" name="videourl">
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-offset-2 col-sm-8">
															<button type ="submit" value="Addpost" class="btn btn-primary">Add Post</button>
														</div>
													</div>
												</div>
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>		
					<div class="panel panel-default ">
						<div class="col-sm-2 ">
							<div class="panel-heading">
								<h4 class="panel-title nf_sidebar  ">
									<a data-toggle="collapse" data-prevent="#accordion" href="#categ">CATEGORY</a>				
								</h4>	
							</div>
						</div>
						<div class="col-sm-10 ">
							<div id = "categ"  class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="col-sm-8">
										<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal form-top" role ="form">
											<input type='hidden' name='submit' id='submitted' value='1'>			
											<fieldset>	
												<div class="form-group">
													<label for="category" class="col-sm-3 control-label">Category Name : </label>
													<div class="col-sm-9">
														<input type = "text" name="category" class ="form-control" placeholder="Insert Category" onfocus="if(this.placeholder === 'Insert Category') this.placeholder = '';" onblur="if(this.placeholder === '') this.placeholder = 'Insert Category';" >
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-offset-3 col-sm-9">
														<button type ="submit" value="Addcategory" class="btn btn-primary">Add Category</button>
													</div>
												</div>
											</fieldset>
										</form>
									</div>	
									<div class="col-sm-4">
										<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal " role ="form" >
											<fieldset>
												<div class="form-group">													
														<ul class="list-group">
															<?php $catgory = $nfsite->getCategories();
																		foreach($catgory as $row)	
																		{ ?>
																			<li class='list-group-item'><input type='checkbox' name='category' value='<?php echo $row['cateId'];?>'> <?php echo $row['catename']; ?></li>
																			
														<?php 	} ?>															  
																		
														</ul>													
												</div>
												<div class="form-group">														
														<button type="submit"  name="delete" class="btn btn-primary">Delete Category</button>													
												</div>	
											</fieldset>	
										</form>	
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
	<!--</div>-->
</div>	


<?php include('footer.php'); ?>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script>
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			e.target // activated tab
			e.relatedTarget // previous tab
		})
		
		$('#myTab a').click(function (e) {
			e.preventDefault()
		$(this).tab('show')
		})
		
		$('.collapse').collapse()
		
		$('.dropdown-menu').on('click', function(e) {
			if($(this).hasClass('dropdown-menu-form')) {
				e.stopPropagation();
			}
		});
		
  
	</script>
	
	
    


