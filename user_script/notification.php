<?php
	session_start();
	include'../connection/connect.php';

	$sql="SELECT incoming_id, incoming_sender, incoming_remarks, scheduled_event FROM t_incoming WHERE scheduled_event BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 DAY ORDER BY scheduled_event ASC LIMIT 5";
	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);
	if($count > 0)
	{
		$output='';
		while ($row=mysqli_fetch_array($result)) 
		{
			echo"<div class='notification-item'>".
			"<li class='notification-sender'><strong>".$row['incoming_sender']."</strong></li>".
			"<li class='notification-remarks'>".$row['incoming_remarks']."</li>".
			"<li class='notification-deadline'>".$row['scheduled_event']."</li>"
			."</div>";

		}
			echo "<div><a href='../user/notification_list.php' style='color:black;'><center><b>See All</b></center></a></div>";
	}
	else
	{
		echo"<center>There are NO available notification(s)</center>";

		echo "<div><a href='../user/notification_list.php'><center><b>See All</b></center></a></div>";
	}
		

?>

<!--= DATE_ADD(CURDATE(), INTERVAL 1 DAY)-->