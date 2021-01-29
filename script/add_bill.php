<?php
	session_start();
	include '../connection/connect.php';

	if(isset($_SESSION['user_id']))
	{

		$test=$_SESSION['user_id'];
		$sql1="SELECT user_id, fname, lname FROM t_user WHERE user_id ='".$test."'";
		$result1=mysqli_query($conn,$sql1);
		while($row1=mysqli_fetch_array($result1))
		{

			$user_id=$row1['user_id'];
			$fname=$row1['fname'];
			$lname=$row1['lname'];
			$status_id='';

			if (isset($_POST['submit'])) 
			{

				$payee=$_POST['payee'];
				$bill_month=$_POST['bill_month'];
				$bill_year=$_POST['bill_year'];
				$date_receive=$_POST['date_receive'];
				$bill_amount=$_POST['bill_amount'];
				$due_date=$_POST['due_date'];
				$receipt_no=isset($_POST['receipt_no'])?$_POST['receipt_no']:"";
				$status=isset($_POST['status'])?$_POST['status']:"";
					$file=$_FILES['file'];
					$filename = $_FILES['file']['name'];
					$filesize = $_FILES['file']['size'];
					$filetype = $_FILES['file']['type'];
					$fileError=$_FILES['file']['error'];
					$fileTmpName = $_FILES['file']['tmp_name'];
			
					if(!empty($fileTmpName))
						{	
							
							$sql2="SELECT payee, bill_month, bill_year FROM t_bill_info WHERE payee='".$payee."' AND bill_month='".$bill_month."' AND bill_year='".$bill_year."'";
							$result2=mysqli_query($conn, $sql2);
							if(mysqli_num_rows($result2) > 0)
							{
								echo"<script>alert('Record Already Exist!'); window.location.href='../pages/bill.php?id=".$user_id."'</script>";
							}
							else
							{
									if($_POST['status'] === 'Paid')
									{
										$status_id=$_POST['status'] = 1;
									}
									else if($_POST['status'] === 'Unpaid')
									{
										$status_id=$_POST['status'] = 2;
									}


								$sql2="INSERT INTO t_bill_info(payee, bill_month, bill_year,date_receive, bill_amount, due_date, receipt_no,status_id)VALUES('".$payee."', '".$bill_month."', '".$bill_year."', '".$date_receive."', '".$bill_amount."', '".$due_date."', '".$receipt_no."', '".$status_id."')";
							mysqli_query($conn,$sql2);
							$bill_id=mysqli_insert_id($conn);

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

            									$insert="INSERT INTO t_files(bill_id, filename, filetype, filesize, filepath)VALUES('".$bill_id."','".$filename."','".$filetype."', '".$filesize."', '".$fileDestination."')";
            									mysqli_query($conn, $insert);
            									move_uploaded_file($fileTmpName, $fileDestination);
            									$file_id=mysqli_insert_id($conn);

													date_default_timezone_set("Asia/Kuala_Lumpur");
													$current_date=date('Y-m-d');
													$log_date=$current_date;
													$log_time=date("h:i:sa");
													$activity=$fname.' '.$lname.' added a new bill with an attachment, '.$payee.' for the month of '.$bill_month.' year '.$bill_year;

													$sql4="INSERT INTO t_logs(user_id,log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
													mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
													$log_id=mysqli_insert_id($conn);

													$sql3="INSERT INTO t_activity(activity,log_id,bill_id, file_id)VALUES('".$activity."','".$log_id."','".$bill_id."', '".$file_id."')";
													mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));



            									echo"<script>alert('Record Saved!'); window.location.href='../pages/bill.php?id=".$user_id."'</script>";
											}
											else
											{
												echo"<script>alert('The size is too large! Upload File!'); window.location.href='../pages/bill.php?id=".$user_id."'</script>";
											}
										}
										else
										{
											echo"<script>alert('There was an error in uploading the File!'); window.location.href='../pages/bill.php?id=".$user_id."'</script>";
										}
									}
									else
            						{
              							echo"<script>alert('Invalid File Type!'); window.location.href='../pages/bill.php?id=".$user_id."'</script>";
            						}
							}
						}
						else
						{
							echo"<script>alert('Please Upload a file!'); window.location.href='../pages/bill.php?id=".$user_id."'</script>";
						}
			}
			else
			{
				echo "<script>alert('Adding Record Failed!');window.location.href='../pages/bill.php?id=".$user_id."'</script>";
			}
		}
	}
	else
	{
		echo "<script>alert('Username/Password is required')</script>";
    	echo "<script>window.location.href = '../Error/404error.php'</script>";
	}

?>