<?php
include'../connection/connect.php';
if(!isset($_SESSION['user_id']))
{
	echo "<script>alert('Username/Password is required')</script>";
    echo "<script>window.location.href = '../pages/login.php'</script>";
}
else
{
	if(isset($_SESSION['user_id']))
	{
		$test=$_SESSION['user_id'];
    	$sql="SELECT * FROM t_user WHERE user_id='".$test."'";
    	$result=mysqli_query($conn, $sql);
    	while ($row=mysqli_fetch_assoc($result))
    	{
      		$user_id=$row['user_id'];
      		$username=$row['username'];
      		$name=$row['fname'];
      		$lastname=$row['lname'];
      		$role_id=$row['role_id'];
  		}
  	}
}






?>