<?php
session_start();
include'../connection/connect.php';
if(isset($_SESSION['user_id']))
{
	$id=$_SESSION['user_id'];
	$sql1="SELECT user_id, fname, lname FROM t_user WHERE user_id ='".$id."'";
	$result1=mysqli_query($conn,$sql1);
	while($row1=mysqli_fetch_array($result1))
	{

			$user_id=$row1['user_id'];
			$fname=$row1['fname'];
			$lname=$row1['lname'];
			if(isset($_POST['submit']))
			{		
					
						date_default_timezone_set("Asia/Kuala_Lumpur");
						$current_date=date('Y-m-d');
						$log_date=$current_date;
						$log_time=date("h:i:sa");
						$stat_id='';

						$bill_id=mysqli_escape_string($conn,$_POST['bill_id']);
						$payee=mysqli_escape_string($conn, $_POST['payee']);
						$bill_month=mysqli_escape_string($conn,$_POST['bill_month']);
						$bill_year=mysqli_escape_string($conn,$_POST['bill_year']);
						$date_received=mysqli_escape_string($conn,$_POST['date_receive']);
						$bill_amount=mysqli_escape_string($conn,$_POST['bill_amount']);
						$due_date=mysqli_escape_string($conn,$_POST['due_date']);
						$receipt_no=isset($_POST['receipt_no'])?$_POST['receipt_no']:"";
						

						$file=$_FILES['file_upload'];
						$filename = $_FILES['file_upload']['name'];
						$filesize = $_FILES['file_upload']['size'];
						$filetype = $_FILES['file_upload']['type'];
						$fileError= $_FILES['file_upload']['error'];
						$fileTmpName = $_FILES['file_upload']['tmp_name'];

					
						
						if(!empty($fileTmpName))
						{
							$checkFile="SELECT * FROM t_files WHERE bill_id='".$bill_id."'";
							$resultFile=mysqli_query($conn,$checkFile);
							$NumFile=mysqli_num_rows($resultFile);
							if($NumFile > 0)
							{
								echo"<script>alert('A file already exists!'); window.location.href='../pages/bill.php?id=".$user_id."'</script>";
							}
							else
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

            						
            								$insert="INSERT INTO t_files(filename, filetype, filesize, filepath)VALUES('".$filename."','".$filetype."', '".$filesize."', '".$fileDestination."')";
            								mysqli_query($conn, $insert);
            								$file_id=mysqli_insert_id($conn);
            								$insert2="UPDATE t_files SET file_id='".$file_id."', bill_id='".$bill_id."' WHERE file_id='".$file_id."'";
            								mysqli_query($conn,$insert2);
            								move_uploaded_file($fileTmpName, $fileDestination);

            								echo"<script>alert('Updated Successfully!'); window.location.href='../pages/bill.php?id=".$user_id."'</script>";

            								$selectInfo="SELECT payee, bill_month, bill_year FROM t_bill_info WHERE bill_id='".$bill_id."'";
            								$selectResult=mysqli_query($conn,$selectInfo);
            								while($rowSelect=mysqli_fetch_array($selectResult))
            								{
            									$payee=$rowSelect['payee'];
            									$bill_year=$rowSelect['bill_year'];
            									$bill_month=$rowSelect['bill_month'];

            									date_default_timezone_set("Asia/Kuala_Lumpur");
												$current_date=date('Y-m-d');
												$log_date=$current_date;
												$log_time=date("h:i:sa");
												$activity=$fname.' '.$lname.' changed the file for '.$payee.' for the month of '.$bill_month.' year '.$bill_year.' with a filename of '.$filename;

												$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$file_id."', '".$log_date."', '".$log_time."')";
												mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
												$log_id=mysqli_insert_id($conn);

												$sql3="INSERT INTO t_activity(activity,log_id,bill_id, file_id)VALUES('".$activity."','".$log_id."','".$bill_id."', '".$file_id."')";
												mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));

											}
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
							
							
							$activity=$fname.' '.$lname.' updated the bill of '.$payee.' for the month of '.$bill_month.', year '.$bill_year;
							$activity3=$fname.' '.$lname.' changed some details of '.$payee.' for the month of '.$bill_month.', year '.$bill_year;

							$sql4="INSERT INTO t_logs(user_id,log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
							$log_id=mysqli_insert_id($conn);


							$sql8="INSERT INTO t_activity(activity, log_id, bill_id)VALUES('".$activity."','".$log_id."','".$bill_id."')";
							mysqli_query($conn,$sql8) or die("database error:". mysqli_error($conn));
							$activity_id=mysqli_insert_id($conn);

				
							$sql="UPDATE t_bill_info SET bill_id='".$bill_id."', payee='".$payee."', bill_month='".$bill_month."', bill_year='".$bill_year."', date_receive='".$date_received."', due_date='".$due_date."', bill_amount='".$bill_amount."', receipt_no='".$receipt_no."' WHERE bill_id='".$bill_id."'";
							mysqli_query($conn,$sql) or die("database error:". mysqli_error($conn));


							if($_POST['status'] === 'Paid')
							{
								$stat_id=$_POST['status'] = 1;
								if(empty($receipt_no))
								{
									echo"<script>alert('Receipt Number Required!'); window.location.href='../pages/bill.php?id=".$id."'</script>";
								}
								else
								{
									$sql2="UPDATE t_bill_info SET bill_id='".$bill_id."', status_id='".$stat_id."' WHERE bill_id='".$bill_id."'";
									mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));
									$status = 'paid';
									$activity2=' from unpaid to '.$status;
									$complete=$activity.=$activity2;


									$sql3="UPDATE t_activity SET activity_id='".$activity_id."', activity='".$complete."' WHERE activity_id='".$activity_id."'";
									mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
								}
							}
							elseif ($_POST['status'] === 'Unpaid') 
							{

									$stat_id=$_POST['status'] = 2;
									$sql2="UPDATE t_bill_info SET bill_id='".$bill_id."', status_id='".$stat_id."' WHERE bill_id='".$bill_id."'";
									mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));

									$status = 'unpaid';
									$activity2=' from paid to '.$status;
									$complete2=$activity.=$activity2;


									$sql4="UPDATE t_activity SET activity_id='".$activity_id."', activity='".$complete2."' WHERE activity_id='".$activity_id."'";
									mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
								
							}
							else
							{
								$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
								mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
								$log_id=mysqli_insert_id($conn);

								$sql3="INSERT INTO t_activity(activity,log_id, bill_id)VALUES('".$activity3."','".$log_id."', '".$bill_id."')";
								mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));

							}
							echo"<script>alert('Updated Successfully!'); window.location.href='../pages/bill.php?id=".$id."'</script>";
							
						}

  			}
			else 
 			{
    			echo"<script>alert('Updated failed!'); window.location.href='../pages/bill.php?id=".$id."'</script>";
  			}	
  	}
}

?>