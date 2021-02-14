 
<?php require_once 'header.php'; 

$user_id = $_REQUEST['user_id'];

?>
 <div class="card-box mb-30">
	<div class="pd-20">
		<h6 class="text-blue h4">
			<b><?php echo singleAttUserAll($user_id,"user_name"); ?></b>  <small>All-Attendance</small></h6>
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
					$start_date=1; 
					$current_date = date('d');
					for($i=$start_date; $i<=$current_date; $i++){
						$checkattdate = date('Y-m-').$i;
						if(singleCheckAtt($user_id,$checkattdate)==1):
					
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo singleAttUserAll($user_id,"user_id"); ?></td>
					<td><?php echo singleAttUserAll($user_id,"user_name"); ?></td>
					<td><?php echo singleAttUserAll($user_id,"division"); ?></td>
					<td><?php echo singleAttUserAll($user_id,"in_time"); ?></td>
					<td><?php echo singleAttUserAll($user_id,"out_time"); ?></td>
					<td> 
						<i class="icon-copy fa fa-check" aria-hidden="true"></i>
						 
					</td>
					<td>
						<?php
						// $date = singleAttUserAll($user_id,"present_date");
						echo date('d-M-y',strtotime($checkattdate));
						 ?>
					
					</td>
					 
					<td>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href=""><i class="dw dw-eye"></i> View</a>
								 
								<a class="dropdown-item" href=""><i class="dw dw-delete-3"></i> Delete</a>
							</div>
						</div>
					</td>
				</tr>
				<?php else: ?>  
					<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo singleAttUserAll($user_id,"user_id"); ?></td>
					<td><?php echo singleAttUserAll($user_id,"user_name"); ?></td>
					<td><?php echo singleAttUserAll($user_id,"division"); ?></td>
					<td><ul>
						<li><i class="icon-copy fa fa-close" aria-hidden="true"></i></li>
					</ul></td>
					<td><ul>
						<li><i class="icon-copy fa fa-close" aria-hidden="true"></i></li>
					</ul></td>
					<td><ul>
						<li><i class="icon-copy fa fa-close" aria-hidden="true"></i></li>
					</ul></td>
					<td>
						<?php
						// $date = singleAttUserAll($user_id,"present_date");
						// echo $date;
						echo date('d-M-y',strtotime($checkattdate));
						 ?>
					
					</td>
					 
					<td>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href=""><i class="dw dw-eye"></i> View</a>
								 
								<a class="dropdown-item" href=""><i class="dw dw-delete-3"></i> Delete</a>
							</div>
						</div>
					</td>
				</tr>
				<?php endif;  	
			}
			?>
			</tbody>
		</table>
	</div>
</div>
<?php require_once 'footer.php'; ?>