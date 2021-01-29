<?php
include'../connection/connect.php';
if(isset($_POST['submit']))
{
	$user_id=$_POST['user_id'];
	$password=mysqli_escape_string($conn, $_POST['password']);
	$confirm=mysqli_escape_string($conn, $_POST['confirm']);

	$new_password=md5($password);

	if($_POST['password'] === $_POST['confirm'])
	{
		$sql2="UPDATE t_user SET password=? WHERE user_id=?";
  		$stmt=$conn->prepare($sql2);
  		$stmt->bind_param('si', $new_password, $user_id);
  		$stmt->execute();

        echo"<script>alert('Updated Successfully!'); window.location.href='../pages/change_password.php?id=".$user_id."'</script>";
	}
	else
	{
		echo"<script>alert('Passwords did not Match!'); window.location.href='../pages/change_password.php?id=".$user_id."'</script>";
	}
}

?>