<?php
  session_start();
  include'../connection/connect.php';
  include'../script/auth.php';
  include'../script/export_logs.php';

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
      $role_id=$row['role_id'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="../chart/Chart.js"></script>
  <script src="../chart/PieceLabel/src/Chart.PieceLabel.js"></script>
  <script src="../js/bootstrap.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"></head>
  <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../css/hover.css" rel="stylesheet" media="all">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="icon" href="../icon/nbi.png">

  <script>
    function myFunction()
    {
      $.ajax({
        url:"../script/notification.php",
        type:"POST",
        processData:false,
        success:function(data)
        {          
          $("#notification-count").show();
          $("#notification-list").show();
          $("#notification-list").html(data);

        }
      });
    }



  $(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });

  $('body').click(function(e){
    if(e.target.id != 'notification-button')
    {
      $("#notification-list").hide();
    }
  });

});
  </script>
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




    #notification-list {
  color:black;
  position: absolute;
  right: 0px;
  background:white;
  box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.20);    
  width: 350px;
  text-align: left;
  overflow: auto;
}
.dropdown#notification-count{
  position: absolute;
  left: 0px;
  top: 0px;
  font-size: 0.8em;   
  color: #de5050;
  font-weight:bold;
}
.notification-item {
  padding:10px;
  border-bottom: #3ae2cb 1px solid;
  cursor:pointer;
  overflow-y:auto;
}
.notification-sender {   
  white-space: nowrap;
  overflow: hidden;
}
.notification-remarks {   
  white-space: nowrap;
  overflow: visible;
  /*text-overflow: ellipsis;*/
  font-style:italic;
}
.notification-deadline {   
  white-space: nowrap;
  overflow: hidden;
  font-style:italic;
}

.nav-dropdown {
  position: absolute;
  display: none;
  z-index: 1;
  box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15);
}

.mega-dropdown {
  position: static !important;
}
.mega-dropdown-menu {
    padding: 20px 0px;
    width: 100%;
    box-shadow: none;
    -webkit-box-shadow: none;
}
.mega-dropdown-menu > li > ul {
  padding: 0;
  margin: 0;
}
.mega-dropdown-menu > li > ul > li {
  list-style: none;
}
.mega-dropdown-menu > li > ul > li > a {
  display: block;
  color: #222;
  padding: 3px 5px;
}
.mega-dropdown-menu > li ul > li > a:hover,
.mega-dropdown-menu > li ul > li > a:focus {
  text-decoration: none;
}
.mega-dropdown-menu .dropdown-header {
  font-size: 18px;
  color: #ff3546;
  padding: 5px 60px 5px 5px;
  line-height: 30px;
}
/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}



  </style>
