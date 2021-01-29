<?php
session_start();
include'../connection/connect.php';
if(isset($_SESSION['user_id']))
{

	$user_id=$_SESSION['user_id'];
  $test="SELECT user_id, fname, lname FROM t_user WHERE user_id='".$user_id."'";
  $resultTest=mysqli_query($conn,$test);
  while($rowTest=mysqli_fetch_array($resultTest))
  {

    $fname=$rowTest['fname'];
    $lname=$rowTest['lname'];
	 if (isset($_POST['submit']))
	 {
        $user_id=$_POST['user_id'];
				$password=$_POST['password'];
        $new_password=$_POST['new_password'];
        $confirm_password=$_POST['confirm_password'];

        $encrypt_password=md5($new_password);

        if($_POST['new_password'] === $_POST['confirm_password'])
        {
          $sql="UPDATE t_user SET user_id='".$user_id."', password='".$encrypt_password."' WHERE user_id='".$user_id."'";
          mysqli_query($conn,$sql);

            date_default_timezone_set("Asia/Kuala_Lumpur");
            $current_date=date('Y-m-d');
            $log_date=$current_date;
            $log_time=date("h:i:sa");
            $activity=$fname.' '.$lname.' updated its own password';

          $sql6="INSERT INTO t_activity(activity)VALUES('".$activity."')";
            mysqli_query($conn,$sql6) or die("database error:". mysqli_error($conn));
            $activity_id=mysqli_insert_id($conn);

            $sql7="INSERT INTO t_logs(user_id, activity_id, log_date, log_time)VALUES('".$user_id."', '".$activity_id."', '".$log_date."', '".$log_time."')";
            mysqli_query($conn,$sql7) or die("database error:". mysqli_error($conn));

            echo"<script>alert('Updated Successfully!'); window.location.href='../script/logout.php'</script>";
        }
        else
        {
          echo"<script>alert('Updated failed!'); window.location.href='../pages/user_profile.php?id=".$user_id."'</script>";
	      }
    }
  }
}


?>