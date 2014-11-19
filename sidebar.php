<?php require_once('resources/nfsite_config.php');



?>


<div class = "col-md-4">
	<?php 	$category = $cate->getCategories();
			$post = $postcon->getGroupPost();
			$latest = $postcon->getPostByDates();
			$popu = $postcon->getPopularPost();
		?>	
	 
	<form class="search_panel" action="search.php" role="search" method="GET">
		<input type="hidden" name="submitted" id="submitted">	
		<div class="input-group">
		  <input type="text" class="form-control" id= "search" name="search" placeholder="Search">
		  <div class="input-group-btn">
		  	<button type="submit" class="btn btn-primary">
		  		<span class="glyphicon glyphicon-search"></span>
		  	</button>
		  </div>
		</div>
	</form>
	<div class="panel-body">	
		<h3>Featured</h3>			    				  
		<?php foreach ($post as $row) {?>
		<figure> 
			<img src="data:image/jpeg;base64, <?php echo base64_encode($row['content']);?> " width="100%" height="90">
				<figcaption> <b><?php echo $row['title']; ?></b> </figcaption>
		</figure>
		<?php } ?>
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
		<?php foreach($popu as $pop){?>	
		  <figure> 
			<img src="data:image/jpeg;base64, <?php echo base64_encode($pop['content']);?> " width="100%" height="90">
			<figcaption> <b><?php echo $pop['title']; ?></b> </figcaption>
		  </figure></br>
		<?php } ?>  
		</div>			
	</div>
	<div class="panel-body">
		
		<h3>Latest</h3>
		<div>
		<?php foreach($latest as $lat){?>
		  <figure> 
			<img src="data:image/jpeg;base64, <?php echo base64_encode($lat['content']);?> " width="100%" height="90">
			<figcaption> <b><?php echo $lat['title']; ?></b> </figcaption>
		  </figure></br>
		<?php } ?> 
		</div>			
	</div>
</div>	