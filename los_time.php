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
		<h4 class="text-blue h4">All-User-Los-Time</h4>
		 
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th>#</th>
					<th>UserID</th>
					<th>Name</th>
					<th>Division</th>
					<th>No.Of.Hour</th>
					<th>Rate</th>
					<th>Total Tk</th>
					<th>los Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$los_time=$pdo->prepare("SELECT * FROM los_time");
					$los_time->execute(array());
					$alllos_time = $los_time->fetchAll(PDO::FETCH_ASSOC);
					$a=1;
					foreach($alllos_time as $row):

				 ?>
				<tr>
					<td><?php echo $a;$a++; ?></td>
					<td><?php echo $row['user_id']; ?></td>
					<td><?php echo $row['user_name']; ?></td>
					<td><?php echo $row['division'];?></td>
					<td><?php echo $row['los_time'];?> min</td>
					<td><?php echo $row['rate']; ?></td>
					<td><?php echo $row['total_tk']; ?></td>
					<td><?php echo $row['lost_date']; ?></td>
					 
					 
					<td>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="singleuser_losttime.php?user_id=<?php echo $row['user_id'];  ?>"><i class="dw dw-eye"></i> View</a>
								 <?php if($position=="superadmin"): ?>
								<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
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