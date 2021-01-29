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

		if(isset($_POST['submit'])) 
		{
			$outgoing_id=$_POST['outgoing_id'];
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

					if (!empty($fileTmpName)) 
					{
							$checkFile="SELECT * FROM t_files WHERE outgoing_id='".$outgoing_id."'";
							$resultFile=mysqli_query($conn,$checkFile);
							$numFile=mysqli_num_rows($resultFile);
							if($numFile > 0)
							{
								echo"<script>alert('A file already exists!'); window.location.href='../pages/outgoing.php?id=".$user_id."'</script>";
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

            								$insert2="UPDATE t_files SET file_id='".$file_id."', outgoing_id='".$outgoing_id."' WHERE file_id='".$file_id."'";
            								mysqli_query($conn,$insert2);
            								move_uploaded_file($fileTmpName, $fileDestination);

            								$selectInfo="SELECT * FROM t_outgoing WHERE outgoing_id='".$outgoing_id."'";
            								$selectResult=mysqli_query($conn,$selectInfo);
            								while ($rowResult=mysqli_fetch_array($selectResult)) 
            								{

            									$outgoing_id=$rowResult['outgoing_id'];
												$outgoing_sender=$rowResult['outgoing_sender'];
												$outgoing_addressee=$rowResult['outgoing_addressee'];
												$date_released=$rowResult['date_released'];
												$outgoing_reference_number=$rowResult['outgoing_reference_number'];
												$outgoing_remarks=$rowResult['outgoing_remarks'];


            									date_default_timezone_set("Asia/Kuala_Lumpur");
												$current_date=date('Y-m-d');
												$log_date=$current_date;
												$log_time=date("h:i:sa");
												$activity=$fname.' '.$lname.' added a new file for outgoing communication record, sended to: '.$outgoing_addressee.' released at '.$date_released;

												$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
												mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
												$log_id=mysqli_insert_id($conn);

												$sql3="INSERT INTO t_activity(activity,log_id,outgoing_id, file_id)VALUES('".$activity."','".$log_id."','".$outgoing_id."', '".$file_id."')";
												mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));


            									echo"<script>alert('Updated Successfully!'); window.location.href='../pages/outgoing.php?id=".$user_id."'</script>";
            								}

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
					}
					else
					{
						date_default_timezone_set("Asia/Kuala_Lumpur");
						$current_date=date('Y-m-d');
						$log_date=$current_date;
						$log_time=date("h:i:sa");
						$activity=$fname.' '.$lname.' updated the information of outgoing communication record, Name of sender '.$outgoing_sender.' addressed to: '.$outgoing_addressee.', date released at '.$date_released;

						$sql5="UPDATE t_outgoing SET outgoing_id='".$outgoing_id."', outgoing_sender='".$outgoing_sender."', outgoing_addressee='".$outgoing_addressee."', date_released='".$date_released."', outgoing_reference_number='".$outgoing_reference_number."', outgoing_remarks='".$outgoing_remarks."' WHERE outgoing_id='".$outgoing_id."'";
						mysqli_query($conn,$sql5);

						$sql7="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
						mysqli_query($conn,$sql7) or die("database error:". mysqli_error($conn));
						$log_id=mysqli_insert_id($conn);

						$sql6="INSERT INTO t_activity(activity,log_id,outgoing_id)VALUES('".$activity."','".$log_id."','".$outgoing_id."')";
						mysqli_query($conn,$sql6) or die("database error:". mysqli_error($conn));


            			echo"<script>alert('Updated Successfully!'); window.location.href='../pages/outgoing.php?id=".$user_id."'</script>";
					}
		}
	}
}



?>