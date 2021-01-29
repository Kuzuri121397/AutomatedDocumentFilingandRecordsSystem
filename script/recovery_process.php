<?php
session_start();
include'../connection/connect.php';

if (isset($_POST['submit'])) 
{
	$recovery_code=$_POST['code'];

	$query="SELECT administrator_code FROM t_administrator_code";
	$result=mysqli_query($conn,$query);
	$Numrow=mysqli_num_rows($result);
	if($Numrow == 1)
	{
		$row=mysqli_fetch_assoc($result);
		if (password_verify($recovery_code, $row['administrator_code'])) 
		{
			$_SESSION['administrator_code']=$row;

			echo "<script>alert('Recovery Code Confirmed!'); window.location.href='../pages/change_password.php'</script>";
		}
		else
		{
			echo "<script>alert('Invalid Recovery Code'); window.location.href='../pages/login.php'</script>";
		}
	}	
}
?>