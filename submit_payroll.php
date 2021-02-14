<?php require_once "header.php"; ?>

<style type="text/css">
	.payrollbackground-image{
		background:url('assets/vendors/images/money.svg')no-repeat scroll 0 0;
	}
	
	.ErrorMsg {
		display: none;
		background: red;
		padding: 10px;
		font-size: 18px;
		color: #fff;
		border-radius: 5px;
		margin: 20px 0;
	}

	.SuccessMsg{
		display: none;
		background: green;
		padding: 10px;
		font-size: 18px;
		color: #fff;
		border-radius: 5px;
		margin: 20px 0;
	}

</style>

<section class="payrollbackground-image">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="card card-box user_join_margin">
					<div class="card-header">
						Payroll Submitted
					</div>
					<div class="card-body">
						<form method="POST" action="" id="submitpayrollForm">
						 	<div class="form-group row">
								<div class="col-sm-8">
									<input type="text" class="form-control" name="user_id" id="userid">
								</div>
							</div>
							<input type="submit" name="payroll_user" value="Payroll Submit" class="btn btn-success">
							<div class="ErrorMsg"></div>
							<div class="SuccessMsg"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require_once "footer.php"; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#submitpayrollForm").on("submit",function(event){
			event.preventDefault();
			var userid = $("#userid").val();
			if(userid.length==0){
				$(".ErrorMsg").show().text("UserId field is required");
			}
			// else if(typeof userid == ""){
			// 	$(".ErrorMsg").show().text("input type is incorrect");
			// }
			else{
				 $.ajax({
				 	method:"POST",
				 	url:"payrollAjaxRequest.php",
				 	dataType:'JSON',
				 	data:{
				 		userid:userid
				 	},
				 	success:function(response){
				 		if(response.success !=""){
				 			$(".SuccessMsg").show().text(response.success);
				 			$(".ErrorMsg").hide();
				 		}
				 		else if(response.error !=""){
				 			$(".ErrorMsg").show().text(response.error);
				 			$(".SuccessMsg").hide();
				 		}
				 	}
				 })
			}
		});
	});
</script>