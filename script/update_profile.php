<?php
session_start();
include'../connection/connect.php';
if (isset($_SESSION['user_id'])) 
{
	$user_id=$_SESSION['user_id'];
		if (isset($_POST['submit'])) 
		{
			$user_id=$_POST['user_id'];
			$username=$_POST['username'];
			$fname=$_POST['fname'];
			$mname=$_POST['mname'];
			$lname=$_POST['lname'];
			$office_position=$_POST['office_position'];

						date_default_timezone_set("Asia/Kuala_Lumpur");
						$current_date=date('Y-m-d');
						$log_date=$current_date;
						$log_time=date("h:i:sa");
						$activity=$fname.' '.$lname.' updated its profile information';

						$sql5="UPDATE t_user SET user_id='".$user_id."', username='".$username."', fname='".$fname."', mname='".$mname."', lname='".$lname."', office_position='".$office_position."' WHERE user_id='".$user_id."'";
						mysqli_query($conn,$sql5);

						$sql7="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
						mysqli_query($conn,$sql7) or die("database error:". mysqli_error($conn));
						$log_id=mysqli_insert_id($conn);

						$sql6="INSERT INTO t_activity(activity,log_id,user_id)VALUES('".$activity."','".$log_id."','".$user_id."')";
						mysqli_query($conn,$sql6) or die("database error:". mysqli_error($conn));


            			echo"<script>alert('Updated Successfully!'); window.location.href='../pages/profile_information.php?id=".$user_id."'</script>";
		}
}




?>