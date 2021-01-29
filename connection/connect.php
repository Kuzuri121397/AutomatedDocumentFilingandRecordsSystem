<?php
$dbhost='localhost';
	$dbusername='root';
	$dbpassword='';
	$dbname='adfrs';

	//create connection
	$conn=mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

	//check the connection
	if (!$conn) {
		die("Connection Failed:" . mysqli_connect_error());
	}



?>