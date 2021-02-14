 
<?php require_once 'header.php'; 

$user_id = $_REQUEST['id'];



?>
<div class="row">
	<div class="col-md-6 offset-md-3">

		<div class="card card-box register-padding single-margin">
			<div class="clearfix mb-20">
				<div class="pull-left">
					<h4 class="text-blue h4"><?php echo user_details($user_id,"username");?>     Details</h4>
					 
				</div>
				<div class="pull-right extra-margin">
					<a href="user_list.php" class="btn btn-primary btn-sm" rel="content-y"><i class="icon-copy fa fa-angle-double-left" aria-hidden="true"></i>Back</a>
				</div>
		    </div>
			<table class="table">
				<tr>
					<td>First Name</td>
					<td><?php echo user_details($user_id,"first_name"); ?></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><?php echo user_details($user_id,"last_name"); ?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><?php echo user_details($user_id,"username"); ?></td>
				</tr>
				<tr>
					<td>User_ID</td>
					<td><?php echo user_details($user_id,"user_id"); ?></td>
				</tr>
				<tr>
					<td>Contact</td>
					<td><?php echo user_details($user_id,"contact"); ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo user_details($user_id,"email"); ?></td>
				</tr>
				<tr>
					<td>Birthday</td>
					<td><?php
					echo date('d F Y',strtotime(user_details($user_id,"birthday")));
					  ?></td>
				</tr>
				<tr>
					<td>National Card</td>
					<td><?php echo user_details($user_id,"nid"); ?></td>
				</tr>
				<tr>
					<td>Division</td>
					<td><?php echo user_details($user_id,"division"); ?></td>
				</tr>
				<tr>
					<td>Gender</td>
					<td><?php echo user_details($user_id,"gender"); ?></td>
				</tr>
				<tr>
					<td>Shedule</td>
					<td><?php echo user_details($user_id,"shedule"); ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><?php echo user_details($user_id,"address"); ?></td>
				</tr>
				<tr>
					<td>Join-Date</td>
					<td><?php
					echo date('d F Y',strtotime(user_details($user_id,"join_date")));
					 ?></td>
				</tr>
			</table>
	    </div>		
	</div>
</div>
<?php require_once 'footer.php'; ?>