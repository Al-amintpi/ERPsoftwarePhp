 
<?php require_once 'header.php'; 

if(isset($_COOKIE['rememberUser'])){
  	$ad_id = $_COOKIE['rememberUser'];
  }
  else{
  	$ad_id = $_SESSION['adminlogin'][0]['ad_id'];
  }
$position = admin_details($ad_id,'position');

?>

<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">All User</h4>
						 
					</div>
					<?php if(isset($_GET["delsuccess"])): ?>
						<div class="alert alert-danger">
							Delete successfully
						</div>
					 <?php endif; ?>

					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th>#</th>
									<th class="table-plus datatable-nosort">User Name</th>
									<th>User ID</th>
									<th>Contact</th>
									<th>Division</th>
									<th>Birthday</th>
									<th>Join Date</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$u_list = $pdo->prepare("SELECT * FROM user_list");
									$u_list->execute();
				  	   				$user_list = $u_list->fetchAll(PDO::FETCH_ASSOC);
				  	   				$a=1;
				  	   				foreach($user_list as $row):

								 ?>
								<tr>
									<td><?php echo $a;$a++; ?></td>
									<td class="table-plus"><?php echo $row['username']; ?></td>
									<td><?php echo $row['user_id']; ?></td>
									<td><?php echo $row['contact']; ?></td>
									<td><?php echo $row['division']; ?> </td>
									<td><?php echo date('d F Y',strtotime($row['birthday'])); ?></td>
									<td><?php echo date('d F Y',strtotime($row['join_date'])); ?></td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="single_user.php?id=<?php
												echo $row['user_id']; 
											 ?>"><i class="dw dw-eye"></i> View</a>
											 <?php if($position=="superadmin"): ?>
												<a class="dropdown-item" href="edit_user.php?id=<?php
												echo $row['user_id']; 
											 ?>"><i class="dw dw-edit2"></i> Edit</a>
												<a class="dropdown-item" href="delete_single_user.php?id=<?php
												echo $row['user_id']; 
											 ?>"><i class="dw dw-delete-3"></i> Delete</a>
											<?php endif; ?>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->
<?php require_once 'footer.php'; ?>