<?php require_once 'header.php'; ?>
<style type="text/css">
		.payroll i {
			width: 30px;
			height: 30px;
			background: red;
			color: #fff;
			text-align: center;
			line-height: 29px;
			font-size: 20px;
			border-radius: 50%;
		}
		.successMsg{
			display: none;
			background: green;
			padding: 10px;
			font-size: 18px;
			color: #fff;
			border-radius: 5px;
			margin: 20px 0;
		}

</style>

	<div class="card-box mb-30">
		<div class="pd-20">
			<h4 class="text-blue h4">All Employee Payroll List</h4>
		</div>
		<div class="pb-20">
			<table class="table hover multiple-select-row data-table-export nowrap">
				<thead>
					<tr>
						<th>#</th>
						<th>Employee Id</th>
						<th>Advance Cash</th>
						<th>Over Time Total Tk</th>
						<th>Los Time Total Tk</th>
						<th>Main Salary</th>
						<th>Net Pay</th>
						<th>Action</th>
						 
					</tr>
				</thead>
				<tbody>
					<?php
					 $stm = $pdo->prepare("SELECT * FROM payroll_table");
					 $stm->execute(array());
					 $result = $stm->fetchAll(PDO::FETCH_ASSOC);
					 $a=1;
					 foreach($result as $row):

					  ?>

					<tr>
						<td><?php echo $a;$a++; ?></td>
						<td class="table-plus"><?php echo $row['user_id'];?></td>

						<?php if ($row['advance_cash'] !=null):?>

						<td><?php echo $row['advance_cash']; ?>Tk</td>
						<?php else: ?>
						<td><div class="payroll"><i class="icon-copy fa fa-close" aria-hidden="true"></i></div></td>	
						<?php endif; ?>

						<?php if ($row['over_time'] !=null):?>

						<td><?php echo $row['over_time'];?>Tk</td>
						<?php else: ?>
						<td><div class="payroll"><i class="icon-copy fa fa-close" aria-hidden="true"></i></div></td>	
						<?php endif; ?>

						<?php if ($row['los_time'] !=null):?>

						<td><?php echo $row['los_time'];?>Tk</td>
						<?php else: ?>
						<td><div class="payroll"><i class="icon-copy fa fa-close" aria-hidden="true"></i></div></td>	
						<?php endif; ?>

						 
						<td><?php echo $row['main_salary']; ?>Tk</td>
						<td><?php echo $row['net_pay']; ?>Tk</td>
						 
						<td>
							<div class="dropdown">
								<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
									<i class="dw dw-more"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list" style="">
									<a href="#" class="dropdown-item" data-toggle="modal" data-target="#single_payroll<?php echo $row['payroll_id']; ?>" type="button"><i class="dw dw-eye"></i>View</a>

									<a href="#" class="dropdown-item payrolledit" data-toggle="modal" data-target="#payroll_edit" type="button"
									  data-payrollid="<?php echo $row['payroll_id'] ?>"
									  data-userid="<?php echo $row['user_id']; ?>"
									  data-username="<?php echo $row['user_name']; ?>"
									  data-contact="<?php echo $row['contact']; ?>"
									  data-division="<?php echo $row['division'];?>"
									  data-advancecash="<?php echo $row['advance_cash'];?>"
									  data-overtime="<?php echo $row['over_time'];?>"
									  data-lostime="<?php echo $row['los_time'];?>"
									  data-mainsalary="<?php echo $row['main_salary'];?>"
									  data-netpay="<?php echo $row['net_pay'];?>"
									  data-payrolldate="<?php echo $row['payroll_date']; ?>" >
								  <i class="dw dw-edit2"></i>Edit</a>

									<a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#payroll_delete" type="button"
								data-payrollid="<?php echo $row['payroll_id']; ?>"
								>
								<i class="dw dw-delete-3"></i> Delete</a>
								</div>
							</div>
		<!-- Single Payroll -->
		<div class="modal fade" id="single_payroll<?php echo $row['payroll_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myLargeModalLabel"><?php echo $row['user_name']; ?>-Payroll-Details</h4>
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
										<td><?php echo $row['user_name']; ?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td><?php
											$user_id = $row['user_id'];
											echo user_details($user_id,"email");
										  ?>
										  	
										  </td>
									</tr>
									<tr>
										<td>Contact-Number</td>
										<td><?php
											echo $row['contact'];
										  ?>
										  	
										  </td>
									</tr>
									<tr>
										<td>Division</td>
										<td><?php echo $row['division'];?></td>
									</tr>
									<tr>
										<td>Advance Cash</td>
										<?php if ($row['advance_cash'] !=null):?>

										<td><?php echo $row['advance_cash']; ?>Tk</td>
										<?php else: ?>
										<td><div class="payroll"><i class="icon-copy fa fa-close" aria-hidden="true"></i></div></td>	
										<?php endif; ?>
									</tr>
									<tr>
										<td>Over Time Tk</td>
										<?php if ($row['over_time'] !=null):?>

										<td><?php echo $row['over_time'];?>Tk</td>
										<?php else: ?>
										<td><div class="payroll"><i class="icon-copy fa fa-close" aria-hidden="true"></i></div></td>	
										<?php endif; ?>
									</tr>
									<tr>
										<td>Los Time Tk</td>
										<?php if ($row['los_time'] !=null):?>

										<td><?php echo $row['los_time'];?>Tk</td>
										<?php else: ?>
										<td><div class="payroll"><i class="icon-copy fa fa-close" aria-hidden="true"></i></div></td>	
										<?php endif; ?>
									</tr>
									<tr>
										<td>Net Pay</td>
										<td><?php echo $row['net_pay'];?> Tk</td>
									</tr>
									<tr>
										<td>Payroll Submit</td>
										<td><?php
										 echo date('d F Y',strtotime($row['payroll_date'])); ; 
										 ?></td>
									</tr>
								</table>
							</div>
							 
						</div>
					</div>
		</div>

		<!-- Single Payroll edit -->
		<div class="modal fade" id="payroll_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myLargeModalLabel">  Edit Single Payroll</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<form action="" id="payroll_edit">
			 				<div class="successMsg">
			 					
			 				</div>

							<div class="form-group row">
								<div class="col-sm-8">
									<input type="hidden" class="form-control" name="payroll_id" id="payrollid" value="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">User ID*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="userid" id="userid" value="" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">User Name*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="username" id="username" value="" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Contact*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="contact" id="contact" value="" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Division*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="division" id="division" value="" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Advance Cash*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="advancecash" id="advancecash" value="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Over Time*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="overtime" id="overtime" value="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Los Time*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="lostime" id="lostime" value="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Main Salary*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="mainsalary" id="mainsalary" value="" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Net Pay*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="netpay" id="netpay" value=""  readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Payroll Date*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="paydate" id="paydate" value="" readonly>
								</div>
							</div>
							<input type="submit" class="btn btn-success" name="payroll_update" value="Payroll Update">
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- single User Advance Cash Delete -->
		<div class="modal fade" id="payroll_delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myLargeModalLabel"><?php echo $row['user_name']; ?>-Payroll-delete</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<form>
						 <div class="successMsg"></div>
						<div class="modal-body">
							<div class="form-group row">
								<div class="col-sm-8">
									<input type="hidden" class="form-control" name="payroll_id" id="payroll_id" value="">
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
				

