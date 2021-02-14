<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>EAPMS Forget Password</title>

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


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<style>
	    #passwordResetForm{
	        display:none;
	    }
	    #newPasswordForm{
	        display:none;
	    }
	    .msgError {
        background: red;
        padding: 10px;
        color: #ffff;
        border-radius: 5px;
        margin-bottom: 20px;
        display:none;
        }
        
        .msgSuccess {
        background: green;
        padding: 10px;
        color: #ffff;
        border-radius: 5px;
        margin-bottom: 20px;
        display:none;
        }
	</style>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>

<body>
	 
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="assets/vendors/images/forgot-password.png" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Forgot Password</h2>
						</div>
						<div class="msgError"></div>
						<div class="msgSuccess"></div>
						
						<form method="POST" action="" id="forgotform">
						    <h6 class="mb-20">Enter your email address to reset your password</h6>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Email" name="forgot_email" id="forgot_email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
								</div>
							</div>

							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373">OR</div>
								</div>
								<div class="col-5">
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="adminlogin.php">Login</a>
									</div>
								</div>
							</div>
						</form>
						    
					    <!--Password Reset Code-->
					    <form method="POST" action="" id="passwordResetForm">
					         <label for="reset_code">Recive Code</label>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Recive Code" name="reset_code" id="reset_code">
							</div>
							<input type="hidden" name="p_user_id" id="p_user_id">
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" value="Code Submit">
									</div>
								</div>
							</div>
						</form>
						
						<!--New Password Form-->
						<form method="POST" action="" id="newPasswordForm">
					         <label for="new_password">New Password</label>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" name="new_password" id="new_password">
							</div>
							<label for="cnew_password">Confirm New Password</label>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" name="cnew_password" id="cnew_password">
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" value=" New Password">
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
	
 <?php
	if(isset($_GET['code'])){
	    $emailCode = $_GET['code'];
	    $userId = $_GET['id'];
	    
	    ?>
	    <script>
	        $("#forgotform").hide();
	        $("#passwordResetForm").show();
	        
	        $("#reset_code").val("<?php echo $emailCode; ?>");
	        $("#p_user_id").val("<?php echo $userId; ?>");
	    </script>
	 <?php
	}
	?>
	
	<script type="text/javascript">

		$("#forgotform").on('submit',function(event){
			event.preventDefault();
			var forgetEmail = $("#forgot_email").val();
			if(forgetEmail.length == 0){
				$(".msgError").show().text("Email is required");
				 $(".msgSuccess").hide();
			}
			else{
				 $(".msgError").hide();
			
				$.ajax({
					type:"POST",
					url:"ajaxRequest.php",
					dataType:'json',
					data:{
						forgetEmail:forgetEmail
					},
					success:function(response){
					    console.log(response);
					    if(response.success !=""){
					        $(".msgSuccess").show().text(response.success);
					        $(".msgError").hide();
					        
					        $("#p_user_id").val(response.userid);
					        $("#passwordResetForm").show();
					        $("#forgotform").hide();
					        
					        
					    }
					    if(response.error !=""){
					         $(".msgError").show().text(response.error);
					         $(".msgSuccess").hide();
					         
					    }
						
					}
				});

			}
		});
		
        //Password Reset Code
        
		$("#passwordResetForm").on('submit',function(event){
			event.preventDefault();
			var reset_code = $("#reset_code").val();
			var p_user_id = $("#p_user_id").val();
			if(reset_code.length == 0){
				$(".msgError").show().text("Reset Code is required");
			}
			else{
				 $(".msgError").hide();
			
				$.ajax({
					type:"POST",
					url:"ajaxRequest.php",
					dataType:'json',
					data:{
						reset_code:reset_code,
						p_user_id:p_user_id
					},
					success:function(response){
					   //console.log(response.getEmail);
					    if(response.success !=""){
					        $(".msgSuccess").show().text(response.success);
					        $(".msgError").hide();
					         
					         
					        $("#passwordResetForm").hide();
					        $("#newPasswordForm").show();
					        
					        
					    }
					    if(response.error !=""){
					         $(".msgError").show().text(response.error);
					         $(".msgSuccess").hide();
					         
					    }
						
					}
				});

			}
		});
		
        // New Password Set
        $("#newPasswordForm").on('submit',function(event){
			event.preventDefault();
			var new_password = $("#new_password").val();
			var cnew_password = $("#cnew_password").val();
			var user_id = $("#p_user_id").val();
			
			if(new_password.length == 0){
				$(".msgError").show().text("New Password field is required");
				$(".msgSuccess").hide();
			}
			else if(cnew_password.length == 0){
			    	$(".msgError").show().text("Confirm Password field is required");
			    	$(".msgSuccess").hide();
			}
			else if(new_password != cnew_password){
			    $(".msgError").show().text("New Password & Confirm Password do not match");
			    $(".msgSuccess").hide();
			}
			else{
				 
				$.ajax({
					type:"POST",
					url:"ajaxRequest.php",
					dataType:'json',
					data:{
						cnew_password:cnew_password,
						user_id:user_id
						 
					},
					success:function(response){
					    console.log(response);
					    if(response.success !=""){
					        $(".msgSuccess").show().text(response.success);
					        $(".msgError").hide();
					         
					        $("#newPasswordForm").show();
					        
					        
					    }
					    if(response.error !=""){
					         $(".msgError").show().text(response.error);
					         $(".msgSuccess").hide();
					         
					    }
						
					}
				});

			}
		});
	</script>
</body>

</html>