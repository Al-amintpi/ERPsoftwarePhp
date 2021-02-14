<?php
require_once 'config.php';
require_once 'functions.php';
session_start();
$ad_id = $_SESSION['adminlogin'][0]['ad_id'];
$position = admin_details($ad_id,'position');

 
$user_id = $_REQUEST['id'];

$stm = $pdo->prepare("DELETE FROM user_list WHERE user_id=?");
$stm->execute(array($user_id));
header('location:user_list.php?delsuccess');
 


 ?>