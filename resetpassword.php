<?php
require_once 'config.php';

session_start();
if(isset($_COOKIE['rememberUser'])){
  	$ad_id = $_COOKIE['rememberUser'];
  }
  else{
  	$ad_id = $_SESSION['adminlogin'][0]['ad_id'];
  }

if(isset($_POST['password_reset'])){
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

	if(empty($password1)){
		$error = "Password1 is required";
	}
	else if(empty($password2)){
		$error = "Password2 is required";
	}
	else if($password1!=$password2){
		$error = "Password1 and Password2 do not Match";
	}
	else{
		$password2=SHA1($password2);
		$stm = $pdo->prepare("UPDATE adminregister_table SET password2=? WHERE ad_id=?");
		$stm->execute(array($password2,$ad_id));
		$success = "Password Reset Success";

	}
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>EAPMS-Reset-Password</title>

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
<body>
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="index.php">
					<img src="assets/vendors/images/deskapp-logo-white.png" alt="">
				</a>
			</div>
			
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="assets/vendors/images/forgot-password.png" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Reset Password</h2>
						</div>
						<h6 class="mb-20">Enter your new password, confirm and submit</h6>
						<form method="POST" action="">
							<?php if(isset($error)): ?>
								<div class="alert alert-danger">
									<?php echo $error; ?>
								</div>
							<?php endif; ?>
							<?php if(isset($success)): ?>
								<div class="alert alert-success">
									<?php echo $success; ?>
								</div>
								<script type="text/javascript">
								setTimeout(function(){
									window.location="adminlogout.php";
								},3000);
							</script>
							<?php endif; ?>
							
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="New Password" name="password1" id="password1" onKeyUp="checkPasswordStrength();">
								<div class="input-group-append custom">
									<span toggle="#password1" class="fa fa-fw fa-eye field-icon-reset toggle-password"></span>
								</div>
								<div id="password-strength-status"></div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="Confirm New Password" name="password2" id="password2" onKeyUp="checkPasswor2dStrength();">
								<div class="input-group-append custom">
									
								<span toggle="#password2" class="fa fa-fw fa-eye field-icon-reset toggle-password2"></span>
								</div>
								<div id="password-strength-status2"></div>
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg" type="submit" value="Password Reset" name="password_reset"> 
									</div>
								</div>
							</div>
						</form>
					</div>
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