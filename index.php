<?php require_once "header.php"; ?>
<div class="xs-pd-20-10 pd-ltr-20">
	<?php
 		 
	$total_employee = employeeCount();
	 
	$date = date('Y-m-d');
	 
	$totalattendanceCount = todayAttendanceCount($date);
	$absent = $total_employee - $totalattendanceCount;

	$totalAllemCount = currentdayAllLosTime($date);

	 ?>
	 		<h2 style="background: gray;margin-bottom: 20px;padding: 20px;font-size: 18px;color:#000; border-radius: 10px;">Today Information</h2>

			<div class="row clearfix progress-box">

	 			<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							 <input type="text" class="knob dial4" value="65" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#a683eb" data-angleOffset="180" readonly>
							<h5 class="text-light-purple padding-top-10 h5">Total Employee</h5>
							<span class="d-block"><?php echo $total_employee; ?></span>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							 <input type="text" class="knob dial1" value="80" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#1b00ff" data-angleOffset="180" readonly>
							<h5 class="text-blue padding-top-10 h5">Total Present</h5>
							<span class="d-block"><?php echo $totalattendanceCount; ?> </span>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							 <input type="text" class="knob dial2" value="70" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#00e091" data-angleOffset="180" readonly>
							<h5 class="text-light-green padding-top-10 h5">Total Absent</h5>
							<span class="d-block"><?php echo $absent; ?></span>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							 <input type="text" class="knob dial3" value="90" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#f56767" data-angleOffset="180" readonly>
							<h5 class="text-light-orange padding-top-10 h5">Total Late</h5>
							<span class="d-block"><?php echo $totalAllemCount; ?></span>
						</div>
					</div>
				</div>
			</div>	
<?php require_once "footer.php"; ?>