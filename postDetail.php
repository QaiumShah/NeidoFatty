<?php require_once('resources/nfsite_config.php'); 

$pid = $_GET['post_id'];

include('header.php');

?>
<div class="container">
	<div class="row">
		<div class="col-md-12 jumbotron">
			
		<div class="row">	
			<div class= "col-md-8">
				<?php $post = $postcon->countPost($pid); ?>
				  <div class="title_post">
							<h2> <?php echo $post['title']; ?></h2>
						</div>
						<hr>
						<figure> 
							<img src="data:image/jpeg;base64, <?php echo base64_encode($post['content']);?> " width="100%" height="65%"><br><br>
								<figcaption> <?php echo $post['description']; ?> 
								</figcaption>
						</figure>
						<span>Source: <?php echo $post['source'];?><br>Posted By: <?php echo ucfirst($post['fullname']);?> </span>
						<hr>
						<div class="">
							<?php $viewcount = $postcon-> viewCountPost($pid); ?>
								Total Views: <?php echo $viewcount['viewcount']; ?>
						</div> 
						<hr>			
			</div>
			<?php include('sidebar.php'); ?>
		</div>
		
		</div>
	</div>
</div>


<?php include('footer.php');?>