<?php
session_start();
include'../connection/connect.php';


$_SESSION['recovery_code']="";
session_destroy();
header('Location:../pages/login.php');


?>