<?php require_once 'footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".payrolledit").on('click',function(){

			var payrollid = $(this).data('payrollid');
			var userid = $(this).data('userid');
			var username = $(this).data('username');
			var contact = $(this).data('contact');
			var division = $(this).data('division');
			var advancecash = $(this).data('advancecash');
			var overtime = $(this).data('overtime');
			var lostime = $(this).data('lostime');
			var mainsalary = $(this).data('mainsalary');
			var netpay = $(this).data('netpay');
			var payrolldate = $(this).data('payrolldate');

			$('#payrollid').val(payrollid);
			$("#userid").val(userid);
			$("#username").val(username);
			$("#contact").val(contact);
			$("#division").val(division);
			$("#advancecash").val(advancecash);
			$("#overtime").val(overtime);
			$("#lostime").val(lostime);
			$("#mainsalary").val(mainsalary);
			$("#netpay").val(netpay);
			$("#paydate").val(payrolldate);

		});

		$("#payroll_edit").on('submit',function(e){
			event.preventDefault();
			var payrollid = $('#payrollid').val();
			var advancecash = $("#advancecash").val();
			var overtime = $("#overtime").val();
			var lostime = $("#lostime").val();
			var mainsalary = $("#mainsalary").val();
			var netpay = $("#netpay").val();

			$.ajax({
				method:'POST',
				url:'payrollAjaxRequest.php',
				dataType:'json',
				data:{
					payrollid:payrollid,
					advancecash:advancecash,
					overtime:overtime,
					lostime:lostime,
					mainsalary:mainsalary,
					netpay:netpay
				},
				success:function(response){
					if(response.success !=""){
					 $(".successMsg").show().text(response.success);
						}
				}
			});
		});

		// Payroll Delete
		$(".delete").on('click',function(){
			var payrollid = $(this).data('payrollid');
			console.log(payrollid);
			$("#payroll_id").val(payrollid);
		});

		$("#delete").on('click',function(e){
			e.preventDefault();
			var payrollid = $("#payroll_id").val();

			$.ajax({
				method:"POST",
				url:"payrollAjaxRequest.php",
				dataType:'json',
				data:{
					singlepayrollid:payrollid
				},
				success:function(response){
					if(response.success !=""){
						$(".successMsg").show().text(response.success);
					}
				}
			})
		})

	});
</script>