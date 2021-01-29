<?php
	session_start();
	include'../connection/connect.php';
	if (isset($_SESSION['user_id']))
	{
		$user_id=$_SESSION['user_id'];
		$sql1="SELECT user_id, fname, lname FROM t_user WHERE user_id='".$user_id."'";
		$result1=mysqli_query($conn,$sql1);
		while ($row1=mysqli_fetch_array($result1)) 
		{
			$user_id=$row1['user_id'];
			$fname=$row1['fname'];
			$lname=$row1['lname'];

			if (isset($_GET['file_delete'])) 
			{
				$file_id=$_GET['file_delete'];
				if (!empty($file_id)) 
				{
					$sql2="SELECT t_files.incoming_id, t_files.file_id, t_files.filename, t_files.filepath, t_incoming.incoming_id, t_incoming.incoming_sender, t_incoming.date_received FROM t_incoming LEFT JOIN t_files ON t_files.incoming_id = t_incoming.incoming_id WHERE file_id='".$file_id."'";
		  			$result2=mysqli_query($conn,$sql2);
		  			while ($row2=mysqli_fetch_array($result2)) 
		  			{
		  				$file_id=$row2['file_id'];
		  				$incoming_id=$row2['incoming_id'];
		  				$incoming_sender=$row2['incoming_sender'];
		  				$date_received=$row2['date_received'];
		  				$filename=$row2['filename'];
		  				$filepath=$row2['filepath'];

		  				date_default_timezone_set("Asia/Kuala_Lumpur");
						$current_date=date('Y-m-d');
						$log_date=$current_date;
						$log_time=date("h:i:sa");
						$activity=$fname.' '.$lname.' deleted the file of incoming communication record, Name of sender: '.$incoming_sender.' received at '.$date_received.' with a filename of '.$filename;

						$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
						mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
						$log_id=mysqli_insert_id($conn);

						
						$sql3="INSERT INTO t_activity(activity, log_id)VALUES('".$activity."', '".$log_id."')";
						mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));


						echo $incoming_id=$row2['incoming_id'];
						echo $file_id=$row2['file_id'];
						echo $path=$row2['filepath'];
						unlink($path);
						$sql2="DELETE FROM t_files WHERE file_id='".$file_id."'";
						mysqli_query($conn, $sql2);
						header('Location:../pages/incoming.php?id='.$user_id);


		  			}
				}
				else
				{
					echo"<script>alert('There is no File!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
				}
			}
		}
	}



?>