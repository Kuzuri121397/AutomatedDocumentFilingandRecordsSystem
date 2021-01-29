<?php
	session_start();
	include'../connection/connect.php';
	if (isset($_SESSION['user_id'])) 
	{
		$test=$_SESSION['user_id'];
		$sql1="SELECT user_id, fname, lname FROM t_user WHERE user_id='".$test."'";
		$result1=mysqli_query($conn,$sql1);
		while($row1=mysqli_fetch_array($result1))
		{
			$user_id=$row1['user_id'];
			$fname=$row1['fname'];
			$lname=$row1['lname'];

			if (isset($_POST['submit'])) 
			{
				$sender=$_POST['incoming_sender'];
				$addressee=$_POST['incoming_addressee'];
				$date_received=$_POST['date_received'];
				$scheduled_event=$_POST['scheduled_event'];
				$reference_number=$_POST['incoming_reference_number'];
				$remarks=$_POST['incoming_remarks'];


					$file=$_FILES['file'];
					$filename = $_FILES['file']['name'];
					$filesize = $_FILES['file']['size'];
					$filetype = $_FILES['file']['type'];
					$fileError=$_FILES['file']['error'];
					$fileTmpName = $_FILES['file']['tmp_name'];


				if(!empty($scheduled_event))
				{

					if(!empty($fileTmpName))
					{
							$folder="../system/files/";
							$fileExt=explode('.',$filename);
            				$fileActualExt=strtolower(end($fileExt));

            				$allowed=array('pdf');

            				if(in_array($fileActualExt,$allowed))
            				{
            					if($fileError === 0)
            					{
            						if($filesize < 1000000)
                					{
										$filenameNew = uniqid('', true).".".$fileActualExt;
            							$fileDestination = '../system/files/'.$filenameNew;

										$sql2="INSERT INTO t_incoming(incoming_sender, incoming_addressee, date_received, scheduled_event, incoming_reference_number, incoming_remarks)VALUES('".$sender."', '".$addressee."', '".$date_received."', '".$scheduled_event."', '".$reference_number."', '".$remarks."')";
										mysqli_query($conn,$sql2);
										$incoming_id=mysqli_insert_id($conn);

            							$insert="INSERT INTO t_files(incoming_id, filename, filetype, filesize, filepath)VALUES('".$incoming_id."','".$filename."','".$filetype."', '".$filesize."', '".$fileDestination."')";
            							mysqli_query($conn, $insert);
            							move_uploaded_file($fileTmpName, $fileDestination);
            							$file_id=mysqli_insert_id($conn);


            							date_default_timezone_set("Asia/Kuala_Lumpur");
										$current_date=date('Y-m-d');
										$log_date=$current_date;
										$log_time=date("h:i:sa");
										$activity=$fname.' '.$lname.' added a new incoming record with an attachment, Sender: '.$sender.' date received: '.$date_received;

										$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
										mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
										$log_id=mysqli_insert_id($conn);

										$sql3="INSERT INTO t_activity(activity,log_id, incoming_id, file_id)VALUES('".$activity."','".$log_id."', '".$incoming_id."', '".$file_id."')";
										mysqli_query($conn,$sql3);


            							echo"<script>alert('Record Saved!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
									}
									else
									{
										echo"<script>alert('The size is too large! Upload File!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
									}
								}
								else
								{
									echo"<script>alert('There was an error in uploading the File!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
								}
							}
							else
            				{
              					echo"<script>alert('Invalid File Type!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
            				}
					}
					else
					{

						echo"<script>alert('Please Upload a file!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
					}

				}
				else
				{
					
					if(!empty($fileTmpName))
					{
							$folder="../system/files/";
							$fileExt=explode('.',$filename);
            				$fileActualExt=strtolower(end($fileExt));

            				$allowed=array('pdf');

            				if(in_array($fileActualExt,$allowed))
            				{
            					if($fileError === 0)
            					{
            						if($filesize < 1000000)
                					{
										$filenameNew = uniqid('', true).".".$fileActualExt;
            							$fileDestination = '../system/files/'.$filenameNew;

										$sql2="INSERT INTO t_incoming(incoming_sender, incoming_addressee, date_received, incoming_reference_number, incoming_remarks)VALUES('".$sender."', '".$addressee."', '".$date_received."', '".$reference_number."', '".$remarks."')";
										mysqli_query($conn,$sql2);
										$incoming_id=mysqli_insert_id($conn);

            							$insert="INSERT INTO t_files(incoming_id, filename, filetype, filesize, filepath)VALUES('".$incoming_id."','".$filename."','".$filetype."', '".$filesize."', '".$fileDestination."')";
            							mysqli_query($conn, $insert);
            							move_uploaded_file($fileTmpName, $fileDestination);
            							$file_id=mysqli_insert_id($conn);


            							date_default_timezone_set("Asia/Kuala_Lumpur");
										$current_date=date('Y-m-d');
										$log_date=$current_date;
										$log_time=date("h:i:sa");
										$activity=$fname.' '.$lname.' added a new incoming record with an attachment, Sender: '.$sender.' received: '.$date_received;

										$sql4="INSERT INTO t_logs(user_id, activity_id, log_date, log_time)VALUES('".$user_id."', '".$activity_id."', '".$log_date."', '".$log_time."')";
										mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
										$log_id=mysqli_insert_id($conn);

										$sql3="INSERT INTO t_activity(activity, log_id, incoming_id, file_id)VALUES('".$activity."','".$log_id."', '".$incoming_id."', '".$file_id."')";
										mysqli_query($conn,$sql3);


            							echo"<script>alert('Record Saved!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
									}
									else
									{
										echo"<script>alert('The size is too large! Upload File!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
									}
								}
								else
								{
									echo"<script>alert('There was an error in uploading the File!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
								}
							}
							else
            				{
              					echo"<script>alert('Invalid File Type!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
            				}
					}
					else
					{

						echo"<script>alert('Please Upload a file!'); window.location.href='../pages/incoming.php?id=".$user_id."'</script>";
					}
				}	
			}#end of isset($_POST['submit'])
		}#end of fetching user_id fname and lname
	}

?>