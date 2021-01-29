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
			$fname=$row1['fname'];
			$lname=$row1['lname'];
			$user_id=$row1['user_id'];

			if (isset($_POST['submit'])) 
			{

				date_default_timezone_set("Asia/Kuala_Lumpur");
				$current_date=date('Y-m-d');
				$log_date=$current_date;
				$log_time=date("h:i:sa");


				$voucher_id=$_POST['voucher_id'];
				$payee=$_POST['payee'];
				$invoice_date=$_POST['invoice_date'];
				$invoice_amount=$_POST['invoice_amount'];
				$particulars=$_POST['particulars'];

						$file=$_FILES['file_upload'];
						$filename = $_FILES['file_upload']['name'];
						$filesize = $_FILES['file_upload']['size'];
						$filetype = $_FILES['file_upload']['type'];
						$fileError= $_FILES['file_upload']['error'];
						$fileTmpName = $_FILES['file_upload']['tmp_name'];

						if(!empty($fileTmpName)) 
						{
							$checkFile="SELECT * FROM t_files WHERE voucher_id='".$voucher_id."'";
							$resultFile=mysqli_query($conn,$checkFile);
							$numFile=mysqli_num_rows($resultFile);
							if($numFile > 0)
							{
								echo"<script>alert('A file already exists!'); window.location.href='../user/voucher.php?id=".$user_id."'</script>";
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

            								$insert2="UPDATE t_files SET file_id='".$file_id."', voucher_id='".$voucher_id."' WHERE file_id='".$file_id."'";
            								mysqli_query($conn,$insert2);
            								move_uploaded_file($fileTmpName, $fileDestination);

            									echo"<script>alert('Updated Successfully!'); window.location.href='../user/voucher.php?id=".$user_id."'</script>";

            								$selectInfo="SELECT * FROM t_voucher_info WHERE voucher_id='".$voucher_id."'";
            								$selectResult=mysqli_query($conn,$selectInfo);
            								while ($rowResult=mysqli_fetch_array($selectResult)) 
            								{
            									$voucher_id=$rowResult['voucher_id'];
            									$payee=$rowResult['payee'];
            									$invoice_date=$rowResult['invoice_date'];
            									$invoice_amount=$rowResult['invoice_amount'];
            									$particulars=$rowResult['particulars'];

            									date_default_timezone_set("Asia/Kuala_Lumpur");
												$current_date=date('Y-m-d');
												$log_date=$current_date;
												$log_time=date("h:i:sa");
												$activity=$fname.' '.$lname.' added a new file for voucher record, '.$payee.' invoiced date at '.$invoice_date;

												$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
												mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
												$log_id=mysqli_insert_id($conn);

												$sql3="INSERT INTO t_activity(activity,log_id, voucher_id, file_id)VALUES('".$activity."','".$log_id."','".$voucher_id."', '".$file_id."')";
												mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
												$activity_id=mysqli_insert_id($conn);


            								}

										}
										else
										{
											echo"<script>alert('The size is too large! Upload File!'); window.location.href='../user/voucher.php?id=".$user_id."'</script>";
										}
									}
									else
									{
										echo"<script>alert('There was an error in uploading the File!'); window.location.href='../user/voucher.php?id=".$user_id."'</script>";
									}
								}
								else
								{
									echo"<script>alert('Invalid File Type!'); window.location.href='../user/voucher.php?id=".$user_id."'</script>";
								}

							}
						}
						 else
						{
							

								$activity=$fname.' '.$lname.' updated the details of voucher record, '.$payee.' invoiced date at '.$invoice_date;

								$sql="UPDATE t_voucher_info SET voucher_id='".$voucher_id."', payee='".$payee."', invoice_date='".$invoice_date."', invoice_amount='".$invoice_amount."', particulars='".$particulars."' WHERE voucher_id='".$voucher_id."'";
								mysqli_query($conn,$sql) or die("database error:". mysqli_error($conn));

								$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
								mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
								$log_id=mysqli_insert_id($conn);

								$sql8="INSERT INTO t_activity(activity,log_id,voucher_id)VALUES('".$activity."','".$log_id."','".$voucher_id."')";
								mysqli_query($conn,$sql8) or die("database error:". mysqli_error($conn));
								$activity_id=mysqli_insert_id($conn);


								echo"<script>alert('Updated Successfully!'); window.location.href='../user/voucher.php?id=".$user_id."'</script>";
						}

			}#end of isset$($_POST['submit'])
		}
	}






?>