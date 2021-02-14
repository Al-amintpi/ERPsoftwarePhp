<?php require_once "header.php";

if(isset($_COOKIE['rememberUser'])){
  	$ad_id = $_COOKIE['rememberUser'];
  }
  else{
  	$ad_id = $_SESSION['adminlogin'][0]['ad_id'];
  }
$position = admin_details($ad_id,'position');

?>

 
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">All-Attendance</h4>
		 
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th>#</th>
					<th>UserID</th>
					<th>Name</th>
					<th>Division</th>
					<th>In Time</th>
					<th>Out Time</th>
					<th>Status</th>
					<th>Attent Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$att_list=$pdo->prepare("SELECT * FROM attendance_table");
					$att_list->execute(array());
					$allatt_list = $att_list->fetchAll(PDO::FETCH_ASSOC);
					$a=1;
					foreach($allatt_list as $row):

				 ?>
				<tr>
					<td><?php echo $a;$a++; ?></td>
					<td><?php echo $row['user_id']; ?></td>
					<td><?php echo $row['user_name']; ?></td>
					<td><?php echo $row['division'];?></td>
					<td><?php echo $row['in_time']; ?></td>
					<td><?php echo $row['out_time']; ?></td>
					<td>
						<?php if($row['status']==1): ?>
						<div class="alert alert-success">
							On Time
						</div>

						 <?php else: ?> 
						 	<div class="alert alert-danger">
								Late Today
							</div>
						 <?php endif; ?>
						</td>
					<td><?php

					 	echo date('Y-m-d',strtotime($row['present_date'])); ?></td>
					<td>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="singleAttView.php?user_id=<?php echo $row['user_id']; ?>"><i class="dw dw-eye"></i> View</a>
								 <?php if($position=="superadmin"): ?>
								<a class="dropdown-item" href="singleAttView.php?user_id=<?php echo $row['user_id']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
							<?php endif; ?>
							</div>
						</div>
					</td>
				</tr>
				 <?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
				 

 <?php require_once "footer.php"; ?>