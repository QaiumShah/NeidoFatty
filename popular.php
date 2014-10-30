<?php require_once('resources/nfsite_config.php'); 
include('header.php');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12 jumbotron">
			
		<div class="row">	
			<div class= "col-md-8">
				<?php 					
					$posts = $postcon->getPopularPost();					

					foreach($posts as $row){ ?>
						<div class="title_post">
							<h2><?php echo $row['title']; ?></h2>
						</div>
						<hr>
						<figure> 
							<img src="data:image/jpeg;base64, <?php echo base64_encode($row['content']);?> " width="100%" height="65%"><br><br>
								<figcaption> <?php echo $nfsite->truncate($row['description'], "post.php", "post_id", $row['postId']); ?> 
								</figcaption>
						</figure>
						<span>Source: <?php echo $row['source'];?><br>Posted By: <?php echo ucfirst($row['fullname']);?> </span>
						<hr>
						<div class="">
							<?php $viewcount = $postcon-> viewCountPost($row['postId']); ?>
								Total Views: <?php echo $viewcount['viewcount']; ?>
						</div> 
						<hr>				
				
						<?php } ?>
			
				<div class="text-center">
					<ul class="pagination">
					  <li><?php $totalPages= $postcon->postNumber();
					  	for ($i=1; $i<=$totalPages; $i++) { 
            				echo "<a href='popular.php?page=".$i."'>".$i."</a> "; 
 
						} ?>
					  </li>
					</ul>
				</div>
			</div>
			<?php include('sidebar.php');?>	
		</div>
		
		</div>
	</div>
</div>



<?php include('footer.php');?>