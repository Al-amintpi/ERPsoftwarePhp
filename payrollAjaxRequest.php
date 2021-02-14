<?php
require_once 'config.php';
require_once 'functions.php';

$success="";
$error = "";

if(isset($_POST['userid'])){
	$user_id = $_POST['userid'];
	$useridCount = inputCount('user_id',$user_id);
	
	if($useridCount !=1){
		$error = "User Does Not exits";
	}
	else{
		$username = user_details($user_id,'username');
		$contact = user_details($user_id,'contact');
		$division = user_details($user_id,'division');

		if($division=="Programmer"){
			$main_salary ="40000";
		}
		else if($division=="Designer"){
			$main_salary ="25000";
		}
		else if($division=="Developer"){
			$main_salary ="35000";
		}

		else if($division=="Markater"){
			$main_salary ="20000";
		}

		// Advance Cash
		$stm = $pdo->prepare('SELECT SUM(amount) AS value_sum FROM cash_advance WHERE user_id=?');
	    $stm->execute(array($user_id));

	    $row = $stm->fetch(PDO::FETCH_ASSOC);
	    $total_advance_Tk = $row['value_sum'];

	    // OverTime Total Tk
	    $stm = $pdo->prepare('SELECT SUM(overtime_totalTk) AS value_sum FROM over_time WHERE user_id=?');
	    $stm->execute(array($user_id));

	    $row = $stm->fetch(PDO::FETCH_ASSOC);
	    $total_overTime_Tk = $row['value_sum'];

	    // Los-Time Total Tk
	    $stm = $pdo->prepare('SELECT SUM(total_tk) AS value_sum FROM los_time WHERE user_id=?');
	    $stm->execute(array($user_id));

	    $row = $stm->fetch(PDO::FETCH_ASSOC);
	    $total_losTime_Tk = $row['value_sum'];

		 
		 

		$net_pay = ($main_salary+$total_overTime_Tk)-$total_advance_Tk-$total_losTime_Tk;

		$payment_date = date('Y-m-d');
		$c_year =date("Y");
		$c_month = date("m");
		$payroll_check = checkPayroll($c_year,$c_month,$user_id);
		 
		if($payroll_check !=1){
			$stm = $pdo->prepare("INSERT INTO payroll_table (user_id,user_name,contact,division,advance_cash,over_time,los_time,main_salary,net_pay,payroll_date) VALUES(?,?,?,?,?,?,?,?,?,?); ");

			$stm->execute(array($user_id,$username,$contact,$division,$total_advance_Tk,$total_overTime_Tk,$total_losTime_Tk,$main_salary,$net_pay,$payment_date));
			$success = "Your Salary complete";
		}
		else{
			$error = "Employee salary Added";
		}
	}

	$response = array(
	'success' => $success,
	'error' => $error
	);

	echo json_encode($response);
}


if(isset($_POST['payrollid'])){
	$payrollid = $_POST['payrollid'];
	$advancecash = $_POST['advancecash'];
	$overtime = $_POST['overtime'];
	$lostime = $_POST['lostime'];
	$mainsalary = $_POST['mainsalary'];
	$netpay = $_POST['netpay'];

	$net_pay = ((int)$mainsalary+(int)$overtime)-(int)$advancecash-(int)$lostime;

	$stm = $pdo->prepare("UPDATE payroll_table SET advance_cash=?,over_time=?,los_time=?,main_salary=?,net_pay=? WHERE payroll_id=?");
	$stm->execute(array($advancecash,$overtime,$lostime,$mainsalary,$net_pay,$payrollid));
	$success = "Payroll Edit success";


	$response = array(
		'success' => $success
    );
	echo json_encode($response);
}


if(isset($_POST['singlepayrollid'])){
	$payrollid = $_POST['singlepayrollid'];

	$stm = $pdo->prepare("DELETE FROM payroll_table WHERE payroll_id=?");
	$stm->execute(array($payrollid));
	$success = "Single Payroll Deleted";
	$response = array(
		'success' => $success
    );
	echo json_encode($response);
}

 ?>