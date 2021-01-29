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

				$voucher_id=$_GET['delete'];
				$sql1="SELECT voucher_id, filename, filesize, filepath FROM t_files WHERE voucher_id='".$voucher_id."'";
				$result=mysqli_query($conn,$sql1)or die("database error:". mysqli_error($conn));
				$row=mysqli_num_rows($result);
				if (!empty($row)) 
				{
					$sqlFile="SELECT file_id, voucher_id, filename, filepath, filesize FROM t_files WHERE voucher_id='".$voucher_id."'";
					$resultFile=mysqli_query($conn,$sqlFile);
					while($rowFile=mysqli_fetch_array($resultFile))
					{
						$file_id=$rowFile['file_id'];
						$filename=$rowFile['filename'];
						$filepath=$rowFile['filepath'];
						$filesize=$rowFile['filesize'];

						$selectOldData="SELECT voucher_id, payee, invoice_date, invoice_amount, particulars FROM t_voucher_info WHERE voucher_id='".$voucher_id."'";
						$fetchbill=mysqli_query($conn,$selectOldData);
						while ($rowBillInfo=mysqli_fetch_array($fetchbill)) 
						{
							$payee=$rowBillInfo['payee'];
							$invoice_date=$rowBillInfo['invoice_date'];
							$invoice_amount=$rowBillInfo['invoice_amount'];

							$activity=$fname.' '.$lname.' deleted the voucher record of '.$payee.' invoiced date at '.$invoice_date.' along with the attachment with a filename of '.$filename;

							$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
							$log_id=mysqli_insert_id($conn);


							$sql3="INSERT INTO t_activity(activity, log_id)VALUES('".$activity."', '".$log_id."')";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
							$activity_id=mysqli_insert_id($conn);


							$voucher_id=$rowFile['voucher_id'];
							$filepath=$rowFile['filepath'];
							unlink($filepath);
							$sql2="DELETE FROM t_voucher_info WHERE voucher_id='".$voucher_id."'";"DELETE FROM t_files WHERE voucher_id='".$voucher_id."'";
							mysqli_query($conn,$sql2)or die("database error:". mysqli_error($conn));

							echo"<script>alert('Successfully deleted!'); window.location.href='../user/voucher.php?id=".$user_id."'</script>";
						}
					}	
				}
				else
				{

					$selectOldData="SELECT voucher_id, payee, invoice_date, invoice_amount, particulars FROM t_voucher_info WHERE voucher_id='".$voucher_id."'";
					$fetchVoucher=mysqli_query($conn,$selectOldData);
					while ($rowVoucherInfo=mysqli_fetch_array($fetchVoucher)) 
					{	
						$voucher_id=$rowVoucherInfo['voucher_id'];
						$payee=$rowVoucherInfo['payee'];
						$invoice_date=$rowVoucherInfo['invoice_date'];
						$invoice_amount=$rowVoucherInfo['invoice_amount'];
						$particulars=$rowVoucherInfo['particulars'];

						$activity=$fname.' '.$lname.' deleted the voucher record of '.$payee.' invoiced date at '.$invoice_date;

						$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
						mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
						$log_id=mysqli_insert_id($conn);


						$sql3="INSERT INTO t_activity(activity, log_id)VALUES('".$activity."', '".$log_id."')";
						mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));
						$activity_id=mysqli_insert_id($conn);


						$sql3="DELETE FROM t_voucher_info WHERE voucher_id='".$voucher_id."'";
						mysqli_query($conn,$sql3)or die("database error:". mysqli_error($conn));

						echo"<script>alert('Successfully deleted!'); window.location.href='../user/voucher.php?id=".$user_id."'</script>";
					}
				
				}				
			}
		}
	}




?>