<?php
session_start();
include'../connection/connect.php';


$sql="SELECT user_id FROM t_user";
$result=mysqli_query($conn, $sql);
while ($row=mysqli_fetch_array($result)) 
{
	unset($_SESSION['administrator_code']);
	$user_id=$row['user_id'];
	echo "<script type='text/javascript'>window.location.href='../pages/components.php?user_id=".$user_id."'</script>";
	# code...
}


?>