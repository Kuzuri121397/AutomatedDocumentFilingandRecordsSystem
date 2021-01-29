<?php
include'connection/connect.php';

if(isset($_POST['submit']))
{
	$recovery_code=$_POST['recover'];

	$hash=password_hash($recovery_code, PASSWORD_BCRYPT);

	$stmt=$conn->prepare("INSERT INTO t_administrator_code(administrator_code)VALUES(?)");
	$stmt->bind_param('s',$hash);
	$stmt->execute();
	

	//var_dump($hash);
	echo"<script>alert('saved');window.location.href='ambot.php'</script>";
}





?>