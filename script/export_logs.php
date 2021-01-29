<?php
include_once'../pages/header.php';
include'../connection/connect.php';
if(date('z') == '0')
{
	$sql="SELECT t_user.fname, t_user.lname, t_activity.activity, t_logs.log_date, t_logs.log_time FROM t_activity LEFT JOIN t_logs ON t_logs.log_id = t_activity.log_id LEFT JOIN t_user ON t_user.user_id = t_logs.user_id WHERE YEAR(log_date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)) ORDER BY t_activity.activity_id DESC";
   $result=mysqli_query($conn,$sql);
   if(mysqli_num_rows($result) > 0)
   	{
   		$delimiter=',';
   		$logyear=date("Y", strtotime("-1 year"));
   		$filename="Activity Logs for the year_".$logyear.".csv";
   		if($f=@fopen('../activity_logs/'.$filename, 'w')!==false)
   		{
   			$f=@fopen('../activity_logs/'.$filename, 'w')or die("oopss.. an error has occured");
   			$fields=array('User', 'Activity', 'Log Date', 'Log Time');
   			fputcsv($f, $fields);
   			while ($row=mysqli_fetch_assoc($result)) 
   			{
   			
   				$lineData=array($row['fname'], $row['lname'], $row['activity'], $row['log_date'], $row['log_time']);
   				fputcsv($f,$lineData, $delimiter);
   			}


            $sql2="DELETE t_activity,t_logs FROM t_activity INNER JOIN t_logs ON t_logs.log_id = t_activity.log_id WHERE YEAR(log_date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))";
            mysqli_query($conn,$sql2);

   			fclose($f)or die("oopss.. an error has occured");
   			return;
   		}
   		else
   		{
   			echo "<script>alert('Please close the csv file to continue!');window.location.href='../pages/dashboard.php'</script>";
   		}


  	}
}
else
{
	return;
}

