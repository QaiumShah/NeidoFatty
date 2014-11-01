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
								<td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['content']) . '" width="290" height="250" >'; ?></td>
								<td>
									<ul>
										<li>Title: <?php echo $row['title']; ?></li>
										<li>Description: <?php echo $row['description'];?></li>
										<li>Source: <?php echo $row['source'];?></li>
										<li><i>Posted On <?php echo $row['postdate'];?></i></li>
										<li>Catergory: <?php echo $row['catename'];?></li>
										<li>Uploaded by: <?php echo $row['fullname'];?></li>
									</ul>								
										<ul>
											<li><a href="admin_edit_post.php?id=<?php echo $row['postId'];?>" class="button">Edit</a></li>
											<li><a href="delete_post.php?id=<?php echo $row['postId'];?>" class="button">Delete</a></li>
											<li>
												<div class="panel-group" role="tablist">
													<div class="panel panel-default">
														<div id="collapseListGroupHeading1" class="panel-heading" role="tab">
															<h4 class="panel-title">
																<a class="collapsed" aria-controls="collapseListGroup1" aria-expanded="false" href="#collapseListGroup1" data-toggle="collapse"> Quick Edit </a>
															</h4>
														</div>
													</div>
													<div id="collapseListGroup1" class="panel-collapse collapse in" aria-labelledby="collapseListGroupHeading1" role="tabpanel" aria-expanded="true" style="">
														<ul class="list-group">
															<li class="list-group-item">Bootply</li>
															<li class="list-group-item">One itmus ac facilin</li>
															<li class="list-group-item">Second eros</li>
														</ul>
													</div>	
												</div>		
											</li>
										</ul>		 	
									
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






