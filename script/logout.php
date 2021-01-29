<?php
session_start();
include'../connection/connect.php';

if(isset($_SESSION['user_id']))
{

	$sql="SELECT * FROM t_user WHERE user_id='".$_SESSION['user_id']."'";
	$result=mysqli_query($conn, $sql);
	$row=mysqli_num_rows($result);
	if($row > 0)
	{
		while($row=mysqli_fetch_assoc($result))
		{

			$user_id=$row['user_id'];
			$fname=$row['fname'];
			$lname=$row['lname'];

			date_default_timezone_set("Asia/Kuala_Lumpur");
				$current_date=date('Y-m-d');
				$log_date=$current_date;
				$log_time=date("h:i:sa");
				$activity=$fname.' '.$lname." has logged out";

				$sql2="INSERT INTO t_logs(user_id, log_date, log_time) VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
				$sql2=mysqli_query($conn,$sql2);
				$log_id=mysqli_insert_id($conn);
				
				$sql3="INSERT INTO t_activity(activity,log_id,user_id)VALUES('".$activity."','".$log_id."','".$user_id."')";
				mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));


						$user_id=$row['user_id'];
						$_SESSION["username"] = "";
						$_SESSION["password"] = "";
						session_destroy();
			header('Location:../pages/login.php');
		}
	}
}

?>
