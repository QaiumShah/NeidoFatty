<?php
require_once('resources/nfsite_config.php');

if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_POST['submitted']))
	{	
		$postcon->addPost();
	}
	/*if(isset($_POST['cate_select']))
	{
		$catselect = $_POST['cate_select'];
		$blogfunction->Set_Category($catselect);
	}*/
}
$userid = $_GET['id'];

?>

<?php include('admin_header.php'); ?>


<div class="container">
	<div = "row">
		<div class="col-md-12 inner-wrap">
							
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal form-top inner-wrap" role ="form" enctype="multipart/form-data">
					<input type='hidden' name='submitted' id='submitted' value='<?php echo $userid; ?>'>					
					<fieldset>
						<div class="form-group">
							<label for="titlepost" class="col-sm-2 control-label">Title </label>
							<div class="col-sm-8">
								<input type ="text" name ="titlepost" class="form-control">
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
											<textarea name="description" rows="5" cols="20" class="form-control"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="source" class="col-sm-2 control-label">Source URL</label>
										<div class="col-sm-4">
											<input type="text" name="source" class="form-control">
										</div>
										<label for="category" class="col-sm-2 control-label"> Category </label>
										<div class ="col-sm-2">										
											<div class="dropdown">
												<a class="dropdown-toggle btn btn-default" data-toggle="dropdown" href="#">
													Choose one
												<b class="caret"></b>
												</a>
												<ul class="dropdown-menu dropdown-menu-form">
													<?php $catgory = $cate->getCategories();
													foreach($catgory as $row)	
													{ ?>
														<li class='list-item'><input type='checkbox' name='category' value='<?php echo $row['cateId'];?>'> <?php echo $row['catename']; ?></li>
															
													<?php } ?>															  
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
										<img id="preview" src="#" width="290">
										<input type="file" name="imagefile" id="input">
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
									<label for="imagefile" class="col-sm-2 control-label">Content :  </label>
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

		(function() {

		    var URL = window.URL || window.webkitURL;

		    var input = document.querySelector('#input');
		    var preview = document.querySelector('#preview');
		    
		    // When the file input changes, create a object URL around the file.
		    input.addEventListener('change', function () {
		        preview.src = URL.createObjectURL(this.files[0]);
		    });
		    
		    // When the image loads, release object URL
		    preview.addEventListener('load', function () {
		        URL.revokeObjectURL(this.src);
		        
		        
		    });
		})();
	</script>
	
	
    


