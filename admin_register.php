<?php 
 
require_once 'config.php';
require_once 'functions.php';
session_start();
if(isset($_SESSION['adminlogin'])){
	header('location:index.php');
}
 

if(isset($_POST['admin_register'])){

	$username = $_POST['username'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];

	$photo = $_FILES['profile_photo'];
	$photo_name = $_FILES['profile_photo']['name'];
	$tmp_name = $_FILES['profile_photo']['tmp_name'];
	$size = $_FILES['profile_photo']['size'];

	$position = $_POST['position'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$adminjoindate = date('y-m-d');

	$extension = pathinfo($photo_name, PATHINFO_EXTENSION);

	$emailCount = admininputCount('email',$email);
	$mobileCount = admininputCount('mobile',$mobile);

	if(empty($username)){
		$error = "Username Field is required";
	}
	else if(empty($mobile)){
		$error = "Mobile Field is required";
	}
	else if($mobileCount==1){
		$error = "Mobile Number is AllReady Use";
	}
	else if(strlen($mobile)!==11){
		$error = "Must 11 Digit Use";
	}
	else if(empty($email)){
		$error = "email Field is required";
	}
	else if($emailCount==1){
		$error = "Email AllReady Register";
	}
	else if(empty($photo_name)){
		$error = "Photo Field is required";
	}
	else if(empty($position)){
		$error = "Position Field is required";
	}
	else if(empty($password1)){
		$error = "Password-1 Field is required";
	}
	else if(empty($password2)){
		$error = "Password-2 Field is required";
	}
	else if ($extension !='png' and $extension !='PNG' AND $extension !='JPG' AND $extension !='jpg' and $extension !='jpeg' and $extension !='jpeg' and $extension !='gif' and $extension !='GIF') {
		$error = "Please Right file type";
	}
	else{
		$password1 = SHA1($password1);
		$password2 = SHA1($password2);
		//photo upload
		$photo_name = uniqid().".".$extension;
		$upload = move_uploaded_file($tmp_name, 'adminprofilephotos/'.$photo_name);
		if($password1==$password2 AND $upload==true){
			$stm = $pdo->prepare("INSERT INTO 
				adminregister_table(
				username,
				mobile,
				email,
				profilephoto,
				position,
				password2,
				adminjoindate
			)
			VALUES(?,?,?,?,?,?,?)");

			$stm->execute(array($username,$mobile,$email,$photo_name,$position,$password2,$adminjoindate));
			$success = "Admin Register Success";
			header("location:index.php");
		}
		else{
			$error = "Password do not match!";
		}
		
	}

}

 ?>

<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="assets/vendors/images/deskapp-logo-white.png">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/vendors/images/deskapp-logo-white.png">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/vendors/images/deskapp-logo-white.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/styles/icon-font.min.css">
	 
	<link rel="stylesheet" type="text/css" href="assets/vendors/styles/style.css">

	<!-- custom.css -->
	<link rel="stylesheet" type="text/css" href="assets/vendors/styles/custom.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="admin_login.php">
					<img src="assets/vendors/images/deskapp-logo-white.png" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="adminlogin.php">Login</a></li>
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
					<div class="card card-box admin-register-margin">
							<div class="card-header">
								Admin/Super Admin Register
							</div>
						</div>
					<form action="" method="POST" enctype="multipart/form-data">
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
							<label class="col-sm-4 col-form-label">Username*</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="username" id="username">
							</div>
						</div>	
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Mobile*</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="mobile" id="mobile">
							</div>
						</div> 
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Email Address*</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" name="email" id="email">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Profile Photo</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="profile_photo" id="file">
								<label>Choose file</label>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Position</label>
							<div class="col-sm-12 col-md-8">
								<select class="custom-select col-12" name="position" id="gender">
									<option selected="">Choose...</option>
									<option value="admin">Admin</option>
									<option value="superadmin">Super Admin</option>
								</select>
							</div>	
						</div>	
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Password*</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="password1" id="password1" onKeyUp="checkPasswordStrength();">
								<span toggle="#password1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								<div id="password-strength-status"></div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Confirm Password*</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="password2" id="password2" onKeyUp="checkPasswor2dStrength();">
								<span toggle="#password2" class="fa fa-fw fa-eye field-icon2 toggle-password2"></span>
								<div id="password-strength-status2"></div>
							</div>
						</div>
						<div class="form-group row">
							<input type="submit" class="form-control btn btn-success" name="admin_register" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
 
	<!-- js -->
	<script src="assets/vendors/scripts/core.js"></script>
	<script src="assets/vendors/scripts/script.min.js"></script>
	<script src="assets/vendors/scripts/process.js"></script>
	<script src="assets/vendors/scripts/layout-settings.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.toggle-password').click(function(){
				$(this).toggleClass("fa-eye fa-eye-slash");
				var input = $($(this).attr('toggle'));
				if(input.attr('type')=='password'){
					input.attr('type', 'text');
				}else{
					input.attr('type','password');
				}
			});

			$('.toggle-password2').click(function(){
				$(this).toggleClass("fa-eye fa-eye-slash");
				var input = $($(this).attr('toggle'));
				if(input.attr('type')=='password'){
					input.attr('type', 'text');
				}else{
					input.attr('type','password');
				}
			});
		});

		// password trength check
		function checkPasswordStrength() {
			var number = /([0-9])/;
			var alphabets = /([a-zA-Z])/;
			var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;

			if($('#password1').val().length<6) {
				$('#password-strength-status').removeClass();
				$('#password-strength-status').addClass('weak-password');
				$('#password-strength-status').html("Weak (should be atleast 6 characters.)");
			} else {  	
			    if($('#password1').val().match(number) && $('#password1').val().match(alphabets) && $('#password1').val().match(special_characters)) {            
					$('#password-strength-status').removeClass();
					$('#password-strength-status').addClass('strong-password');
					$('#password-strength-status').html("Strong");
		        } else {
					$('#password-strength-status').removeClass();
					$('#password-strength-status').addClass('medium-password');
					$('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
		        } 
			}

		}
		function checkPasswor2dStrength() {
			var number = /([0-9])/;
			var alphabets = /([a-zA-Z])/;
			var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;

			if($('#password2').val().length<6) {
				$('#password-strength-status2').removeClass();
				$('#password-strength-status2').addClass('weak-password');
				$('#password-strength-status2').html("Weak (should be atleast 6 characters.)");
			} else {  	
			    if($('#password2').val().match(number) && $('#password2').val().match(alphabets) && $('#password2').val().match(special_characters)) {            
					$('#password-strength-status2').removeClass();
					$('#password-strength-status2').addClass('strong-password');
					$('#password-strength-status2').html("Strong");
		        } else {
					$('#password-strength-status2').removeClass();
					$('#password-strength-status2').addClass('medium-password');
					$('#password-strength-status2').html("Medium (should include alphabets, numbers and special characters.)");
		        } 
			}

		}
	</script>
</body>

</html>