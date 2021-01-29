<?php
	session_start();
	include'../connection/connect.php';
	if (isset($_SESSION['user_id'])) 
	{
		$user_id=$_SESSION['user_id'];

		date_default_timezone_set("Asia/Kuala_Lumpur");
		$current_date=date('Y-m-d');
		$log_date=$current_date;
		$log_time=date("h:i:sa");


		$sql1="SELECT user_id, fname, lname FROM t_user WHERE user_id='".$user_id."'";
		$result1=mysqli_query($conn,$sql1)or die("database error:". mysqli_error($conn));
		while($row1=mysqli_fetch_array($result1))
		{
			$user_id=$row1['user_id'];
			$fname=$row1['fname'];
			$lname=$row1['lname'];

			if (isset($_GET['delete'])) 
			{
				$incoming_id=$_GET['delete'];
				$sql2="SELECT incoming_id, filename, filepath FROM t_files WHERE incoming_id='".$incoming_id."'";
				$result=mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));
				$row2=mysqli_num_rows($result);
				if ($row2 > 0) 
				{
					$sql3="SELECT file_id, incoming_id, filename, filepath FROM t_files WHERE incoming_id='".$incoming_id."'";
					$result3=mysqli_query($conn,$sql3);
					while ($row3=mysqli_fetch_array($result3)) 
					{
						$incoming_id=$row3['incoming_id'];
						$filename=$row3['filename'];
						$filepath=$row3['filepath'];
						$file_id=$row3['file_id'];

						$sql4="SELECT incoming_id, incoming_sender, date_received FROM t_incoming WHERE incoming_id='".$incoming_id."'";
						$result4=mysqli_query($conn,$sql4)or die("database error:". mysqli_error($conn));
						while ($row4=mysqli_fetch_array($result4)) 
						{
							$incoming_id=$row4['incoming_id'];
							$sender=$row4['incoming_sender'];
							$date_received=$row4['date_received'];

							$activity=$fname.' '.$lname.' deleted the incoming communication record, name of the Sender: '.$sender.' received at '.$date_received.' along with the attachment with a filename of '.$filename;

							$sql6="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql6) or die("database error:". mysqli_error($conn));
							$log_id=mysqli_insert_id($conn);

							$sql5="INSERT INTO t_activity(activity,log_id)VALUES('".$activity."','".$log_id."')";
							mysqli_query($conn,$sql5) or die("database error:". mysqli_error($conn));


							$incoming_id=$row3['incoming_id'];
							$filepath=$row3['filepath'];
							unlink($filepath);
							$sql7="DELETE FROM t_incoming WHERE incoming_id='".$incoming_id."'";"DELETE FROM t_files WHERE incoming_id='".$incoming_id."'";
							mysqli_query($conn,$sql7)or die("database error:". mysqli_error($conn));

							echo"<script>alert('Successfully deleted!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";

						}
					}
					
				}
				else
				{
					$sql4="SELECT incoming_id, incoming_sender, date_received FROM t_incoming WHERE incoming_id='".$incoming_id."'";
						$result4=mysqli_query($conn,$sql4)or die("database error:". mysqli_error($conn));
						while ($row4=mysqli_fetch_array($result4)) 
						{
							$incoming_id=$row4['incoming_id'];
							$sender=$row4['incoming_sender'];
							$date_received=$row4['date_received'];

							$activity=$fname.' '.$lname.' deleted the incoming communication record, Name of the Sender '.$sender.' received at '.$date_received;

							$sql5="INSERT INTO t_activity(activity)VALUES('".$activity."')";
							mysqli_query($conn,$sql5) or die("database error:". mysqli_error($conn));
							$activity_id=mysqli_insert_id($conn);

							$sql6="INSERT INTO t_logs(user_id, activity_id, log_date, log_time)VALUES('".$user_id."', '".$activity_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql6) or die("database error:". mysqli_error($conn));

							$incoming_id=$row4['incoming_id'];
							$sql7="DELETE FROM t_incoming WHERE incoming_id='".$incoming_id."'";
							mysqli_query($conn,$sql7)or die("database error:". mysqli_error($conn));

							echo"<script>alert('Successfully deleted!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";

						}
				}
			}
		}
	}



?>