<?php
  session_start();
  include'../connection/connect.php';
  if(isset($_SESSION['user_id']))
  {
    $test=$_SESSION['user_id'];
    $sql="SELECT * FROM t_user WHERE user_id='".$test."'";
    $result=mysqli_query($conn, $sql);
    while ($row=mysqli_fetch_assoc($result))
    {
      $user_id=$row['user_id'];
      $name=$row['fname'];
      $lastname=$row['lname'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Activity Logs</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script src="../js/jquery-3.2.1.min.js"></script>
  <link href="../css/hover.css" rel="stylesheet" media="all">
  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"></head>
  <script type="text/javascript" src="../js/jquery.dataTables.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="icon" href="../icon/nbi.png">
  <style>
.navbar-global {
  background-color: indigo;
}
.navbar-inverse
{
  background-color: #343a40;
  border-color:#343a40;
}
.navbar-global .navbar-brand {
  color: white;
}

.navbar-global .navbar-user > li > a
{
  color: white;
}
  </style>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-inverse navbar-global navbar-fixed-top" style="background-color: #2F4F4F; border-color: #2F4F4F;">
      <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">NBI-EVRO Automated Document Filing and Records System</a>
      </div>

      <div class="collapse navbar-collapse js-navbar-collapse">

        <ul class="nav navbar-nav navbar-right navbar-user" style="margin: 5px;">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $name.' '.$lastname;?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
             <li><a data-toggle="modal" data-target="#modalLogout" style="cursor: pointer;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
          </li>

        </ul>
      </div>
    </nav><!--end of navbar-->
  </div><!--End of Head-->
  <div id="main" style="overflow:auto; padding-top: 2%;">
  <ol class="breadcrumb" style="background-color:white; width:100%; border-radius: 15px; padding-left: 5%; padding-right: 5%;">
      <li class="breadcrumb-item">
        <a href="../pages/dashboard.php?user_id=<?=$row['user_id'];?>" style="font-size:20px;"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
      </li>
      <li class="breadcrumb-item active" style="font-size:20px; color:black;"><i class="fa fa-calendar" aria-hidden="true" style="color:black;"></i> Activity Logs</li>
  </ol>
      <div class="col-md-12">
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
          </p>
          <br>
          <div class="row" style="padding-right:5%; padding-left:5%;">
            <div class="panel panel-default">
              <div class="panel-heading">
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="dataTable">
                    <thead>
                      <tr>
                        <th width="13%">User</th>
                        <th>Activity</th>
                        <th width="13%">Log-Date</th>
                        <th width="11%">Log-Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql="SELECT t_user.user_id, t_user.fname, t_user.lname, t_logs.user_id,  t_activity.activity,t_activity.activity_id, t_logs.log_id, t_logs.log_date, t_logs.log_time FROM t_activity LEFT JOIN t_logs ON t_logs.log_id = t_activity.log_id LEFT JOIN t_user ON t_user.user_id = t_logs.user_id ORDER BY t_activity.activity_id DESC";
                        $result=mysqli_query($conn,$sql) or die("database error:". mysqli_error($conn));
                        while ($row=mysqli_fetch_array($result)) 
                        {
                            $fname=$row['fname'];
                            $lname=$row['lname'];
                            $user_id=$row['user_id'];
                            $activity_id=$row['activity_id'];
                            $log_date=$row['log_date'];
                            $log_time=$row['log_time'];
                            $activity=$row['activity'];
                        ?>
                        <tr>
                          <td><?php echo $fname.' '.$lname;?></td>
                          <td><?php echo $activity; ?></td>
                          <td><?php echo $log_date; ?></td>
                          <td><?php echo $log_time; ?></td>
                        </tr>
                       <?php   
                        }
                      ?>
                    </tbody>
                  </table>
                </div><!--Table-responsive-->




              </div><!--Panel-body-->
            </div><!--Panel-->
          </div>
      </div>
  </div>
</div><!--/row-offcanvas -->
</div><!--/Main Content-->


<div id="modalLogout" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Logout?</h4>
      </div>
      <div class="modal-body">
        <form action="../script/logout.php" method="POST">
          <p>Select "Logout" below if you are ready to end your current session.</p>
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-primary">Logout</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
      </div>
        </form>
    </div>
  </div>
</div>
</div>
<script src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $('#dataTable').dataTable({
    "info":false,
  });

}); 

</script>
<script src="../popper/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
            $(this).toggleClass('open');       
        }
    );
});
</script>



</body>
</html>
<?php
  }
}
else
{
  echo "<script>alert('Username and Password Required')</script>";
    echo "<script>window.location.href = '../Error/404error.php'</script>";
}
?>