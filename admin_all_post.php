<?php
require_once('resources/nfsite_config.php');

?>

<?php include('admin_header.php');?>

<div class="container">
	<div class="row">
		<div class = "col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Wecome to all post from different users. Have a look and modify in need.</h3>
				</div>
				<div class="panel-body">
					<table class="table">
						<?php $post = $postcon->getPosts(); 
							foreach($post as $row){ ?>
							<tr>
								<td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['content']) . '" width="290" >'; ?></td>
								<td>
									<ul>
										<li>Title: <?php echo $row['title']; ?></li>
										<li>Description: <?php echo $row['description'];?></li>
										<li>Source: <?php echo $row['source'];?></li>
										<li><i>Posted On <?php echo $row['postdate'];?></i></li>
										<li>Catergory: <?php echo $row['catename'];?></li>
										<li>Uploaded by: <?php echo $row['fullname'];?></li>
									</ul>
								</td>
								<td>
									<li><a href="admin_edit_post.php?id=<?php echo $row['postId'];?>" class="button">Edit</a></li>
									<li><a href="delete_post.php?id=<?php echo $row['postId'];?>" class="button">Delete</a></li>	
								</td>
							</tr>										
						<?php }	?>						
					</table>
				</div>
			</div>
			<div class="text-center">
					<ul class="pagination">
					  <li><?php $totalPages= $postcon->postNumber();
					  	for ($i=1; $i<=$totalPages; $i++) { 
            				echo "<a href='admin_all_post.php?page=".$i."'>".$i."</a> "; 
 
						} ?>
					  </li>
					</ul>
				</div>
		</div>
	</div>
</div>

<?php include('footer.php');?>


