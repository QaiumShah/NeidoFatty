<?php
require_once('resources/nfsite_config.php');
?>

<?php include('admin_header.php');?>

<div class="container">
	<div class="row">
		<div class = "col-md-12">
			<table class="table table-striped">
				<tr >
					<th class="text-center">User Id</th>
					<th class="text-center">User Name </th>
					<th class="text-center">User Email </th>
					<th class="text-center">User Password</th>
					<th class="text-center">Account</th>
					<th class="text-center">Action</th>
				</tr>
				<?php $userdetail = $useract->getUserInfo();
					foreach($userdetail as $row){ ?>
					<tr>
						<td class="text-center"><?php echo $row['userId'];?></td>
						<td class="text-center"><?php echo $row['fullname'];?></td>
						<td><?php echo $row['email'];?></td>
						<td class="text-center">*********</td>
						<td class="text-center"><?php 
										if($row['admin'] == 1){
											echo 'ADMIN';
										}
										elseif ($row['admin'] == 0){
											echo 'USER';
										}
								?>
						</td>
						<td>	
							
								<li><a href="#edit" class="button">Edit</a></li>
								<li><a href="#delete" class="button">Delete</a></li>
							
						</td>
						
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>

<?php include('footer.php');?>


