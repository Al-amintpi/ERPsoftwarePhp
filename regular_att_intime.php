<?php
	require_once "header.php";

if(isset($_POST['att_user'])){
	$user_id = $_POST['em_id'];
	$division = $_POST['division'];
	$in_time = $_POST['shedule'];
	$present_date = date('Y-m-d');


	$officetime= date('H:i:s',strtotime($in_time));
	$currentime= strtotime(date('H:i:s'));
	$officetime= strtotime(date($officetime));

    if ($currentime>$officetime) {
       $status=0;
       
    }
    else {
       $status=1;
    }
    


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
			$userDateCount = user_att_In_timeCount($present_date,$user_id,$in_time);
			if($userDateCount==1){
				$error = "User Alreay Join In!";
			}else{
				$user_name = user_details($user_id,"username");
				$stm = $pdo->prepare("INSERT INTO attendance_table(user_id,user_name,division,in_time,status,present_date) VALUES (?,?,?,?,?,?)");
				$stm->execute(array($user_id,$user_name,$division,$in_time,$status,$present_date));
				$success = "Attendance Successfully complete";
				
				 
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
				
				if((isset($success)) AND ($currentime>$officetime)){
					$lost1_time =$currentime-$officetime;
       				$los_time = round(abs((($lost1_time)/60)));
       				$totaltk = $los_time*$rate;
					$stm = $pdo->prepare("INSERT INTO los_time(user_id,user_name,division,los_time,rate,total_tk,lost_date)VALUES(?,?,?,?,?,?,?)");
					$stm->execute(array($user_id,$user_name,$division,$los_time,$rate,$totaltk,$present_date)); 
				}else{
					 
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
								Today In-Time <?php echo date("d F Y"); ?>
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
									<input type="submit" name="att_user" value="Attendance Submit" class="btn btn-success">
								</form>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</section> 
	 
	 <?php require_once "footer.php"; ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('select#division').change(function(){
				var selectedPosition = $(this).children('option:selected').val();
  				console.log(selectedPosition);

  				if(selectedPosition===""){
  					$('.programmer').hide();
  				}

  				else if(selectedPosition==="Programmer"){
  					$('#shedule').val("10:00 am");
  					$('.programmer').show();
  				}


  				else if(selectedPosition==="Designer"){
  					$('#shedule').val("09:00 am");
  					$('.programmer').show();
  				}
  				else if(selectedPosition==="Developer"){
  					$('#shedule').val("08:00 am");
  					$('.programmer').show();
  				}
  				else if(selectedPosition==="Markater"){
  					 $('#shedule').val("07:00 am");
  					 $('.programmer').show();
  				}
			});

			 
		});
	</script>
	 
 