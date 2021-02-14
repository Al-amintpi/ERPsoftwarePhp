<?php require_once "header.php"; 

if(isset($_POST['user_register_submit'])){
	$first_name =$_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$user_id = mt_rand(10000000,99999999);
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$birthday = $_POST['birthday'];
	$national_id = $_POST['national_id'];
	$division = $_POST['division'];
	$gender = $_POST['gender'];
	$shedule = $_POST['shedule'];
	$address = $_POST['address'];
	$join_date = date('y-m-d');
	 

	$emailCount = inputCount('email', $email);
	$mobileCount = inputCount('contact', $contact);
	$national_idCount = inputCount('nid', $national_id);
	 

	if(empty($first_name)){
		$error = "First Name field is required";
	}
	else if(empty($last_name)){
		$error = "Last Name field is required";
	}
	else if(empty($username)){
		$error = "User Name field is required";
	}
	else if(empty($email)){
		$error = "Email field is required";
	}
	else if($emailCount==1){
		$error = "Email AllReady register";
	}
	else if(empty($contact)){
		$error = "Contact field is required";
	}
	else if(strlen($contact)!==11){
		$error = "Please 11 digit must be input";
	}
	else if(!is_numeric($contact)){
		$error = "Please type in Number";
	}
	else if($mobileCount==1){
		$error = "Phone Number is AllReady Register";
	}
	else if(empty($birthday)){
		$error = "Birthday field is required";
	}
	else if(empty($national_id)){
		$error = "National ID field is required";
	}
	else if($national_idCount==1){
		$error = "National Card is AllReady Register";
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
		$stm = $pdo->prepare("INSERT INTO
		 user_list (
			first_name,
			last_name,
			username,
			user_id,
			email,
			contact,
			birthday,
			nid,
			division,
			gender,
			shedule,
			address,
			join_date
		)
		 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stm->execute(array($first_name,$last_name,$username,$user_id,$email,$contact,$birthday,$national_id,$division,$gender,$shedule,$address,$join_date));
		$success = "User Added Successfull";
	}
}

?>

<section class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="assets/vendors/images/deskapp-logo-white.png" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li> Employee Register </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="assets/vendors/images/register-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="card card-box register-padding">
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
									<input type="text" class="form-control" name="first_name" id="first_name">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Last Name*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="last_name" id="last_name">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">User Name*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="username" id="user_name">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Email*</label>
								<div class="col-sm-8">
									<input type="email" class="form-control" name="email" id="email">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Contact*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="contact" id="contact">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Birthday*</label>
								<div class="col-sm-8">
									<input type="date" class="form-control" name="birthday" id="birthday">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">National*</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="national_id" id="national_id">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-12 col-md-4 col-form-label">Division</label>
								<div class="col-sm-12 col-md-8">
									<select class="custom-select col-12" name="division" id="division">
										<option selected="">Choose...</option>
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
										<option selected="">Choose...</option>
										<option value="Male">Male</option>
										<option value="Male">Female</option>
									</select>
								</div>	
							</div>	
							<div class="form-group row">
								<label class="col-sm-12 col-md-4 col-form-label">Shedule</label>
								<div class="col-sm-12 col-md-8">
									<select class="custom-select col-12" name="shedule" id="shedule">
										<option selected="">Choose...</option>
										<option value="10:00 pm-5:00: am">10:00 pm-5:00: am</option>
										<option value="9:00 pm-4:00: am">9:00 pm-4:00: am</option>
										<option value="8:00 pm-3:00: am">8:00 pm-3:00: am</option>
										<option value="7:00 pm-2:00: am">7:00 pm-2:00: am</option>
									</select>
								</div>	
							</div>	
							<div class="form-group">
								<label>Address</label>
								<textarea class="form-control" name="address" id="address"></textarea>
							</div>
							<div class="form-group">
								<input type="submit" name="user_register_submit" class="btn btn-success" value="Submit">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	 
</section>	 
<?php require_once "footer.php"; ?>	