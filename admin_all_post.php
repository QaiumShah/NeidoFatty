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
						<thead>
							<tr>
								<th>Title</th>
								<th>Author</th>
								<th>Categories</th>
								<th>Comments</th>
								<th>Date</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Title</th>
								<th>Author</th>
								<th>Categories</th>
								<th>Comments</th>
								<th>Date</th>
							</tr>
						</tfoot>
						<tbody>
							<?php $post = $postcon->getPosts();
							$i = 1;
							foreach($post as $row){ ?>
							<tr>
								<td><strong><a href="admin_edit_post.php?id=<?php echo $row['postId'];?>"><?php echo $row['title']; ?></a></strong>									
								    <div class="">
								    	<span><a href="admin_edit_post.php?id=<?php echo $row['postId'];?>">Edit</a></span>

								    </div>								    
								    <div class="accordion" id="accordion">
								        <div class="accordion-group">
								          <div class="accordion-heading">
								            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $i;?>">Quick Edit</a>
								          </div><!--.accordion-heading-->
								          <div id="<?php echo $i;?>" class="accordion-body collapse">
								          <div class="accordion-inner">
								                <fieldset>
								                	<div>
								                		<h5>Quick Edit</h5>
								                		<label>
								                			<span>Title</span>
								                			<span><input type="text" name="postTitle" value="<?php echo $row['title'];?>"></span>
								                		</label>
								                		<label><span><input type="checkbox" name="featured">Featured</span></label>								           
								                	</div>
								                </fieldset>
								                <fieldset>
													<div class="form-group">
														<h5><i>Categories</i></h5>											
															<ul class="list-group">
																<li class='list-group-item'><input type='checkbox' name='category' value='<?php echo $row['cateId'];?>'> <?php echo $row['catename']; ?></li>
															</ul>													
													</div>													
												</fieldset>
												<fieldset>
													<p>
														<a href="#cancel">Cancel</a>
														<a href="#update">Update</a>
													</p>
												</fieldset>
								          </div><!--.accordion-inner-->
								        </div><!--.accordion-body-->
								      </div><!--.accordion-group-->
								    </div><!--.accordion-->
								    <div class="">
								    	<span ><a href="delete_post.php?id=<?php echo $row['postId'];?>"><font style="color: #ff0000">Delete</font></a></span>
								    </div>
								    <div class="">
								    	<span><a href="postDetail.php?post_id=<?php echo $row['postId'];?>">Preview</a></span>
								    </div>
								</td>
								<td><?php echo $row['fullname'];?></td>
								<td><?php echo $row['catename'];?></td>
								<td>--</td>
								<td><?php echo $row['postdate'];?></td>
							</tr>																	
							<?php
								$i++;
								 }	?>
						</tbody>												
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






