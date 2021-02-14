<?php

session_start();
session_destroy();
setcookie('rememberUser',$ad_id,time()-3600,'/');
header("location:adminlogin.php");

 ?>