<?php
session_start();
include'../connection/connect.php';
if (isset($_SESSION['user_id'])) 
{
	$test=$_SESSION['user_id'];
	$sql1="SELECT user_id, fname, lname FROM t_user WHERE user_id='".$test."'";
	$result=mysqli_query($conn,$sql1) or die("database error:". mysqli_error($conn));
	while ($row1=mysqli_fetch_array($result)) 
	{
		$user_id=$row1['user_id'];
		$fname=$row1['fname'];
		$lname=$row1['lname'];

				if(isset($_POST['submit']))
				{
					$user_info_id=$_POST['user_id'];
					$firstname=$_POST['fname'];
					$middlename=$_POST['mname'];
					$lastname=$_POST['lname'];
					$username=$_POST['username'];
					$office_position=$_POST['office_position'];
					$role_id=isset($_POST['role_id'])?$_POST['role_id']:"";


					if($role_id == 2)
					{
						$selectOldData="SELECT fname, lname, user_id FROM t_user WHERE user_id='".$user_info_id."'";
						$oldResult=mysqli_query($conn,$selectOldData);
						while ($oldRow=mysqli_fetch_array($oldResult))
						{
							$oldFname=$oldRow['fname'];
							$oldLname=$oldRow['lname'];

							date_default_timezone_set("Asia/Kuala_Lumpur");
							$current_date=date('Y-m-d');
							$log_date=$current_date;
							$log_time=date("h:i:sa");
							$activity=$fname.' '.$lname.' updated the access level of '.$oldFname.' '.$oldLname.' to ';

							$sql2="UPDATE t_user SET user_id='".$user_info_id."', fname='".$firstname."', mname='".$middlename."', lname='".$lastname."', username='".$username."', office_position='".$office_position."', role_id='".$role_id."' WHERE user_id='".$user_info_id."'";
							mysqli_query($conn,$sql2);

							if ($role_id == 2) 
							{
								$role='User';
							}
							elseif($role_id == 1)
							{
								$role='Administrator';
							}

							

							$activity2=$activity.' '.$role;

							$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
							$log_id=mysqli_insert_id($conn);
							
							$sql3="INSERT INTO t_activity(activity,log_id, user_id)VALUES('".$activity2."','".$log_id."','".$user_info_id."')";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));


							echo"<script>alert('Updated Successfully!'); window.location.href='../pages/manage_users.php?id=".$user_id."'</script>";
						}
					}
					elseif ($role_id == 1) 
					{
						$selectOldData="SELECT fname, lname, user_id FROM t_user WHERE user_id='".$user_info_id."'";
						$oldResult=mysqli_query($conn,$selectOldData);
						while ($oldRow=mysqli_fetch_array($oldResult))
						{
							$oldFname=$oldRow['fname'];
							$oldLname=$oldRow['lname'];

							date_default_timezone_set("Asia/Kuala_Lumpur");
							$current_date=date('Y-m-d');
							$log_date=$current_date;
							$log_time=date("h:i:sa");
							$activity=$fname.' '.$lname.' updated the access level of '.$oldFname.' '.$oldLname.' to ';

							$sql2="UPDATE t_user SET user_id='".$user_info_id."', fname='".$firstname."', mname='".$middlename."', lname='".$lastname."', username='".$username."', office_position='".$office_position."', role_id='".$role_id."' WHERE user_id='".$user_info_id."'";
							mysqli_query($conn,$sql2);

							if ($role_id == 2) 
							{
								$role='User';
							}
							elseif($role_id == 1)
							{
								$role='Administrator';
							}

							$activity2=$activity.' '.$role;

							$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."','".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
							$log_id=mysqli_insert_id($conn);
							
							$sql3="INSERT INTO t_activity(activity,log_id, user_id)VALUES('".$activity2."','".$log_id."','".$user_info_id."')";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));


							echo"<script>alert('Updated Successfully!'); window.location.href='../pages/manage_users.php?id=".$user_id."'</script>";
						}
					}
					else
					{
						$selectOldData="SELECT fname, lname, user_id FROM t_user WHERE user_id='".$user_info_id."'";
						$oldResult=mysqli_query($conn,$selectOldData);
						while ($oldRow=mysqli_fetch_array($oldResult))
						{
							$oldFname=$oldRow['fname'];
							$oldLname=$oldRow['lname'];

							date_default_timezone_set("Asia/Kuala_Lumpur");
							$current_date=date('Y-m-d');
							$log_date=$current_date;
							$log_time=date("h:i:sa");
							$activity=$fname.' '.$lname.' updated the Information of '.$oldFname.' '.$oldLname;

							$sql2="UPDATE t_user SET user_id='".$user_info_id."', fname='".$firstname."', mname='".$middlename."', lname='".$lastname."', username='".$username."', office_position='".$office_position."' WHERE user_id='".$user_info_id."'";
							mysqli_query($conn,$sql2);

							$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
							$log_id=mysqli_insert_id($conn);

							$sql3="INSERT INTO t_activity(activity,log_id, user_id)VALUES('".$activity."','".$log_id."','".$user_info_id."')";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));


							echo"<script>alert('Updated Successfully!'); window.location.href='../pages/manage_users.php?id=".$user_id."'</script>";
						}
					}
				}
				
	}	
}



?>