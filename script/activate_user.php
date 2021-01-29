<?php
session_start();
include'../connection/connect.php';
if (isset($_SESSION['user_id']))
{	
	$test=$_SESSION['user_id'];
	$sql="SELECT user_id, fname, lname FROM t_user WHERE user_id='".$test."'";
	$result=mysqli_query($conn,$sql);
	while ($row=mysqli_fetch_array($result)) 
	{
		
		$user=$row['user_id'];
		$fname=$row['fname'];
		$lname=$row['lname'];
		if (isset($_GET['inactive'])) 
		{
			$fetched_id=$_GET['inactive'];
			$sql2="SELECT user_id, fname, lname FROM t_user WHERE user_id='".$fetched_id."'";
			$result2=mysqli_query($conn, $sql2);
			while($row2=mysqli_fetch_array($result2))
			{	
				$selectedUser=$row2['user_id'];
				$selectedfname=$row2['fname'];
				$selectedlname=$row2['lname'];

				$sql1="UPDATE t_user SET user_id='".$selectedUser."', user_status_id='1' WHERE user_id='".$selectedUser."'";
				mysqli_query($conn,$sql1);


				date_default_timezone_set("Asia/Kuala_Lumpur");
				$current_date=date('Y-m-d');
				$log_date=$current_date;
				$log_time=date("h:i:sa");
				$activity=$fname.' '.$lname.' activated '.$selectedfname.' '.$selectedlname;

				$sql4="INSERT INTO t_logs(user_id,log_date, log_time)VALUES('".$user."', '".$log_date."', '".$log_time."')";
				mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
				$log_id=mysqli_insert_id($conn);

				$sql3="INSERT INTO t_activity(activity,log_id, user_id)VALUES('".$activity."','".$log_id."', '".$selectedUser."')";
				mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
				$activity_id=mysqli_insert_id($conn);


            	echo"<script>alert('The user is Activated!'); window.location.href='../pages/manage_users.php?id=".$user."'</script>";
        	}
		}
	}
}


?>