<?php
	session_start();
	include '../connection/connect.php';
	if(isset($_SESSION['user_id']))
	{
		$test=$_SESSION['user_id'];
		$sql1="SELECT * FROM t_user WHERE user_id='".$test."'";
		$result1=mysqli_query($conn,$sql1);
		while($row1=mysqli_fetch_array($result1)) 
		{
			$user_id=$row1['user_id'];
			$fname=$row1['fname'];
			$lname=$row1['lname'];

			if (isset($_POST['submit'])) 
			{
				$payee=mysqli_escape_string($conn, $_POST['payee']);
				$invoice_date=mysqli_escape_string($conn, $_POST['invoice_date']);
				$invoice_amount=mysqli_escape_string($conn, $_POST['invoice_amount']);
				$particulars=mysqli_escape_string($conn, $_POST['particulars']);

				$file=$_FILES['file'];

					$filename = $_FILES['file']['name'];
					$filesize = $_FILES['file']['size'];
					$filetype = $_FILES['file']['type'];
					$fileError=$_FILES['file']['error'];
					$fileTmpName = $_FILES['file']['tmp_name'];
					if(!empty($fileTmpName))
					{

						$sql2="INSERT INTO t_voucher_info(payee, invoice_date, invoice_amount, particulars)VALUES('".$payee."', '".$invoice_date."', '".$invoice_amount."', '".$particulars."')";
						mysqli_query($conn,$sql2);

						$voucher_id=mysqli_insert_id($conn);

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

            							$insert="INSERT INTO t_files(voucher_id, filename, filetype, filesize, filepath)VALUES('".$voucher_id."','".$filename."','".$filetype."', '".$filesize."', '".$fileDestination."')";
            							mysqli_query($conn, $insert);
            							move_uploaded_file($fileTmpName, $fileDestination);
            							$file_id=mysqli_insert_id($conn);

            							date_default_timezone_set("Asia/Kuala_Lumpur");
										$current_date=date('Y-m-d');
										$log_date=$current_date;
										$log_time=date("h:i:sa");
										$activity=$fname.' '.$lname.' added a new voucher record with an attachment, '.$payee.' invoice date at '.$invoice_date;

										$sql4="INSERT INTO t_logs(user_id,log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
										mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
										$log_id=mysqli_insert_id($conn);

										$sql3="INSERT INTO t_activity(activity,log_id,voucher_id, file_id)VALUES('".$activity."','".$log_id."','".$voucher_id."', '".$file_id."')";
										mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));


            							echo"<script>alert('Record Saved!'); window.location.href='../pages/voucher.php?id=".$user_id."'</script>";
									}
									else
									{
										echo"<script>alert('The size is too large! Upload File!'); window.location.href='../pages/voucher.php?id=".$user_id."'</script>";
									}
								}
								else
								{
									echo"<script>alert('There was an error in uploading the File!'); window.location.href='../pages/voucher.php?id=".$user_id."'</script>";
								}
							}
							else
            				{
              					echo"<script>alert('Invalid File Type!'); window.location.href='../pages/voucher.php?id=".$user_id."'</script>";
            				}
					}
					else
					{
						echo"<script>alert('Please Upload a file!'); window.location.href='../pages/voucher.php?id=".$user_id."'</script>";
					}#end of upload file
			}
			else
			{
				echo "<script>alert('Adding Record Failed!');window.location.href='../pages/bill.php?id=".$user_id."'</script>";
			}
		}
	}



?>