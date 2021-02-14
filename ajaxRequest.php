<?php 
require_once "config.php";
require_once "functions.php";

// Forgot Password Area

// session_start();

$success = "";
$error = "";
$userid="";

if(isset($_POST['forgetEmail'])){
	$email = $_POST['forgetEmail'];

	$stm = $pdo->prepare("SELECT ad_id,email,password2 FROM adminregister_table WHERE email=?");
	$stm->execute(array($email));
	$emailCount = $stm->rowCount();

	if($emailCount==1){
	    
	    //Get user Id
		$result = $stm->fetchAll(PDO::FETCH_ASSOC);
		$user_id = $result[0]["ad_id"];
	    
		$reset_code = rand(100000,999999999);
		
		$stm = $pdo->prepare("UPDATE adminregister_table SET reset_code=? WHERE email=?");
		$stm->execute(array($reset_code,$email));
		
        
		$link = 'https://coderit.fun/ERPapplication/forgot-password.php?code='.$reset_code.'&id='.$user_id;
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
    
		 $messages = "Your Password Reset Code"."\r\n";
		 $messages .= '<pre>'.$reset_code.'</pre>'."\r\n";
		 $messages .= '<a href="'.$link.'">Click to Reset Password</a>'."\r\n";
		 
		 $mail = mail($email, "Reset Password", $messages,$headers);

		 if($mail){
		 	$success = "Submit your reset code. Please check the Email..";
		 }

	}
	else{
		$error = "Email Do not match";
	}
    
    $response = array(
        'success' => $success,
        'error'  => $error,
        'userid' => $user_id
        );
        
    echo json_encode($response);

}


// Password Reset Code


if(isset($_POST['reset_code'])){
	$reset_code = $_POST['reset_code'];
	$p_user_id = $_POST['p_user_id'];

	$stm = $pdo->prepare("SELECT ad_id,email,password2,reset_code FROM adminregister_table WHERE ad_id=? AND reset_code=?");
	$stm->execute(array($p_user_id,$reset_code));
	$userCount = $stm->rowCount();

	if($userCount==1){
	    $success = "Code Is Match";
 
        // $getEmail = $stm->fetchAll(PDO::FETCH_ASSOC);
        // $getEmail = $getEmail['0']['email'];
        
        // $_SESSION['forgetUserEmail'] = $getEmail;
	    
	}
    else{
        $error = "Code Do Not Match";
    }
    
    $response = array(
        'success' => $success,
        'error'  => $error,
        // 'getEmail' => $getEmail
        );
        
    echo json_encode($response);
}

// New password set

if(isset($_POST['cnew_password'])){
	$cnew_password = $_POST['cnew_password'];
	$user_id = $_POST['user_id'];
	
	$stm = $pdo->prepare("SELECT ad_id,email,password2 FROM adminregister_table WHERE ad_id=?");
	$stm->execute(array($user_id));
	$emailCount = $stm->rowCount();
// 	without session
	
// 	$stm = $pdo->prepare("SELECT ad_id,email,password2 FROM adminregister_table WHERE email=?");
// 	$stm->execute(array($_SESSION['forgetUserEmail']));
// 	$emailCount = $stm->rowCount();

	if($emailCount==1){
	    $cnew_password=SHA1($cnew_password);
	    
	    $stm = $pdo->prepare("UPDATE adminregister_table SET password2=? WHERE ad_id=?");
	    $stm->execute(array($cnew_password,$user_id));
	   //without session
	    
	   // $stm = $pdo->prepare("UPDATE adminregister_table SET password2=? WHERE email=?");
	   // $stm->execute(array($cnew_password,$_SESSION['forgetUserEmail']));
	    $success = "Password Update Success";
	   // session_destory();
	}
	else{
		$error = "User Not Found";
	}
    
    $response = array(
        'success' => $success,
        'error'  => $error
        );
        
    echo json_encode($response);

}

// ENd Forgot Password Area


 


// Advance Cash Added
if(isset($_POST['user_id'])){
	$user_id = $_POST['user_id'];
	$cash_advance_amount = $_POST['cash_advance_amount'];

	$stm = $pdo->prepare("SELECT * FROM user_list WHERE user_id=?");
	$stm->execute(array($user_id));
	$user_idCount = $stm->rowCount();

	if($user_idCount==1){
		$username = user_details($user_id,'username');
		$division = user_details($user_id,'division');
		$cash_date=date('Y-m-d');
		$stm=$pdo->prepare("INSERT INTO cash_advance(user_id,username,division,amount,cash_date)VALUES(?,?,?,?,?)");
		$stm->execute(array($user_id,$username,$division,$cash_advance_amount,$cash_date));
		$success = "Cash Successfully Added";
	}
	else{
		$error = "User does not exits";
	}
	
	$response = array(
		'success'=>$success,
		'error'=>$error
	);

	echo json_encode($response);

}

// Advance Cash Edit 
if(isset($_POST['c_id'])){
	$c_id = $_POST['c_id'];
	$amount = $_POST['amount'];
	 

	$stm = $pdo->prepare("UPDATE cash_advance SET amount=? WHERE c_id=?");
	$stm->execute(array($amount,$c_id));
	echo "Update Success";

	// $response = array(
	// 	'success' => $success
		 
	// );

	// echo json_encode($response);

}

// Advance cash Delete

if(isset($_POST['cash_id'])){
	$cash_id = $_POST['cash_id'];
	 

	$stm = $pdo->prepare("DELETE FROM cash_advance WHERE c_id=?");
	$stm->execute(array($cash_id));
	echo "Delete Success";

}

?>