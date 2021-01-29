<?php
	session_start();
	include'../connection/connect.php';
	if (isset($_SESSION['user_id'])) 
	{
		$user_id=$_SESSION['user_id'];
		date_default_timezone_set("Asia/Kuala_Lumpur");
		$current_date=date('Y-m-d');
		$log_date=$current_date;
		$log_time=date("h:i:sa");

		if(isset($_GET['delete']))
		{
			$fetchName="SELECT fname, lname FROM t_user WHERE user_id='".$user_id."'";
			$fetchResult=mysqli_query($conn,$fetchName);
			while ($rowResult=mysqli_fetch_array($fetchResult))
			{

				$fname=$rowResult['fname'];
				$lname=$rowResult['lname'];

				$bill_id=$_GET['delete'];
				$sql1="SELECT bill_id, filename, filepath FROM t_files WHERE bill_id='".$bill_id."'";
				$result=mysqli_query($conn,$sql1)or die("database error:". mysqli_error($conn));
				$row=mysqli_num_rows($result);
				if ($row > 0) 
				{
					$sqlFile="SELECT file_id, bill_id, filename, filepath FROM t_files WHERE bill_id='".$bill_id."'";
					$resultFile=mysqli_query($conn,$sqlFile);
					while($rowFile=mysqli_fetch_array($resultFile))
					{
						$bill_id=$rowFile['bill_id'];
						$file_id=$rowFile['file_id'];
						$filename=$rowFile['filename'];
						$filepath=$rowFile['filepath'];

						$selectOldData="SELECT bill_id, payee, bill_month, bill_year FROM t_bill_info WHERE bill_id='".$bill_id."'";
						$fetchbill=mysqli_query($conn,$selectOldData);
						while ($rowBillInfo=mysqli_fetch_array($fetchbill)) 
						{
							$payee=$rowBillInfo['payee'];
							$bill_month=$rowBillInfo['bill_month'];
							$bill_year=$rowBillInfo['bill_year'];

							$activity=$fname.' '.$lname.' deleted the bill of '.$payee.' for the month of '.$bill_month.', year '.$bill_year.' along with the attachment with a filename of '.$filename;

							$sql4="INSERT INTO t_logs(user_id,log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
							$log_id=mysqli_insert_id($conn);

							$sql3="INSERT INTO t_activity(activity, log_id)VALUES('".$activity."','".$log_id."')";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));


							$bill_id=$rowFile['bill_id'];
							$filepath=$rowFile['filepath'];
							unlink($filepath);
							$sql2="DELETE FROM t_bill_info WHERE bill_id='".$bill_id."'";"DELETE FROM t_files WHERE bill_id='".$bill_id."'";
							mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));

							echo"<script>alert('Successfully deleted!'); window.location.href='../pages/bill.php?id=".$user_id."'</script>";
						}
					}	
				}
				else
				{

					$selectOldData="SELECT bill_id, payee, bill_month, bill_year FROM t_bill_info WHERE bill_id='".$bill_id."'";
					$fetchbill=mysqli_query($conn,$selectOldData);
					while ($rowBillInfo=mysqli_fetch_array($fetchbill)) 
					{
						$payee=$rowBillInfo['payee'];
						$bill_month=$rowBillInfo['bill_month'];
						$bill_year=$rowBillInfo['bill_year'];

						$activity=$fname.' '.$lname.' deleted the bill of '.$payee.' for the month of '.$bill_month.', year '.$bill_year;

						$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
						mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
						$log_id=mysqli_insert_id($conn);

						$sql3="INSERT INTO t_activity(activity, log_id)VALUES('".$activity."', '".$log_id."')";
						mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));


						$sql3="DELETE FROM t_bill_info WHERE bill_id='".$bill_id."'";
						mysqli_query($conn,$sql3)or die("database error:". mysqli_error($conn));

						echo"<script>alert('Successfully deleted!'); window.location.href='../pages/bill.php?id=".$user_id."'</script>";
					}
				
				}				
			}
		}
	}




?>