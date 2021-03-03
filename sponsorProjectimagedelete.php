<?php
require_once 'config.php';
 
$sponsor_id = $_REQUEST['sponsor_id'];

$stm = $pdo->prepare("DELETE FROM sponsor_table WHERE sponsor_id=?");
$stm->execute(array($sponsor_id));
header('location:project.php');
 


 ?>