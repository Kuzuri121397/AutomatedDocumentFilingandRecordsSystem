<?php
session_start();
include '../connection/connect.php';
if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];

	$username = stripcslashes($username);
	$password = stripcslashes($password);
	$encrypt_password=md5($password);

	if(empty($username) || empty($password))
	{
		echo "<script>alert('Empty Fields are not allowed');window.location.href='../pages/login.php'</script>";
	}
	else
	{
		$encrypt_password=md5($password);

		$sql1="SELECT user_id, username, password, fname, lname, role_id, user_status_id FROM t_user WHERE username='".$username."' AND password='".$encrypt_password."'";
		$result1=mysqli_query($conn, $sql1);
		$row1=mysqli_num_rows($result1);

		if ($row1 > 0) 
		{

			while ($row1=mysqli_fetch_array($result1)) 
			{
				$username=$row1['username'];
				$encrypt_password=$row1['password'];
				$user_id=$row1['user_id'];
				$role_id=$row1['role_id'];
				$user_status_id=$row1['user_status_id'];
				$fname=$row1['fname'];
				$lname=$row1['lname'];

				if($user_status_id == 2)
				{
					echo "<script>alert('Sorry, the account is deactivated');window.location.href='../pages/login.php'</script>";
				}
				else
				{
					$_SESSION['user_id']=$user_id;
					date_default_timezone_set("Asia/Kuala_Lumpur");
					$current_date=date('Y-m-d');
					$log_date=$current_date;
					$log_time=date("h:i:sa");
					$activity=$fname.' '.$lname." just Logged in ";

					$sql3="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
					mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
					$log_id=mysqli_insert_id($conn);

					$sql2="INSERT INTO t_activity(activity,log_id,user_id) VALUES('".$activity."','".$log_id."','".$user_id."')";
					mysqli_query($conn,$sql2) or die("database error:". mysqli_error($conn));


					if($role_id == 1)
					{
						echo "<script type='text/javascript'>window.location.href='../pages/dashboard.php?user_id=".$user_id."'</script>";
						
						
					}
					elseif ($role_id == 2) 
					{
						echo "<script type='text/javascript'>window.location.href='../pages/home_user.php?user_id=".$user_id."'</script>";
								exit();
					}
				}

			}
		}
		else
		{
			echo "<script>alert('No such record found');window.location.href='../pages/login.php'</script>";
		}
	}
}


?>

