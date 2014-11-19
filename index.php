<?php require_once('resources/nfsite_config.php');
if($useract->check_Login() == true){
		$nfsite->RedirectToURL('admin_index.php?page=1');
	}
include('header.php');?>

<div class="container">
	<div class="row">
		<div class="col-md-12 jumbotron">
			
		<div class="row">	
			<div class= "col-md-8">
				<div class="comp_post">
				<?php $post = $postcon->getPosts();
					foreach($post as $row){ ?>
							<div class="title_post">
								<a href="postDetail.php?post_id=<?php echo $row['postId'];?>"><h2><?php echo $row['title']; ?></h2></a> 
							</div>
							<hr>
							<figure> 
								<a href="postDetail.php?post_id=<?php echo $row['postId'];?>">
									<img src="data:image/jpeg;base64, <?php echo base64_encode($row['content']);?> " width="100%" height="75%">
								</a><br><br>
								<figcaption> <?php echo $nfsite->truncate($row['description'], "postDetail.php", "post_id", $row['postId']); ?> </figcaption>
							</figure>
							<span>Source: <?php echo $row['source'];?><br>Posted By: <?php echo ucfirst($row['fullname']);?> </span>
							<hr>
							<div class="">
								<?php $viewcount = $postcon-> viewCountPost($row['postId']); ?>
								Total Views: <?php echo $viewcount['viewcount']; ?>
							</div> 
							<hr>	
				
						<?php } ?>
					</div>
				<div class="text-center">
					<ul class="pagination">
					  <li><?php $totalPages= $postcon->postNumber();
					  	for ($i=1; $i<=$totalPages; $i++) { 
            				echo "<a href='index.php?page=".$i."'>".$i."</a> "; 
 
						} ?>
					  </li>
					</ul>
				</div>
			</div>
			<?php include('sidebar.php'); ?>
		</div>
		
		</div>
	</div>
</div>


<?php include('footer.php');?>