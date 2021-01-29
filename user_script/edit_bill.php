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

						$bill_id=mysqli_escape_string($conn,$_POST['bill_id']);
						$payee=mysqli_escape_string($conn, $_POST['payee']);
						$bill_month=mysqli_escape_string($conn,$_POST['bill_month']);
						$bill_year=mysqli_escape_string($conn,$_POST['bill_year']);
						$date_received=mysqli_escape_string($conn,$_POST['date_receive']);
						$bill_amount=mysqli_escape_string($conn,$_POST['bill_amount']);
						$due_date=mysqli_escape_string($conn,$_POST['due_date']);
						$receipt_no=isset($_POST['receipt_no'])?$_POST['receipt_no']:"";
						$status=isset($_POST['status'])?$_POST['status']:"";

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
								echo"<script>alert('A file already exists!'); window.location.href='../user/bill.php?id=".$user_id."'</script>";
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

            								echo"<script>alert('Updated Successfully!'); window.location.href='../user/bill.php?id=".$user_id."'</script>";

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
												$activity=$fname.' '.$lname.' added a new file for '.$payee.' for the month of '.$bill_month.' year '.$bill_year.' with a filename of '.$filename;

												$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$file_id."', '".$log_date."', '".$log_time."')";
												mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
												$log_id=mysqli_insert_id($conn);

												
												$sql3="INSERT INTO t_activity(activity,log_id,bill_id, file_id)VALUES('".$activity."','".$log_id."','".$bill_id."', '".$file_id."')";
												mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));

											}
										}
										else
										{
											echo"<script>alert('The size is too large! Upload File!'); window.location.href='../user/bill.php?id=".$user_id."'</script>";
										}
									}
									else
									{
										echo"<script>alert('There was an error in uploading the File!'); window.location.href='../user/bill.php?id=".$user_id."'</script>";
									}
								}
								else
            					{
              						echo"<script>alert('Invalid File Type!'); window.location.href='../user/bill.php?id=".$user_id."'</script>";
            					}
							}
							
						}
						else
						{
							
							
							$activity=$fname.' '.$lname.' updated the bill of '.$payee.' for the month of '.$bill_month.', year '.$bill_year;
							$activity3=$fname.' '.$lname.' changed some details of '.$payee.' for the month of '.$bill_month.', year '.$bill_year;



							$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
							$log_id=mysqli_insert_id($conn);

							$sql8="INSERT INTO t_activity(activity,log_id, bill_id)VALUES('".$activity."','".$log_id."','".$bill_id."')";
							mysqli_query($conn,$sql8) or die("database error:". mysqli_error($conn));
							$activity_id=mysqli_insert_id($conn);
				
							$sql="UPDATE t_bill_info SET bill_id='".$bill_id."', payee='".$payee."', bill_month='".$bill_month."', bill_year='".$bill_year."', date_receive='".$date_received."', due_date='".$due_date."', bill_amount='".$bill_amount."', receipt_no='".$receipt_no."' WHERE bill_id='".$bill_id."'";
							mysqli_query($conn,$sql) or die("database error:". mysqli_error($conn));


							if($status == 1)
							{

								if(empty($receipt_no))
								{
									echo"<script>alert('Receipt Number Required!'); window.location.href='../pages/bill.php?id=".$id."'</script>";
								}
								else
								{
									$sql2="UPDATE t_bill_info SET bill_id='".$bill_id."', status_id='".$status."' WHERE bill_id='".$bill_id."'";
									mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));
									$status = 'paid';
									$activity.=' from unpaid to '.$status;


									$sql3="UPDATE t_activity SET activity_id='".$activity_id."', activity='".$activity."' WHERE activity_id='".$activity_id."'";
									mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
								}
							}
							elseif ($status == 2) 
							{

								
									$sql2="UPDATE t_bill_info SET bill_id='".$bill_id."', status_id='".$status."' WHERE bill_id='".$bill_id."'";
									mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));

									$status = 'unpaid';
									$activity.=' from paid to '.$status;


									$sql4="UPDATE t_activity SET activity_id='".$activity_id."', activity='".$activity."' WHERE activity_id='".$activity_id."'";
									mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
								
							}
							else
							{
								$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$activity_id."', '".$log_date."', '".$log_time."')";
								mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
								$log_id=mysqli_insert_id($conn);

								$sql3="INSERT INTO t_activity(activity,log_id, bill_id)VALUES('".$activity3."','".$log_id."', '".$bill_id."')";
								mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));

							}
							echo"<script>alert('Updated Successfully!'); window.location.href='../user/bill.php?id=".$id."'</script>";
							
						}







						/*$activity=$fname.' '.$lname.' updated the bill of '.$payee.' for the month of '.$bill_month.', year '.$bill_year;
						$activity2=$fname.' '.$lname.' update the receipt no. to '.$receipt_no.' for bill payee '.$payee.' for the month of '.$bill_month.', year '.$bill_year;
						$activity3=$fname.' '.$lname.' changed some details of '.$payee.' for the month of '.$bill_month.', year '.$bill_year;

						$sql8="INSERT INTO t_activity(activity, bill_id)VALUES('".$activity."','".$bill_id."')";
						mysqli_query($conn,$sql8) or die("database error:". mysqli_error($conn));
						$activity_id=mysqli_insert_id($conn);

						$sql4="INSERT INTO t_logs(user_id, activity_id, log_date, log_time)VALUES('".$user_id."', '".$activity_id."', '".$log_date."', '".$log_time."')";
						mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));

				
						$sql="UPDATE t_bill_info SET bill_id='".$bill_id."', payee='".$payee."', bill_month='".$bill_month."', bill_year='".$bill_year."', date_receive='".$date_received."', due_date='".$due_date."', bill_amount='".$bill_amount."', receipt_no='".$receipt_no."' WHERE bill_id='".$bill_id."'";
							mysqli_query($conn,$sql) or die("database error:". mysqli_error($conn));

						if($status == 1)
						{
							
							$sql2="UPDATE t_bill_info SET bill_id='".$bill_id."', status_id='".$status."' WHERE bill_id='".$bill_id."'";
							mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));
							$status = 'paid';
							$activity.=' from unpaid to '.$status;


							$sql3="UPDATE t_activity SET activity_id='".$activity_id."', activity='".$activity."' WHERE activity_id='".$activity_id."'";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
						}
						elseif ($status == 2) 
						{
							$sql2="UPDATE t_bill_info SET bill_id='".$bill_id."', status_id='".$status."' WHERE bill_id='".$bill_id."'";
							mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));

							$status = 'unpaid';
							$activity.=' from paid to '.$status;


							$sql4="UPDATE t_activity SET activity_id='".$activity_id."', activity='".$activity."' WHERE activity_id='".$activity_id."'";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
						}
						else
						{

							$sql3="INSERT INTO t_activity(activity, bill_id)VALUES('".$activity3."', '".$bill_id."')";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
							$activity_id=mysqli_insert_id($conn);

							$sql4="INSERT INTO t_logs(user_id, activity_id, log_date, log_time)VALUES('".$user_id."', '".$activity_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
						}*/



















						
							//$sql="UPDATE t_bill_info SET bill_id='".$bill_id."', payee='".$payee."', bill_month='".$bill_month."', bill_year='".$bill_year."', date_receive='".$date_received."', due_date='".$due_date."', bill_amount='".$bill_amount."', receipt_no='".$receipt_no."' WHERE bill_id='".$bill_id."'";
							//mysqli_query($conn,$sql) or die("database error:". mysqli_error($conn));
							
						
				

						/*if($status == 1)
						{

							
							$sql2="UPDATE t_bill_info SET bill_id='".$bill_id."', status_id='".$status."' WHERE bill_id='".$bill_id."'";
							mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));

							$status = 'paid';

							date_default_timezone_set("Asia/Kuala_Lumpur");
							$current_date=date('Y-m-d');
							$log_date=$current_date;
							$log_time=date("h:i:sa");
							$activity=$fname.' '.$lname.' updated the status on bill no. '.$bill_id.' to '.$status;


							$sql3="INSERT INTO t_activity(activity, bill_id)VALUES('".$activity."', '".$bill_id."')";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
							$activity_id=mysqli_insert_id($conn);

							$sql4="INSERT INTO t_logs(user_id, activity_id, log_date, log_time)VALUES('".$user_id."', '".$activity_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));

						}
						elseif ($status == 2) 
						{
							$sql2="UPDATE t_bill_info SET bill_id='".$bill_id."', status_id='".$status."' WHERE bill_id='".$bill_id."'";
							mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));

							$status = 'unpaid';

							date_default_timezone_set("Asia/Kuala_Lumpur");
							$current_date=date('Y-m-d');
							$log_date=$current_date;
							$log_time=date("h:i:sa");
							$activity=$fname.' '.$lname.' updated the status on bill no. '.$bill_id.' to '.$status;


							$sql3="INSERT INTO t_activity(activity, bill_id)VALUES('".$activity."', '".$bill_id."')";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
							$activity_id=mysqli_insert_id($conn);

							$sql4="INSERT INTO t_logs(user_id, activity_id, log_date, log_time)VALUES('".$user_id."', '".$activity_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
						}
						else
						{
							date_default_timezone_set("Asia/Kuala_Lumpur");
							$current_date=date('Y-m-d');
							$log_date=$current_date;
							$log_time=date("h:i:sa");
							$activity=$fname.' '.$lname.' updated bill details on bill no. '.$bill_id;


							$sql3="INSERT INTO t_activity(activity, bill_id)VALUES('".$activity."', '".$bill_id."')";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
							$activity_id=mysqli_insert_id($conn);

							$sql4="INSERT INTO t_logs(user_id, activity_id, log_date, log_time)VALUES('".$user_id."', '".$activity_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
						}*/

  						//echo"<script>alert('Updated Successfully!'); window.location.href='../pages/bill.php?id=".$id."'</script>";
  			}
			else 
 			{
    			echo"<script>alert('Updated failed!'); window.location.href='../user/bill.php?id=".$id."'</script>";
  			}	
  	}
}

?>