</head>
<body>
  <?php

    $notify="SELECT scheduled_event FROM t_incoming WHERE scheduled_event BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 DAY";
    $res=mysqli_query($conn,$notify);
    $count=mysqli_num_rows($res);

  ?>
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
          <li>
              <a href="#" id="notification-button" class="dropdown-toggle" data-toggle="dropdown" onclick="myFunction()" role="button" aria-haspopup="true" aria-expanded="false"><span class="badge" id="notification-count" style="border-radius:10px;"><?php if($count>0) { echo $count; } else{ echo '0';} ?></span><i class="fa fa-bell-o" aria-hidden="true"></i> Upcoming Event(s)<span class="caret"></span></a>
                <ul class="dropdown-menu" id="notification-list">
                </ul>
            </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $name.' '.$lastname;?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="../pages/profile_information.php?user_id=<?=$row['user_id'];?>"><i class="fa fa-user-o" aria-hidden="true"></i> Profile Information</a></li>
             <li><a href="../script/logout.php?user_id=<?=$row['user_id'];?>" onclick="return confirm('Do you want to logout and end current session?');" style="cursor: pointer;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav><!--end of navbar-->
  </div><!--End of Head-->

  <div class="row-offcanvas row-offcanvas-left">
  <div id="sidebar" class="sidebar-offcanvas" style=" padding-top: 3%;">
      <div class="col-md-12">
        
        <hr />
          <ul class="nav nav-pills nav-stacked">
            <li>
              <a class="nav-link" href="../pages/manage_users.php?user_id=<?=$row['user_id'];?>" style="text-decoration: none; cursor: pointer;">
                    <i class="fa fa-users" aria-hidden="true" style="color: black;"></i> 
                    <span class="nav-link-text" style="color:black; font-size:20px; cursor:pointer;">Manage Users</span>
                  </a>
            </li>
            <li>
              <a href="../pages/log.php?user_id=<?=$row['user_id'];?>" style="font-size:150%; text-decoration: none; cursor: pointer;">
                    <i class="fa fa-calendar" aria-hidden="true" style="color: black;"></i> 
                    <span class="nav-link-text" style="color:black; font-size:20px; cursor:pointer;">Logs</span>
                  </a>
            </li>
            <li>
              <a href="http://localhost/phpmyadmin/" target="_blank" style="font-size:20px; color:black; text-decoration: none; cursor: pointer;"><i class="fa fa-database" aria-hidden="true" style="color: black;"></i> Database</a>
            </li>
            <li>
              <a href="../pages/export_data_bills.php?user_id=<?=$row['user_id'];?>" style="font-size:150%; text-decoration: none; cursor: pointer;">
                    <i class="fa fa-download" aria-hidden="true" style="color: black;"></i> 
                    <span class="nav-link-text" style="color:black; font-size:20px; cursor:pointer;">Export Data</span>
                  </a>
            </li>
          <hr />
        </ul>
      </div>
  </div>







  <div id="main" style="overflow:auto; padding-top: 2%;">
    <ol class="breadcrumb" style="background-color:white; width:100%; border-radius: 15px;">
      <li class="breadcrumb-item active" style="font-size:20px; color:black;"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</li>
    </ol>
      <div class="col-md-12">
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
          </p>
          <div class="row">
                <div class="col-lg-3 col-md-6">
                        <a href="../pages/bill.php?user_id=<?=$row['user_id'];?>">
                    <div class="panel panel-green " style="border-color: #5cb85c;color: white;background-color: #5cb85c;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x hvr-float" style="color: white;"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <?php
                                    $sql1="SELECT COUNT(*) FROM t_bill_info";
                                    $results=mysqli_query($conn,$sql1);
                                    $rowresults=mysqli_fetch_array($results);

                                    $totalBill=$rowresults[0];

                                  ?>
                                    <div style="font-size: 30px; color: white;"><?php echo $totalBill;?></div>
                                    <div style="font-size: 30px; color:white;">Bills</div>
                                </div>
                            </div>
                        </div>
                            <div class="panel-footer">
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                        <a href="../pages/voucher.php?user_id=<?=$row['user_id'];?>" style="border-color: #5cb85c;color: white;background-color: #5cb85c;">
                    <div class="panel panel-red" style="border-color: #d9534f;color: white;background-color: #d9534f;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x hvr-float"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <?php
                                    $sql1="SELECT COUNT(*) FROM t_voucher_info";
                                    $results=mysqli_query($conn,$sql1);
                                    $rowresults=mysqli_fetch_array($results);

                                    $totalVoucher=$rowresults[0];

                                  ?>
                                    <div style="font-size: 30px;"><?php echo $totalVoucher;?></div>
                                    <div style="font-size: 30px;">Vouchers</div>
                                </div>
                            </div>
                        </div>
                            <div class="panel-footer">
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                        <a href="../pages/incoming.php?user_id=<?=$row['user_id'];?>" style="border-color: #5cb85c;color: white;background-color: #5cb85c;">
                    <div class="panel panel-yellow" style="border-color: #f0ad4e;color: white;background-color: #f0ad4e;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-inbox fa-5x hvr-float"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <?php
                                    $sql1="SELECT COUNT(*) FROM t_incoming";
                                    $results=mysqli_query($conn,$sql1);
                                    $rowresults=mysqli_fetch_array($results);

                                    $totalIncoming=$rowresults[0];

                                  ?>
                                    <div style="font-size: 30px;"><?php echo $totalIncoming;?></div>
                                    <div style="font-size: 30px;">Incoming</div>
                                </div>
                            </div>
                        </div>
                            <div class="panel-footer">
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                        <a href="../pages/outgoing.php?user_id=<?=$row['user_id'];?>" style="border-color: #5cb85c;color: white;background-color: #5cb85c;">
                    <div class="panel panel-primary" style="border-color: #5cb85c;color: white;background-color: rgb(0, 77, 255);">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-paper-plane fa-5x hvr-float"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <?php
                                    $sql1="SELECT COUNT(*) FROM t_outgoing";
                                    $results=mysqli_query($conn,$sql1);
                                    $rowresults=mysqli_fetch_array($results);

                                    $totalOutgoing=$rowresults[0];

                                  ?>
                                    <div style="font-size: 30px;"><?php echo $totalOutgoing;?></div>
                                    <div style="font-size: 30px;">Outgoing</div>
                                </div>
                            </div>
                        </div>
                            <div class="panel-footer">
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
            </div>
          </div><!--Row-->
          <br>
          <div class="row">
            <!--Pie Chart-->
            <div class="col-md-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-pie-chart fa-2x" aria-hidden="true"></i> Pie Graph Representation of records in NBI EVRO Automated Document Filing and Records System
                </div>
                <div class="panel-body">
                  <canvas id="PieChart" width="150" height="80"></canvas>
                </div>
                <div class="panel-footer">
                  
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i> <b>Unpaid Bills</b>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="table table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Payee</th>
                            <th>Bill Month</th>
                            <th>Date Receive</th>
                            <th>Due date</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $stat='';
                            $sql2="SELECT payee, bill_month, bill_year, date_receive, due_date, status_id FROM t_bill_info WHERE status_id=2";
                            $result=mysqli_query($conn,$sql2);
                            while ($row2=mysqli_fetch_array($result)) 
                            {
                              $payee=$row2['payee'];
                              $bill_month=$row2['bill_month'];
                              $bill_year=$row2['bill_year'];
                              $date_receive=$row2['date_receive'];
                              $due_date=$row2['due_date'];
                              $status_id=$row2['status_id'];
                              if($status_id == 2)
                              {
                                $stat='Unpaid';
                          ?>
                                <tr>
                                  <th><?php echo $payee; ?></th>
                                  <th><?php echo $bill_month; ?></th>
                                
                                  <th><?php echo $date_receive;?></th>
                                  <th><?php echo $due_date;?></th>
                                  <th><?php echo $stat; ?></th>
                                </tr>
                      <?php
                              }
                        }
                      ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="panel-footer">
                </div>
              </div>
            </div>   
          </div><!--row-->
      </div>
  </div>
