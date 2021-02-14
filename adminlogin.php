<?php
require_once "config.php";
require_once "functions.php";
session_start();



if(isset($_POST['admin_login'])){
	$email = $_POST['email'];
	$password = $_POST['password'];

	if(empty($email)){
		$error = "Email field is required";
	}
	else if(empty($password)){
		$error = "Password field is required";
	}
	else if(!isset($_POST['options'])){ 
        $error = "No radio buttons were checked."; 
    } 
    else if(isset($_POST['options'])){

        $useroptions = $_POST['options'];
        $stm = $pdo->prepare("SELECT ad_id,email,password2 FROM adminregister_table WHERE email=?");
		$stm->execute(array($email));
		$emailCount = $stm->rowCount();
		$adminData = $stm->fetchAll(PDO::FETCH_ASSOC);

		if($emailCount==1){
			$admininputpassword = SHA1($password);
			$databasepassword = $adminData[0]['password2'];
			$ad_id = $adminData[0]['ad_id'];
			$dbposition=admin_details($ad_id,'position');
			
			if($admininputpassword==$databasepassword AND $useroptions==$dbposition){
				$_SESSION['adminlogin'] = $adminData;
                header('location:user_list.php');

                if(isset($_POST['remember'])){
					$remember = $_POST['remember'];
					if($remember==1){
						setcookie('rememberUser',$ad_id,time()+3600,'/');
					}
					else{
						setcookie('rememberUser',$ad_id,time()-3600,'/');
					}
				}

			}else{
				$error = "User and Password Do not Match";
			}
			
		}else{
			$error = "User and Password Do not Match";
		}
    } 
	else{


	}
}
 
if(isset($_SESSION["adminlogin"])){
       header("location:index.php");
    }
 
 ?>

<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>EAPMS-Login</title>

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
				<a href="login.html">
					<img src="assets/vendors/images/deskapp-logo-white.png" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="admin_register.php">Register</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="assets/vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login To DeskApp</h2>
						</div>
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
							<?php endif; ?>
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" value="admin" id="admin">
										<div class="icon"><img src="assets/vendors/images/briefcase.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Admin
									</label>
									<label class="btn">
										<input type="radio" name="options" value="superadmin" id="user">
										<div class="icon"><img src="assets/vendors/images/person.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Super Admin
									</label>
								</div>
							</div>
							<div class="input-group custom">
								<input type="email" class="form-control form-control-lg" placeholder="Email" name="email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
								<div class="input-group-append custom">
									<span toggle="#password" class="fa fa-fw fa-eye field-icon3 toggle-password"></span>
								</div>	
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="remember" class="custom-control-input" value="1" id="customCheck1">
										<label class="custom-control-label" for="customCheck1">Remember</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password"><a href="forgot-password.php">Forgot Password</a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" name="admin_login" value="Sign In">
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="admin_register.php">Register To Create Account</a>
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
		});
	</script>
</body>
</html>