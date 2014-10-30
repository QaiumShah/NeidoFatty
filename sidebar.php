<?php require_once('resources/nfsite_config.php');?>


<div class = "col-md-4">
	<?php 	$category = $cate->getCategories();
			$post = $postcon->getGroupPost(); 
		?>	
	 <div class="panel-body">	
		<h3>Featured</h3>			    				  
		<figure> 
			<img src="data:image/jpeg;base64, <?php echo base64_encode($post['content']);?> " width="100%" height="80">
				<figcaption> <b><?php echo $post['title']; ?></b> </figcaption>
		</figure>
	</div>
	<div class="search_panel">	
		<div class="input-group">
		  <input type="text" class="form-control" placeholder="Search">
		  <span class="input-group-addon"><a href="#search"><span class="glyphicon glyphicon-search"></span></a></span>
		</div>
	</div>	
	<div class="panel-body">
		<h3>Categories</h3>
		<div class="category_list">
		  <ul>
			<?php foreach($category as $row){
				echo'<li><a href="show_categories.php?id='. $row['cateId'].'">'. $row['catename'].'</a></li>';
			}?>	
		  </ul>
		</div>
	</div>
	<div class="panel-body">
		<h3>Popular</h3>
		<div>
		</div>			
	</div>
	<div class="panel-body">
		<h3>Latest</h3>
		<div>
		</div>			
	</div>
</div>	