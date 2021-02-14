<?php require_once "header.php";

if(isset($_COOKIE['rememberUser'])){
  	$ad_id = $_COOKIE['rememberUser'];
  }
  else{
  	$ad_id = $_SESSION['adminlogin'][0]['ad_id'];
  }
$position = admin_details($ad_id,'position');

?>


 <style type="text/css">
 	.msgError{
 		display: none;
		background: red;
		padding: 10px;
		border-radius: 5px;
		color: #fff;
		margin-bottom: 10px;
 	}
 	.successMsg {
		display: none;
		background: green;
		padding: 10px;
		border-radius: 5px;
		color: #fff;
		margin-bottom: 10px;
	}
 </style>
 
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">All-User-Cash-Advance-List</h4>
		 				 
		<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#cash_advance_add" type="button">
			Cash-advance-add 
		</a>

		<div class="modal fade" id="cash_advance_add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myLargeModalLabel">Add-Cash-Advance</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						 <form method="POST" id="cashAdvanceForm">
						 	<!-- validation-alert -->
						 	<div class="msgError"></div>

							 <div class="successMsg"></div>

						 	<div class="form-group row">
								<label class="col-sm-4 col-form-label">User ID*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="user_id" id="user_id">
								</div>
								
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Advance Amount*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="cash_advance_amount" id="cash_advance_amount">
								</div>
							</div>
							<input type="submit" name="cash_advance_submit" class="btn btn-success" value="Cash-Advance-Submit">
						 </form>
					</div>
					 
				</div>
			</div>
		</div>
		 
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th>#</th>
					<th>UserID</th>
					<th>Name</th>
					<th>Division</th>
					<th>Amount</th>
					<th>Cash-Advance Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$cash_advance=$pdo->prepare("SELECT * FROM cash_advance");
					$cash_advance->execute(array());
					$cash_advance_result = $cash_advance->fetchAll(PDO::FETCH_ASSOC);
					$a=1;
					foreach($cash_advance_result as $row):

				 ?>
				<tr>
					<td><?php echo $a;$a++; ?></td>
					<td><?php echo $row['user_id']; ?></td>
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['division'];?></td>
					<td><?php echo $row['amount'];?> Tk</td>
					<td><?php echo $row['cash_date']; ?></td>
					<td>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a href="#" class="dropdown-item" data-toggle="modal" data-target="#single_cash_advance_user<?php echo $row['c_id']; ?>" type="button"><i class="dw dw-eye"></i>View</a>
								<?php if($position=="superadmin"): ?>
								<a href="#" class="dropdown-item update" data-toggle="modal" data-target="#cash_advance_user_edit" type="button"
								  data-cid="<?php echo $row['c_id'] ?>"
								  data-userid="<?php echo $row['user_id']; ?>"
								  data-username="<?php echo $row['username']; ?>"
								  data-division="<?php echo $row['division'];?>"
								  data-amount="<?php echo $row['amount'];?>"
								  data-cashdate="<?php echo $row['cash_date']; ?>" >
								  <i class="dw dw-edit2"></i>Edit</a>

								<a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#cash_advance_user_delete" type="button"
								data-cid="<?php echo $row['c_id'] ?>"
								>
								<i class="dw dw-delete-3"></i> Delete</a>
								<?php endif; ?>
								
							</div>
						</div>
						<!-- Single User-Advance-Cash -->
						<div class="modal fade" id="single_cash_advance_user<?php echo $row['c_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myLargeModalLabel"><?php echo $row['username']; ?>-Advance-Amount-Details</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											</div>
											<div class="modal-body">
												<table class="table">
													<tr>
														<td>User-Id</td>
														<td><?php echo $row['user_id']; ?></td>
													</tr>
													<tr>
														<td>User-Name</td>
														<td><?php echo $row['username']; ?></td>
													</tr>
													<tr>
														<td>User-Email</td>
														<td><?php
															$user_id = $row['user_id'];
															echo user_details($user_id,"email");
														  ?>
														  	
														  </td>
													</tr>
													<tr>
														<td>Contact-Number</td>
														<td><?php
															$user_id = $row['user_id'];
															echo user_details($user_id,"contact");
														  ?>
														  	
														  </td>
													</tr>
													<tr>
														<td>Division</td>
														<td><?php echo $row['division'];?></td>
													</tr>
													<tr>
														<td>Amount</td>
														<td><?php echo $row['amount'];?> Tk</td>
													</tr>
													<tr>
														<td>Date</td>
														<td><?php
														 echo date('d F Y',strtotime($row['cash_date'])); ; 
														 ?></td>
													</tr>
												</table>
											</div>
											 
										</div>
									</div>
						</div>


						<!-- single User Advance Edit -->
						<div class="modal fade" id="cash_advance_user_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myLargeModalLabel"> <?php echo $row['username']; ?> Edit Advance-Cash</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<form method="POST" action="" id="cash_advance_edit">

											<div class="msgError"></div>

							 				<div class="successMsg"></div>

											<div class="form-group row">
												<div class="col-sm-8">
													<input type="hidden" class="form-control" name="c_id" id="cid" value="">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">User ID*</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="user_id" id="userid" value="" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">User Name*</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="user_name" id="username" value="" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Division*</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="division" id="division" value="" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Amount*</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="amount" id="amount" value="">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Date*</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="date" id="date" value="" readonly>
												</div>
											</div>
											<input type="submit" class="btn btn-success" name="advance_cash_update" value="Advance-Cash-Update">
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- single User Advance Cash Delete -->
						<div class="modal fade" id="cash_advance_user_delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myLargeModalLabel"><?php echo $row['username']; ?>-Advance-Amount-Details</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											</div>
											<form>
												 <div class="successMsg"></div>
												<div class="modal-body">
													<div class="form-group row">
														<div class="col-sm-8">
															<input type="hidden" class="form-control" name="c_id" id="cash_id" value="">
															<p style="font-size: 18px;">Are you sure you want to delete these Records?</p>
															<p style="font-size: 16px;" class="text-danger"> This action cannot be undone. </p>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
													<button type="button" class="btn btn-danger" id="delete">Delete</button>
												</div>
											</form>
										</div>
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
<script type="text/javascript">
 	// user Advance cash Added
 	$('#cashAdvanceForm').on('submit',function(event){
 		event.preventDefault();

 		var user_id = $('#user_id').val();
 		var cash_advance_amount = $("#cash_advance_amount").val();
 		 
 		if(user_id.length==0){
 			$('.msgError').show().text("User Id field is required");
 		}
 		else if(cash_advance_amount.length==0){
 			$('.msgError').show().text("Amount field is required");
 		}

 		else{
 			$('.msgError').hide();
 			$.ajax({
 				type:"POST",
 				url:"ajaxRequest.php",
 				dataType:'json',
 				data:{
 					user_id:user_id,
 					cash_advance_amount:cash_advance_amount
 				},
 				success:function(response){
 					if(response.success !=""){
 						$(".successMsg").show().text(response.success);
 						$(".msgError").hide();
 					}
 					if(response.error !=""){
 						$(".msgError").show().text(response.error);
 						$(".successMsg").hide();
 					}
 				}

 			});
 		}
 	});

 	// Single User Update Advance Cash

 	$(document).on('click','.update', function(e){
 		var c_id = $(this).attr("data-cid");
 		var user_id = $(this).attr("data-userid");
 		var username=$(this).attr("data-username");
 		var division = $(this).attr("data-division");
 		var amount = $(this).attr("data-amount");
 		var cashdate = $(this).attr("data-cashdate");

 		 
 		$('#cid').val(c_id);
 		$('#userid').val(user_id);
 		$('#username').val(username);
 		$('#division').val(division);
 		$('#amount').val(amount);
 		$('#date').val(cashdate);

 	});

 	$("#cash_advance_edit").on('submit',function(event){
 		event.preventDefault();
 		
 		var c_id = $('#cid').val();
 	 
 		var amount = $('#amount').val();
 		 
 		if(amount.length==0){
 			$(".msgError").show().text("Amount is required");
 			$(".successMsg").hide();
 		}
 		else{
 			$(".msgError").hide();
 			$.ajax({
 				type:"POST",
 				url:"ajaxRequest.php",
 				data:{
 					c_id:c_id,
 					amount:amount
 				},
 				success:function(data){
 					$(".successMsg").show().text(data);
 					 
 					
 				}
 			});
 		}
 	});

 	// Single User delete advance cash

$(document).on('click','.delete', function(e){
	var c_id = $(this).attr("data-cid");

	 $("#cash_id").val(c_id);

});

$("#delete").on('click',function(event){
	 	event.preventDefault();
	 	var cash_id = $("#cash_id").val();
	 	 
	 	$.ajax({
	 		method:"POST",
	 		url:"ajaxRequest.php",
	 		cache: false,
	 		data:{
	 			cash_id:cash_id
	 		},
	 		success:function(data){
	 			$(".successMsg").show().text(data);
	 		}
	 	})
});

</script>