<?php require_once 'header.php';

if(isset($_COOKIE['rememberUser'])){
  	$ad_id = $_COOKIE['rememberUser'];
  }
  else{
  	$ad_id = $_SESSION['adminlogin'][0]['ad_id'];
  }
$position = admin_details($ad_id,'position');



$user_id = $_REQUEST['id'];
$address = user_details($user_id,'address');

if(isset($_POST['user_update_submit'])){
	$first_name =$_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$birthday = $_POST['birthday'];
	$division = $_POST['division'];
	$gender = $_POST['gender'];
	$shedule = $_POST['shedule'];
	$address = $_POST['address'];

	if(empty($first_name)){
		$error = "First Name field is required";
	}
	else if(empty($last_name)){
		$error = "Last Name field is required";
	}
	else if(empty($username)){
		$error = "User Name field is required";
	}
	else if(empty($birthday)){
		$error = "Birthday field is required";
	}
	else if(empty($division)){
		$error = "Division field is required";
	}
	else if(empty($gender)){
		$error = "Gender field is required";
	}
	else if(empty($shedule)){
		$error = "Shedule field is required";
	}
	else if(empty($address)){
		$error = "Address field is required";
	}
	else{
		$stm = $pdo->prepare("UPDATE user_list SET first_name=?,last_name=?,username=?,birthday=?,division=?,gender=?,shedule=?,address=? WHERE user_id=?");
		$stm->execute(array($first_name,$last_name,$username,$birthday,$division,$gender,$shedule,$address,$user_id));
		$success = "Update successfully complete";
	}
}

 ?>

 
<div class="col-md-6 offset-md-3">
	<div class="card card-box register-padding">
		<h4 style="margin-bottom: 30px;"><?php echo user_details($user_id,'username'); ?> Update Details</h4>
		<form action="" method="POST">
			<?php if(isset($error)): ?>
			<div class="alert alert-danger">
				<?php echo $error; ?>
			</div>
			<?php endif ?>
			<?php if(isset($success)): ?>
			<div class="alert alert-success">
				<?php echo $success; ?>
			</div>
			<?php endif; ?>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">First Name*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?php echo user_details($user_id,'first_name'); ?>" name="first_name" id="first_name">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Last Name*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?php echo user_details($user_id,'last_name'); ?>" name="last_name" id="last_name">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">User Name*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?php echo user_details($user_id,'username'); ?>" name="username" id="user_name">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Join Date*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?php echo user_details($user_id,'join_date'); ?>" name="join_date" id="join_date" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">User ID*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?php echo user_details($user_id,'user_id'); ?>" name="user_id" id="user_id" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Email*</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" value="<?php echo user_details($user_id,'email'); ?>" name="email" id="email" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Contact*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?php echo user_details($user_id,'contact'); ?>" name="contact" id="contact" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Birthday*</label>
				<div class="col-sm-8">
					<input type="date" class="form-control" value="<?php echo user_details($user_id,'birthday'); ?>" name="birthday" id="birthday">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">National*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?php echo user_details($user_id,'nid'); ?>" name="national_id" id="national_id" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-12 col-md-4 col-form-label">Division</label>
				<div class="col-sm-12 col-md-8">
					<select class="custom-select col-12" name="division" id="division">
						<option value="<?php echo user_details($user_id,'division'); ?>" selected="">
							<?php echo user_details($user_id,'division'); ?>
						</option>
						<option value="Programmer">Programmer</option>
						<option value="Designer">Designer</option>
						<option value="Developer">Developer</option>
						<option value="Markater">Markater</option>
					</select>
				</div>	
			</div>	
			<div class="form-group row">
				<label class="col-sm-12 col-md-4 col-form-label">Gender</label>
				<div class="col-sm-12 col-md-8">
					<select class="custom-select col-12" name="gender" id="gender">
						<option value="<?php echo user_details($user_id,'gender'); ?>" selected="">
						 <?php echo user_details($user_id,'gender'); ?>
					   </option>
						<option value="Male">Male</option>
						<option value="Male">Female</option>
					</select>
				</div>	
			</div>	
			<div class="form-group row">
				<label class="col-sm-12 col-md-4 col-form-label">Shedule</label>
				<div class="col-sm-12 col-md-8">
					<select class="custom-select col-12" name="shedule" id="shedule">
						<option value="<?php echo user_details($user_id,'shedule'); ?>" selected="">
							<?php echo user_details($user_id,'shedule'); ?>
								
							</option>
						<option value="10:00 pm-5:00: am">10:00 pm-5:00: am</option>
						<option value="9:00 pm-4:00: am">9:00 pm-4:00: am</option>
						<option value="8:00 pm-3:00: am">8:00 pm-3:00: am</option>
						<option value="7:00 pm-2:00: am">7:00 pm-2:00: am</option>
					</select>
				</div>	
			</div>	
			 
			<div class="form-group">
				<label>Address</label>
				<textarea class="form-control" name="address"><?php echo $address;?></textarea>
			</div>
			<div class="form-group">
				<input type="submit" name="user_update_submit" class="btn btn-success" value="Submit">
			</div>
		</form>
	</div>
</div>

<?php require_once 'footer.php'; ?>