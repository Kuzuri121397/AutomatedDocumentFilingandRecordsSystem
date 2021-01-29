<?php
include'../connection/connect.php';
if(!isset($_SESSION['administrator_code']))
{
	echo "<script>alert('Administrator Code required')</script>";
    echo "<script>window.location.href = '../pages/login.php'</script>";
}






?>