</div><!--/row-offcanvas -->
</div><!--/Main Content-->
<?php
$sql="SELECT COUNT(*) FROM t_bill_info";
$results=mysqli_query($conn,$sql);
$rowresult=mysqli_fetch_array($results);

$countBill=$rowresult[0];


$sql="SELECT COUNT(*) FROM t_voucher_info";
$results=mysqli_query($conn,$sql);
$rowresult=mysqli_fetch_array($results);

$countVoucher=$rowresult[0];


$sql="SELECT COUNT(*) FROM t_incoming";
$results=mysqli_query($conn,$sql);
$rowresult=mysqli_fetch_array($results);

$countIncoming=$rowresult[0];


$sql="SELECT COUNT(*) FROM t_outgoing";
$results=mysqli_query($conn,$sql);
$rowresult=mysqli_fetch_array($results);

$countOutgoing=$rowresult[0];


?>

<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../chart/Chart.js"></script>
<script src="../chart/PieceLabel/src/Chart.PieceLabel.js"></script>
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
<?php
if($countBill > 0 || $countVoucher > 0 || $countIncoming > 0 || $countOutgoing > 0)
{
  $totalRecords=$countBill+$countVoucher+$countIncoming+$countOutgoing;

  $percentageBill=$countBill / $totalRecords;
  $percentageVoucher=$countVoucher / $totalRecords;
  $percentageIncoming=$countIncoming / $totalRecords;
  $percentageOutgoing=$countOutgoing / $totalRecords;

  $finalBill=round((float)$percentageBill * 100);
  $finalVoucher=round((float)$percentageVoucher * 100);
  $finalIncoming=round((float)$percentageIncoming * 100);
  $finalOutgoing=round((float)$percentageOutgoing * 100);

?>
<script type="text/javascript">
  var ctx = document.getElementById("PieChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: 
    {
        labels: ["Bills", "Vouchers", "Incoming Communications", "Outgoing Communications"],
        datasets: [{
            data: [<?php echo $finalBill; ?>, <?php echo $finalVoucher?>, <?php echo $finalIncoming; ?>, <?php echo $finalOutgoing; ?>],
            backgroundColor: [
                'rgb(60, 179, 113)',
                'rgb(255, 0, 0)',
                'rgb(255, 165, 0)',
                'rgb(0, 77, 255)',
            ]
        }]
    },
    options: 
          {
            pieceLabel: {
                render: 'percentage',
                fontColor: ['white', 'white', 'white', 'white']
              }
          }

});
</script>
<?php
}
else
{
?>
<script type="text/javascript">
  var ctx = document.getElementById("PieChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: 
    {
        labels: ["Bills", "Vouchers", "Incoming Communications", "Outgoing Communications"],
        datasets: [{
            data: [],
            backgroundColor: [
                'rgb(60, 179, 113)',
                'rgb(255, 0, 0)',
                'rgb(255, 165, 0)',
                'rgb(0, 77, 255)',
            ]
        }]
    },
    options: {
            tooltips: {
                mode: 'label',
                callbacks: {
                    label: function(tooltipItem, data) {
                        return data['datasets'][0]['data'][tooltipItem['index']] + '%';
                    }
                }
            }
          }

});
</script>
<?php
}
?>
</body>
</html>
<?php
  }
}
else
{
  echo "<script>alert('Username/Password is required')</script>";
    echo "<script>window.location.href = '../Error/404error.php'</script>";
}
?>