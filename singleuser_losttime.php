<?php require_once "header.php";

$user_id = $_REQUEST['user_id'];

?>
 <div class="card-box mb-30">
	<div class="pd-20">
		<h6 class="text-blue h4">
			<b><?php echo singleAttUserAll($user_id,"user_name"); ?></b>  <small>Current-Month-All-Los-Time</small></h6>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th>#</th>
					<th>UserID</th>
					<th>Name</th>
					<th>Division</th>
					<th>Los Time</th>
					<th>Rate</th>
					<th>Total Tk</th>
					<th>Date</th>
					 
				</tr>
			</thead>
			<tbody>
				<?php 
					$start_date=1; 
					$current_date = date('d');
					for($i=$start_date; $i<=$current_date; $i++){
						$checkattdate = date('Y-m-').$i;
						if(currentMonthAllLosTime($user_id,$checkattdate)==1):
					
				?>
				<tr>
					 
					<td><?php echo $i; ?></td>
					<td><?php echo singleAttUserAll($user_id,"user_id"); ?></td>
					<td><?php echo singleAttUserAll($user_id,"user_name"); ?></td>
					<td><?php echo singleAttUserAll($user_id,"division"); ?></td>
					<td><?php echo losTimeUserAll($user_id,"los_time"); ?>min</td>
					<td><?php echo losTimeUserAll($user_id,"rate"); ?>Tk</td>
					<td><?php echo losTimeUserAll($user_id,"total_tk"); ?>Tk</td>
					 
					<td>
						<?php
						// $date = singleAttUserAll($user_id,"present_date");
						echo date('d-M-Y',strtotime($checkattdate));
						 ?>
					
					</td>
				 
				</tr> 
				<?php endif;  	
			}
			?>
			</tbody>
		</table>
	</div>
</div>

<?php require_once "footer.php"; ?>