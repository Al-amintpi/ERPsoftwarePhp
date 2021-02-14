<?php require_once 'config.php'; ?>
<?php require_once 'functions.php';
	session_start();
	   
    if (!isset($_SESSION["adminlogin"]) AND !isset($_COOKIE['rememberUser'])) {
       header("location:adminlogin.php");
    } 
    


  if(isset($_COOKIE['rememberUser'])){
  	$ad_id = $_COOKIE['rememberUser'];
  }
  else{
  	$ad_id = $_SESSION['adminlogin'][0]['ad_id'];
  }
$position = admin_details($ad_id,'position');

 ?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Employee Payroll And Attendance</title>

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
	 
	<link rel="stylesheet" type="text/css" href="assets/src/plugins/jvectormap/jquery-jvectormap-2.0.3.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/styles/style.css">

	<link rel="stylesheet" type="text/css" href="assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css">

	<link rel="stylesheet" type="text/css" href="assets/src/plugins/datatables/css/responsive.bootstrap4.min.css">
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
	 <style type="text/css">
	 
	 
}
	 </style>
</head>
<body>
<!-- 	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="assets/vendors/images/deskapp-logo-white.png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div> -->

	<div class="header">
		<div class="header-left">
		
		</div>
		<!--------------------- Menu bar Start ---------------------------->
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			 
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="
								<?php
                    			$photo = admin_details($ad_id,'profilephoto');
                    			echo "adminprofilephotos/".$photo;
                 				?>
							" alt="">
						</span>
						<span class="user-name">
						<?php
						 echo admin_details($ad_id,'username');
						 ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						 
						<a href="#" class="dropdown-item btn-block" data-toggle="modal" data-target="#profile-modal" type="button"><i class="icon-copy fa fa-user" aria-hidden="true"></i>Profile</a>

						<a href="admin_user_update.php?id=<?php echo $ad_id; ?>" class="dropdown-item btn-block" type="button"><i class="icon-copy fa fa-edit" aria-hidden="true"></i>Profile edit</a>

						<a class="dropdown-item" href="resetpassword.php"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="adminlogout.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>

							 
			</div>
			 
		</div>
	</div>

<!-- Modal Profile section  -->
<div class="modal fade" id="profile-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-padding">
				<h4 class="modal-title" id="myLargeModalLabel"><?php echo admin_details($ad_id,'username'); ?> (<small><?php echo admin_details($ad_id,'position'); ?></small>) Profile Details</h4>
				 
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<td>Username</td>
						<td><?php echo admin_details($ad_id,'username'); ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo admin_details($ad_id,'email'); ?></td>
					</tr>
					<tr>
						<td>Profile Photo</td>
						<td> 
						<span class="profile-user-img">
							<img src="
								<?php
                    			$photo = admin_details($ad_id,'profilephoto'); 
                    			echo "adminprofilephotos/".$photo;
                 				?>
							" alt=""><?php
						?>
						</span>
					</td>
					</tr>
					<tr>
						<td>Position</td>
						<td><?php echo admin_details($ad_id,'position'); ?></td>
					</tr>
					<tr>
						<td>Join Date</td>
						<td><?php 
							$date =  admin_details($ad_id,'adminjoindate'); 
							echo date('d F Y',strtotime($date));
						?></td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal Profile section End -->

 
	<!-- Setting section -->
	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Setting section -->
	<!-- ----------------------------Menu bar End------------------------ -->
	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<img src="assets/vendors/images/deskapp-logo-white.png" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext">User</span>
						</a>
						<ul class="submenu">
							<li><a href="register.php">User Register</a></li>
							<li><a href="user_list.php">User List</a></li>
							<li><a href="cash-advance.php">Advance-Cash</a></li> 
							<li><a href="overTime.php">Over-Time</a></li>
							<li><a href="los_time.php">Los-Time</a></li>
						</ul>
					</li>

					<li>
						<div class="dropdown-divider"></div>
					</li>
					 
					 
					<li>
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit-2"></span><span class="mtext">Attendance</span>
						</a>
						<ul class="submenu">
							<li><a href="regular_att_intime.php">User In-Time</a></li>
							<li><a href="regular_att_outime.php">User Out-Time</a></li>
							<li><a href="allAttendance.php">User All Attendance</a></li>
							<li><a href="monthly_attendance.php">Monthly Attendance</a></li>
						</ul>
					</li>
					<?php if($position=="superadmin"): ?>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit-2"></span><span class="mtext">PayRoll</span>
						</a>
						<ul class="submenu">
							<li><a href="submit_payroll.php">Submit Payroll</a></li>
							<li><a href="payroll_list.php">Payroll List</a></li>
						</ul>
					</li>
				<?php endif; ?>
					 
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		