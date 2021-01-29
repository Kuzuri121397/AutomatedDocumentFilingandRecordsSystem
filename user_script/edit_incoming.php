<?php
	session_start();
	include'../connection/connect.php';
	if (isset($_SESSION['user_id'])) 
	{
		$user_id=$_SESSION['user_id'];
		$sql1="SELECT * FROM t_user WHERE user_id='".$user_id."'";
		$result1=mysqli_query($conn,$sql1);
		while ($row1=mysqli_fetch_array($result1)) 
		{
			$user_id=$row1['user_id'];
			$fname=$row1['fname'];
			$lname=$row1['lname'];

			if (isset($_POST['submit'])) 
			{
				$incoming_id=$_POST['incoming_id'];
				$incoming_sender=$_POST['incoming_sender'];
				$incoming_addressee=$_POST['incoming_addressee'];
				$date_received=$_POST['date_received'];
				$scheduled_event=$_POST['scheduled_event'];
				$incoming_reference_number=$_POST['incoming_reference_number'];
				$incoming_remarks=$_POST['incoming_remarks'];

					$file=$_FILES['file'];
					$filename = $_FILES['file']['name'];
					$filesize = $_FILES['file']['size'];
					$filetype = $_FILES['file']['type'];
					$fileError=$_FILES['file']['error'];
					$fileTmpName = $_FILES['file']['tmp_name'];

					if (!empty($fileTmpName)) 
					{
							$checkFile="SELECT * FROM t_files WHERE incoming_id='".$incoming_id."'";
							$resultFile=mysqli_query($conn,$checkFile);
							$numFile=mysqli_num_rows($resultFile);
							if($numFile > 0)
							{
								echo"<script>alert('A file already exists!'); window.location.href='../user/incoming.php?id=".$user_id."'</script>";
							}
							else
							{
								$folder="../system/files";
								$fileExt=explode('.', $filename);
								$fileActualExt=strtolower(end($fileExt));

								$allowed=array('pdf');

								if (in_array($fileActualExt, $allowed)) 
								{
									if ($fileError === 0) 
									{
										if($filesize < 1000000)
										{
											$filenameNew = uniqid('', true).".".$fileActualExt;
            								$fileDestination = '../system/files/'.$filenameNew;

            								$insert="INSERT INTO t_files(filename, filetype, filesize, filepath)VALUES('".$filename."','".$filetype."', '".$filesize."', '".$fileDestination."')";
            								mysqli_query($conn, $insert);
            								$file_id=mysqli_insert_id($conn);

            								$insert2="UPDATE t_files SET file_id='".$file_id."', incoming_id='".$incoming_id."' WHERE file_id='".$file_id."'";
            								mysqli_query($conn,$insert2);
            								move_uploaded_file($fileTmpName, $fileDestination);

            								$selectInfo="SELECT * FROM t_incoming WHERE incoming_id='".$incoming_id."'";
            								$selectResult=mysqli_query($conn,$selectInfo);
            								while ($rowResult=mysqli_fetch_array($selectResult)) 
            								{

            									$incoming_id=$rowResult['incoming_id'];
												$incoming_sender=$rowResult['incoming_sender'];
												$incoming_addressee=$rowResult['incoming_addressee'];
												$date_received=$rowResult['date_received'];
												$scheduled_event=$rowResult['scheduled_event'];
												$incoming_reference_number=$rowResult['incoming_reference_number'];
												$incoming_remarks=$rowResult['incoming_remarks'];


            									date_default_timezone_set("Asia/Kuala_Lumpur");
												$current_date=date('Y-m-d');
												$log_date=$current_date;
												$log_time=date("h:i:sa");
												$activity=$fname.' '.$lname.' added a new file for incoming communication record, '.$incoming_sender.' received date at '.$date_received;

												$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
												mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
												$log_id=mysqli_insert_id($conn);


												$sql3="INSERT INTO t_activity(activity,log_id,incoming_id, file_id)VALUES('".$activity."','".$log_id."','".$incoming_id."', '".$file_id."')";
												mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
												$activity_id=mysqli_insert_id($conn);


            									echo"<script>alert('Updated Successfully!'); window.location.href='../user/incoming.php?id=".$user_id."'</script>";
            								}

										}
										else
										{
											echo"<script>alert('The size is too large! Upload File!'); window.location.href='../user/incoming.php?id=".$user_id."'</script>";
										}
									}
									else
									{
										echo"<script>alert('There was an error in uploading the File!'); window.location.href='../user/incoming.php?id=".$user_id."'</script>";
									}
								}
								else
								{
									echo"<script>alert('Invalid File Type!'); window.location.href='../user/incoming.php?id=".$user_id."'</script>";
								}
							}
					}
					else
					{
						date_default_timezone_set("Asia/Kuala_Lumpur");
						$current_date=date('Y-m-d');
						$log_date=$current_date;
						$log_time=date("h:i:sa");
						$activity=$fname.' '.$lname.' updated the incoming communication record of '.$incoming_sender.' received at: '.$date_received;

						$sql5="UPDATE t_incoming SET incoming_id='".$incoming_id."', incoming_sender='".$incoming_sender."', incoming_addressee='".$incoming_addressee."', date_received='".$date_received."', scheduled_event='".$scheduled_event."', incoming_reference_number='".$incoming_reference_number."', incoming_remarks='".$incoming_remarks."' WHERE incoming_id='".$incoming_id."'";
						mysqli_query($conn,$sql5);

						$sql7="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
						mysqli_query($conn,$sql7) or die("database error:". mysqli_error($conn));
						$log_id=mysqli_insert_id($conn);

						$sql6="INSERT INTO t_activity(activity,log_id,incoming_id)VALUES('".$activity."','".$log_id."','".$incoming_id."')";
						mysqli_query($conn,$sql6) or die("database error:". mysqli_error($conn));
						$activity_id=mysqli_insert_id($conn);


            			echo"<script>alert('Updated Successfully!'); window.location.href='../user/incoming.php?id=".$user_id."'</script>";
					}
			}		
		}
	}



?>