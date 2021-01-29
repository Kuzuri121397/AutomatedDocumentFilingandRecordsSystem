<?php
	session_start();
	include'../connection/connect.php';
	if (isset($_SESSION['user_id'])) 
	{
		$user_id=$_SESSION['user_id'];
		if(isset($_GET['file_delete']))
		{

			$file_id=$_GET['file_delete'];
			if(!empty($file_id))
			{

				$sql7="SELECT t_files.voucher_id, t_files.file_id, t_voucher_info.voucher_id, t_voucher_info.payee, t_voucher_info.invoice_date, t_voucher_info.invoice_amount FROM t_voucher_info LEFT JOIN t_files ON t_files.voucher_id = t_voucher_info.voucher_id WHERE file_id='".$file_id."'";
		  		$result7=mysqli_query($conn,$sql7);
		  		while ($row7=mysqli_fetch_array($result7)) 
		  		{
		  		
		  			$payee=$row7['payee'];
		  			$invoice_date=$row7['invoice_date'];
		  			$invoice_amount=$row7['invoice_amount'];
		  			$particulars=$row7['particulars'];

		  
					$sql6="SELECT fname, lname FROM t_user";
					$result6=mysqli_query($conn,$sql6);
					while($row6=mysqli_fetch_array($result6))
					{
						$fname=$row6['fname'];
						$lname=$row6['lname'];
			

					
						$sql1="SELECT * FROM t_files WHERE file_id='".$file_id."'";
						$result1=mysqli_query($conn,$sql1)or die("database error:". mysqli_error($conn));
						while($row1=mysqli_fetch_array($result1))
						{
							$filename=$row1['filename'];
							$filetype=$row1['filetype'];


							date_default_timezone_set("Asia/Kuala_Lumpur");
							$current_date=date('Y-m-d');
							$log_date=$current_date;
							$log_time=date("h:i:sa");
							$activity=$fname.' '.$lname.' deleted the file with a filename of '.$filename.' for voucher record, '.$payee.' invoiced date at, '.$invoice_date;

							$sql4="INSERT INTO t_logs(user_id, log_date, log_time)VALUES('".$user_id."', '".$log_date."', '".$log_time."')";
							mysqli_query($conn,$sql4) or die("database error:". mysqli_error($conn));
							$log_id=mysqli_insert_id($conn);

							$sql3="INSERT INTO t_activity(activity,log_id)VALUES('".$activity."','".$log_id."')";
							mysqli_query($conn,$sql3) or die("database error:". mysqli_error($conn));



							echo $voucher_id=$row1['voucher_id'];
							echo $file_id=$row1['file_id'];
							echo $path=$row1['filepath'];
							unlink($path);
							$sql2="DELETE FROM t_files WHERE file_id='".$file_id."'";
							mysqli_query($conn, $sql2);
							header('Location:../pages/voucher.php?id='.$user_id);
						}
					}
		  		}
			}
			else
			{
				echo"<script>alert('There is no File!'); window.location.href='../pages/voucher.php?id=".$user_id."'</script>";
			}
		}
	}





?>