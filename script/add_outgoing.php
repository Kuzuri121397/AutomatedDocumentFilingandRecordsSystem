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
			$user_id=$row1['user_id'];
			$fname=$row1['fname'];
			$lname=$row1['lname'];

			if (isset($_POST['submit'])) 
			{
				$outgoing_sender=$_POST['outgoing_sender'];
				$outgoing_addressee=$_POST['outgoing_addressee'];
				$date_released=$_POST['date_released'];
				$outgoing_reference_number=$_POST['outgoing_reference_number'];
				$outgoing_remarks=$_POST['outgoing_remarks'];

					$file=$_FILES['file'];
					$filename = $_FILES['file']['name'];
					$filesize = $_FILES['file']['size'];
					$filetype = $_FILES['file']['type'];
					$fileError=$_FILES['file']['error'];
					$fileTmpName = $_FILES['file']['tmp_name'];

					if(!empty($fileTmpName))
					{
						$sql2="INSERT INTO t_outgoing(outgoing_sender, outgoing_addressee, date_released, outgoing_reference_number, outgoing_remarks)VALUES('".$outgoing_sender."', '".$outgoing_addressee."', '".$date_released."', '".$outgoing_reference_number."', '".$outgoing_remarks."')";
						mysqli_query($conn,$sql2);
						$outgoing_id=mysqli_insert_id($conn);

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

            									$insert="INSERT INTO t_files(outgoing_id, filename, filetype, filesize, filepath)VALUES('".$outgoing_id."','".$filename."','".$filetype."', '".$filesize."', '".$fileDestination."')";
            									mysqli_query($conn, $insert);
            									move_uploaded_file($fileTmpName, $fileDestination);
            									$file_id=mysqli_insert_id($conn);

 
													date_default_timezone_set("Asia/Kuala_Lumpur");
													$current_date=date('Y-m-d');
													$log_date=$current_date;
													$log_time=date("h:i:sa");
													$activity=$fname.' '.$lname.' added a new outgoing record with an attachment, sended to '.$outgoing_addressee.' released at '.$date_released;

													$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
													mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
													$log_id=mysqli_insert_id($conn);

													$sql3="INSERT INTO t_activity(activity,log_id, outgoing_id, file_id)VALUES('".$activity."','".$log_id."','".$outgoing_id."', '".$file_id."')";
													mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));



            									echo"<script>alert('Record Saved!'); window.location.href='../pages/outgoing.php?id=".$user_id."'</script>";
											}
											else
											{
												echo"<script>alert('The size is too large! Upload File!'); window.location.href='../pages/outgoing.php?id=".$user_id."'</script>";
											}
										}
										else
										{
											echo"<script>alert('There was an error in uploading the File!'); window.location.href='../pages/outgoing.php?id=".$user_id."'</script>";
										}
									}
									else
            						{
              							echo"<script>alert('Invalid File Type!'); window.location.href='../pages/outgoing.php?id=".$user_id."'</script>";
            						}
						
					}
					else
					{
						echo"<script>alert('Please upload a file!'); window.location.href='../pages/outgoing.php?id=".$user_id."'</script>";
					}
			}
		}
	}




?>