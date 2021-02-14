<?php require_once 'header.php'; ?>

<style type="text/css">
	.filter_atts{
		display: flex;
		align-items: center; 
	}
	.btn {
		font-family: 'Inter',sans-serif;
		letter-spacing: 0;
		font-weight: 500;
		padding: 1rem 1rem;
		margin-top: .5rem; 
	}
</style>

	<form action="" method="POST">
		<div class="filter_atts">
		<div class="form-group">
			<label for="month_name">Month</label>
			<select name="month_name" class="custom-select" id="month_name">
				<?php if(isset($_POST['month_name'])): ?>
					<option value="<?php echo $_POST['month_name']; ?>">
						<?php 
							$st_date = $_POST['year_name']."-".$_POST['month_name'];
							echo date('F',strtotime($st_date));
						?>
					</option>
				<?php endif; ?> 
				<option value="01">January</option>
				<option value="02">February</option>
				<option value="03">March</option>
				<option value="04">April</option>
				<option value="05">May</option>
				<option value="06">June</option>
				<option value="07">July</option>
				<option value="08">August</option>
				<option value="09">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>
		</div>
		<div class="form-group">
			<label for="year_name">Year</label>
			<select name="year_name" class="custom-select" id="year_name">

				 <?php if(isset($_POST['year_name'])):?>
				 	<option value="<?php echo $_POST['year_name'];?>">
				 		<?php echo $_POST['year_name'];?>
				 			
				 		</option>
				 <?php endif; ?>

				<?php 

				$start_y = 2018;
				$end_y = date('Y');
				for($i=$start_y; $i <= $end_y; $i++) :?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php endfor ?>
			</select>
		</div>

		<div class="form-group">
			<label></label>
			<input type="submit" class="btn btn-info form-control" name="filter_date" value="Filter">
		</div>
		</div>
	</form>

<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Monthly-Attendance</h4>
		 
	</div>
	<div class="pb-20">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Present</th>
					<th>Absent</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<?php if(isset($_POST['filter_date'])): ?>
			<tbody>
					<?php

					$start_date = 1;
					$year = $_POST['year_name'];
					$month = $_POST['month_name'];
					$getDate = ($year."-".$month);
					$endDate = date('t',strtotime($getDate));
					 
					for($i=$start_date; $i<=$endDate;$i++){
					 ?>
				<tr> 
					<td><?php echo $i; ?></td>
					<td><?php
					
					$loop_date = $getDate."-".$i;
					// echo $loop_date;
					$present = monthlyattCount($loop_date);
					echo $present;

					  ?></td>
					<td>
						<?php

						$usercount = employeeCount();
						$absent = $usercount - $present;
						echo $absent;

						 ?>
					</td>
					<td><?php
						
						echo date('d-M-y', strtotime($loop_date));
					  ?></td>
					<td><a clas="button-style" href="singleDate.php?date=<?php echo $loop_date; ?>">view</a></td>
				
				</tr>
				<?php }?>
				</tbody>
			<?php endif; ?>
			
		</table>
	</div>
</div>	

<?php require_once 'footer.php'; ?>