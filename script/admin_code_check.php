<?php
session_start();
include'../connection/connect.php';

if (isset($_POST['submit'])) 
{
	$administrative_code=$_POST['admin_code'];

	$sql="SELECT administrator_code FROM t_administrator_code";
	$result=mysqli_query($conn,$sql);
	$Numrow=mysqli_num_rows($result);
	if ($Numrow == 1) 
	{
		$row=mysqli_fetch_assoc($result);

		if (password_verify($administrative_code, $row['administrator_code'])) 
		{

			$_SESSION['administrator_code']=$row;

			echo "<script>alert('Code Confirmed!'); window.location.href='../pages/log.php'</script>";
		}
		else
		{
			echo "<script>alert('Invalid Code'); window.location.href='../pages/components.php'</script>";
		}
	}
}



?>