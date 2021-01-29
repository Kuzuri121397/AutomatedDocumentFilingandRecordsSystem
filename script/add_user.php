<?php
session_start();
    include'../connection/connect.php';
if(isset($_SESSION['user_id']))
{
  $user_id=$_SESSION['user_id'];
  $sql1="SELECT user_id, fname, lname FROM t_user WHERE user_id='".$user_id."'";
  $result=mysqli_query($conn,$sql1);
  while($row1=mysqli_fetch_array($result))
  {
      $name=$row1['fname'];
      $last=$row1['lname'];
      $user_id=$row1['user_id'];
      $activity=$name.' '.$last;
      if (isset($_POST['submit'])) 
      {
          $fname=$_POST['fname'];
          $mname=$_POST['mname'];
          $lname=$_POST['lname'];
          $office_position=$_POST['office_position'];
          $role_id=$_POST['role_id'];
          $user_status_id=$_POST['user_status_id'];
          $username=$_POST['username'];
          $password=$_POST['password'];
          $confirm=$_POST['confirm'];

              $encrypt_password=md5($password);

          if($_POST['confirm'] === $_POST['password'])
          {

            
            $sql1="INSERT INTO t_user(username, password, fname, mname, lname, office_position, role_id, user_status_id)VALUES('".$username."', '".$encrypt_password."', '".$fname."', '".$mname."', '".$lname."', '".$office_position."', '".$role_id."', '".$user_status_id."')";
            mysqli_query($conn,$sql1)or die("database error:". mysqli_error($conn));
            $new_user=mysqli_insert_id($conn);

            date_default_timezone_set("Asia/Kuala_Lumpur");
            $current_date=date('Y-m-d');
            $log_date=$current_date;
            $log_time=date("h:i:sa");
            $activity2=$activity.' added a new User, '.$fname.' '.$lname;

            $sql3="INSERT INTO t_activity(activity,user_id)VALUES('".$activity2."','".$user_id."')";
            mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
            $activity_id=mysqli_insert_id($conn);

            $sql4="INSERT INTO t_logs(user_id, activity_id, log_date, log_time)VALUES('".$user_id."', '".$activity_id."', '".$log_date."', '".$log_time."')";
            mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));

            echo"<script>alert('Record Saved!'); window.location.href='../pages/manage_users.php?id=".$user_id."'</script>";
          }
          else
          {
            echo"<script>alert('Password does not match!'); window.location.href='../pages/manage_users.php?id=".$user_id."'</script>";
          }
      }
  }
}

?>