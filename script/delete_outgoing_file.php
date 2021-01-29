<?php
	session_start();
	include'../connection/connect.php';
	if (isset($_SESSION['user_id'])) 
	{
		$test=$_SESSION['user_id'];
		$sql1="SELECT user_id, fname, lname FROM t_user WHERE user_id='".$test."'";
		$result1=mysqli_query($conn,$sql1);
		while ($row1=mysqli_fetch_array($result1)) 
		{
			$fname=$row1['fname'];
			$lname=$row1['lname'];
			$user_id=$row1['user_id'];

			if (isset($_GET['file_delete'])) 
			{
				$file_id=$_GET['file_delete'];
				if(!empty($file_id))
				{
					$sql2="SELECT t_files.outgoing_id, t_files.file_id, t_files.filename, t_files.filepath, t_outgoing.outgoing_id, t_outgoing.outgoing_sender, t_outgoing.date_released, t_outgoing.outgoing_addressee FROM t_outgoing LEFT JOIN t_files ON t_files.outgoing_id = t_outgoing.outgoing_id WHERE file_id='".$file_id."'";
		  			$result2=mysqli_query($conn,$sql2);
		  			while ($row2=mysqli_fetch_array($result2)) 
		  			{
		  				$outgoing_id=$row2['outgoing_id'];
		  				$outgoing_sender=$row2['outgoing_sender'];
		  				$date_released=$row2['date_released'];
		  				$outgoing_addressee=$row2['outgoing_addressee'];
		  				$file_id=$row2['file_id'];
		  				$filename=$row2['filename'];
		  				$filepath=$row2['filepath'];

		  				date_default_timezone_set("Asia/Kuala_Lumpur");
						$current_date=date('Y-m-d');
						$log_date=$current_date;
						$log_time=date("h:i:sa");
						$activity=$fname.' '.$lname.' deleted the file of the outgoing communication record sended to '.$outgoing_addressee.' released at '.$date_released;

						$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
						mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
						$log_id=mysqli_insert_id($conn);

						$sql3="INSERT INTO t_activity(activity, log_id)VALUES('".$activity."','".$log_id."')";
						mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));


						echo $outgoing_id=$row2['outgoing_id'];
						echo $file_id=$row2['file_id'];
						echo $path=$row2['filepath'];
						unlink($path);
						$sql2="DELETE FROM t_files WHERE file_id='".$file_id."'";
						mysqli_query($conn, $sql2);
						header('Location:../pages/outgoing.php?id='.$user_id);
		  			}
				}
				else
				{
					echo"<script>alert('There is no File!'); window.location.href='../pages/outgoing.php?id=".$user_id."'</script>";
				}
			}
		}
	}


?>