<?php
	require_once "header.php";
	 

if(isset($_POST['att_outtime'])){
	$user_id = $_POST['em_id'];
	$division = $_POST['division'];
	$out_time = $_POST['shedule'];
	$present_date = date('Y-m-d');
	 
	$user_count = inputCount('user_id',$user_id);

	if(empty($user_id)){
		$error = "Employee Id is required";
	}
	else if(empty($division)){
		$error = "Division Filed is required";
	}
	else if($user_count!=1){
		$error = "User not exits";
	}
	 
	else{
		
		$dbdivision = user_details($user_id,"division");
		if($division==$dbdivision){
			$userDateCount = user_att_Out_timeCount($present_date,$user_id,$out_time);
			if($userDateCount==1){
				$error = "User Alreay Submitted Out-Time!";
			}else{
				 
				$stm = $pdo->prepare("UPDATE attendance_table SET out_time=? WHERE user_id=?");
				$stm->execute(array($out_time,$user_id));
				$success ="Out Time Submit Success";

				if($division=="Programmer"){
					$rate = 4;
				}
				else if($division=="Designer"){
					$rate = 3;
				}
				else if($division=="Developer"){
					$rate = 5;
				}
				else if($division=="Markater"){
					$rate = 3;
				}

				
				$officeOuttime= date('H:i:s',strtotime($out_time));
				$currentime= strtotime(date('H:i:s'));
				$officeOuttime= strtotime(date($officeOuttime));
				if((isset($success))AND($currentime>$officeOuttime) AND (isset($_POST['checkbox']))){
					$over1_time =$currentime-$officeOuttime;
					$over_time_hour = round(abs((($over1_time)/60)));
					 
					$username = user_details($user_id,"username");
					$division = user_details($user_id,"division");

				$overtime_totalTk = $over_time_hour*$rate;
				$stm = $pdo->prepare("INSERT INTO over_time(user_id,user_name,division,n_of_hour,rate,overtime_totalTk,overtime_date)VALUES(?,?,?,?,?,?,?)");
				$stm->execute(array($user_id,$username,$division,$over_time_hour,$rate,$overtime_totalTk,$present_date));
				 
				} 
			}
			
		}
		else{
		$error = "User not exits";
		}
		 

	}
}

	
 ?>
 
 
<section class="userjoin-background-image">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<form method="POST" action="">
					<div class="card card-box user_join_margin">
							<div class="card-header">
								Today Out-Time <?php echo date("d F Y"); ?>
							</div>
							<div class="card-body">
								<form action="" method="POST">
								 	<?php if(isset($error)): ?>
								 		<div class="alert alert-danger">
								 			<?php echo $error; ?>
								 		</div>
								 	<?php endif; ?>
								 	<?php if(isset($success)): ?>
								 		<div class="alert alert-success">
								 			<?php echo $success; ?>
								 		</div>
								 	<?php endif; ?>
								 	<div class="form-group row">
										<div class="col-sm-8">
											<input type="text" class="form-control" name="em_id" id="em_id">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-8">
											<select class="custom-select col-12" name="division" id="division">
												<option value="">Choose...</option>
												<option value="Programmer">Programmer</option>
												<option value="Designer">Designer</option>
												<option value="Developer">Developer</option>
												<option value="Markater">Markater</option>
											</select>
										</div>
									</div>	

									<div class="form-group row programmer">
										<div class="col-sm-8">
											<input type="text" class="form-control" name="shedule" value="" id="shedule" readonly="">
										</div>
									</div>
									 <div class="custom-control custom-checkbox mb-5">
										<input type="checkbox" class="custom-control-input" id="customCheck1" value="" name="checkbox">
										<label class="custom-control-label" for="customCheck1">Over-Time</label>
									</div>
									<input type="submit" name="att_outtime" value="Out Time Submit" class="btn btn-success">
								</form>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</section> 
	 
	<?php require_once 'footer.php'; ?> 
	<script type="text/javascript">
		$(document).ready(function(){
			$('select#division').change(function(){
				var selectedPosition = $(this).children('option:selected').val();
  				console.log(selectedPosition);

  				if(selectedPosition===""){
  					$('.programmer').hide();
  				}

  				else if(selectedPosition==="Programmer"){
  					$('#shedule').val("05:00 pm");
  					$('.programmer').show();
  				}


  				else if(selectedPosition==="Designer"){
  					$('#shedule').val("04:00 pm");
  					$('.programmer').show();
  				}
  				else if(selectedPosition==="Developer"){ 
  					$('#shedule').val("03:00 pm");
  					$('.programmer').show();
  				}
  				else if(selectedPosition==="Markater"){
  					 $('#shedule').val("02:00 pm");
  					 $('.programmer').show();
  				}
			});

			 
		});
	</script>
	 
 