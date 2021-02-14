<?php 
require_once("config.php");

function user_details($user_id,$col_name){
	global $pdo;
	$stm = $pdo->prepare("SELECT $col_name FROM user_list WHERE user_id=?");
	$stm->execute(array($user_id));
	$result = $stm->fetchAll(PDO::FETCH_ASSOC);
	return $result[0]["$col_name"];
}
// echo user_details('12345','first_name');

function inputCount($col_name, $value){
    	global $pdo;
    	$countvalue = $pdo->prepare("SELECT $col_name FROM user_list WHERE $col_name=?");
    	$countvalue->execute(array($value));
    	$count = $countvalue->rowCount();
    	return $count;
    }

function admininputCount($col_name, $value){
        global $pdo;
        $countvalue = $pdo->prepare("SELECT $col_name FROM adminregister_table WHERE $col_name=?");
        $countvalue->execute(array($value));
        $count = $countvalue->rowCount();
        return $count;
    }

function admin_details($ad_id,$col_name){
    global $pdo;
    $stm = $pdo->prepare("SELECT $col_name FROM adminregister_table WHERE ad_id=?");
    $stm->execute(array($ad_id));
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["$col_name"];
}

function AttCount($col_name,$value){
        global $pdo;
        $countvalue = $pdo->prepare("SELECT $col_name FROM attendance_table WHERE $col_name=?");
        $countvalue->execute(array($value));
        $count = $countvalue->rowCount();
        return $count;
    }

// Monthly employee Attendance count
function monthlyattCount($date){
    global $pdo;
    $stm = $pdo->prepare("SELECT * FROM attendance_table WHERE DATE(present_date)=?");
    $stm->execute(array($date));
    $dateCount = $stm->rowCount();
    return $dateCount;
}

// echo monthlyattCount('2021-01-25');

// Total Employee
function employeeCount(){
    global $pdo;
    $em_count = $pdo->prepare("SELECT * FROM user_list");
    $em_count->execute(array());
    $totalem_Count = $em_count->rowCount();
    return $totalem_Count;
}
// echo employeeCount();

function singleAttUserAll($user_id,$col_name){
    global $pdo;
    $stm = $pdo->prepare("SELECT $col_name FROM attendance_table WHERE user_id=?");
    $stm->execute(array($user_id));
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["$col_name"];
}

function user_att_In_timeCount($date,$user_id,$col_name){
    global $pdo;
    $stm = $pdo->prepare("SELECT user_id,present_date,in_time FROM attendance_table WHERE DATE(present_date) = ? AND user_id=? AND in_time=?");
    $stm->execute(array($date,$user_id,$col_name));
    return $result = $stm->rowCount();
     
}
 

function user_att_Out_timeCount($date,$user_id,$col_name){
    global $pdo;
    $stm = $pdo->prepare("SELECT user_id,present_date,out_time FROM attendance_table WHERE DATE(present_date)=? AND user_id=? AND out_time=?");
    $stm->execute(array($date,$user_id,$col_name));
    return $result = $stm->rowCount();
     
}
// echo user_att_Out_timeCount('2021-01-30','68584105','05:00 pm');

function singleCheckAtt($user_id,$date){
    global $pdo;
    $stm = $pdo->prepare("SELECT user_id,present_date FROM attendance_table WHERE user_id=? AND DATE(present_date)=?");
    $stm->execute(array($user_id,$date));
    return $result = $stm->rowCount();
    // return $result[0]['user_time']; 
}
// echo singleCheckAtt('92187975','2021-01-11');

// Today Attendance Count
function todayAttendanceCount($date){
    global $pdo;
    $stm = $pdo->prepare("SELECT present_date FROM attendance_table WHERE DATE(present_date)=?");
    $stm->execute(array($date));
    return $result = $stm->rowCount();
    // return $result[0]['user_time']; 
}
// echo todayAttendanceCount('2021-01-31');

// Today Late Employee
function currentdayAllLosTime($date){
    global $pdo;
    $stm = $pdo->prepare("SELECT user_id,lost_date FROM los_time WHERE DATE(lost_date)=?");
    $stm->execute(array($date));
    return $result = $stm->rowCount();
    // return $result[0]['user_time']; 
}

function currentMonthAllLosTime($user_id,$date){
    global $pdo;
    $stm = $pdo->prepare("SELECT user_id,lost_date FROM los_time WHERE user_id=? AND DATE(lost_date)=?");
    $stm->execute(array($user_id,$date));
    return $result = $stm->rowCount();
    // return $result[0]['user_time']; 
}
// echo currentMonthAllLosTime('68584105','2021-01-30');

function losTimeUserAll($user_id,$col_name){
    global $pdo;
    $stm = $pdo->prepare("SELECT $col_name FROM los_time WHERE user_id=?");
    $stm->execute(array($user_id));
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["$col_name"];
}

function currentMonthAllOverTime($user_id,$date){
    global $pdo;
    $stm = $pdo->prepare("SELECT user_id,overtime_date FROM over_time WHERE user_id=? AND DATE(overtime_date)=?");
    $stm->execute(array($user_id,$date));
    return $result = $stm->rowCount();
    // return $result[0]['user_time']; 
}
// echo currentMonthAllLosTime('68584105','2021-01-30');

function overTimeUserAll($user_id,$col_name){
    global $pdo;
    $stm = $pdo->prepare("SELECT $col_name FROM over_time WHERE user_id=?");
    $stm->execute(array($user_id));
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["$col_name"];
}

// Function Probleam
// function advance_cash($user_id){
//     global $pdo;
//     $stm = $pdo->prepare('SELECT user_id,SUM(amount) AS value_sum FROM cash_advance WHERE user_id=?');
//     $stm->execute(array($user_id));

//     $row = $stm->fetch(PDO::FETCH_ASSOC);
//     $sum = $row['value_sum'];
//     return $sum;
// }
// echo advance_cash('68584105');



function checkPayroll($year,$month,$userid){
    global $pdo;
    $stm = $pdo->prepare("SELECT payroll_date,user_id FROM payroll_table WHERE YEAR(payroll_date)=? AND MONTH(payroll_date) = ? AND user_id=?");
    $stm->execute(array($year,$month,$userid));
    return $result = $stm->rowCount();  
}

// echo checkPayroll('2021','01','68584105');

 ?>