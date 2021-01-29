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
      $role_id=$row['role_id'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Incoming</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <script src="../js/bootstrap.js"></script>
  <script src="../js/jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"></head>
  <link rel="stylesheet" type="text/css" href="../js/modifiers/Buttons-1.4.2/css/buttons.bootstrap.css">
  <script type="text/javascript" src="../js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="../js/modifiers/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/Buttons-1.4.2/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/JSZip-2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/pdfmake-0.1.32/pdfmake.js"></script>
  <script type="text/javascript" src="../js/modifiers/JSZip-2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/Buttons-1.4.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/Buttons-1.4.2/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/Buttons-1.4.2/js/buttons.colVis.js"></script>
  <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
              <li class="divider"></li>
             <li><a data-toggle="modal" data-target="#modalLogout" style="cursor: pointer;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
          </li>

        </ul>
      </div>
    </nav><!--end of navbar-->
  </div><!--End of Head-->

  <div id="main" style="overflow:auto; padding-top: 2%;">
  <ol class="breadcrumb" style="background-color:white; width:100%; border-radius: 15px;">
      <li class="breadcrumb-item">
        <a href="../pages/dashboard.php?user_id=<?=$row['user_id'];?>" style="font-size:20px;"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
      </li>
      <li class="breadcrumb-item active" style="font-size:20px; color:black;"><i class="fa fa-download" aria-hidden="true"></i> Export Data for Vouchers</li>
  </ol>
      <div class="col-md-12">
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
          </p>
          <br>
          <div class="row col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="btn-group">
                  <a href="../pages/export_data_bills.php?id=<?=$row['user_id'];?>" role="button" class=" col-md-3 btn btn-primary">Bills</a>
                  <a href="../pages/export_data_vouchers.php?id=<?=$row['user_id'];?>" role="button" class="col-md-3 btn btn-primary">Vouchers</a>
                  <a href="../pages/export_data_incoming.php?id=<?=$row['user_id'];?>" role="button" class="btn btn-danger">Incoming Communications</a>
                  <a href="../pages/export_data_outgoing.php?id=<?=$row['user_id'];?>" role="button" class="btn btn-primary">Outgoing Communications</a>
                </div>
              </div>
              <div class="panel-body">
                  <div class="table-responsive">
                  <table class="table table-hover" id="dataTable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th width="15%">Sender</th>
                        <th width="10%">Addressee</th>
                        <th>Date Received</th>
                        <th>Scheduled Event</th>
                        <th>Reference Number</th>
                        <th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        date_default_timezone_set("Asia/Kuala_Lumpur");
                        $current_date=date('Y-m-d');
                        $due='';
                        $x=1;
                        $sql="SELECT t_files.file_id,t_files.filename,t_files.filetype,t_files.filesize,t_files.filepath,t_incoming.incoming_id,t_incoming.incoming_sender,t_incoming.incoming_addressee,t_incoming.date_received,t_incoming.scheduled_event,t_incoming.incoming_reference_number,t_incoming.incoming_remarks FROM t_incoming LEFT JOIN t_files ON t_files.incoming_id = t_incoming.incoming_id ORDER BY incoming_id DESC";
                        $result=mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                        while($row=mysqli_fetch_array($result))
                          {

                              $incoming_id=$row['incoming_id'];
                              $sender=$row['incoming_sender'];
                              $addressee=$row['incoming_addressee'];
                              $date_received=$row['date_received'];
                              $scheduled_event=$row['scheduled_event'];
                              $reference_number=$row['incoming_reference_number'];
                              $remarks=$row['incoming_remarks'];
                              $file_id=$row['file_id'];
                              $filename=$row['filename'];
                              $filetype=$row['filetype'];
                              $filesize=$row['filesize'];
                              $filepath=$row['filepath'];
                              if($scheduled_event == '0000-00-00')
                                {
                                  $scheduled_event='N/A';
                                }
                      ?>
                      <tr>
                        <td><?php echo $x; $x++; ?></td>
                        <td><?php echo $sender; ?></td>
                        <td><?php echo $addressee; ?></td>
                        <td><?php echo $date_received; ?></td>
                        <td><?php echo $scheduled_event; ?></td>
                        <td><?php echo $reference_number; ?></td>
                        <td><?php echo $remarks; ?></td>
                      </tr>
                    <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div><!--Table-responsive-->
              </div>
              <div class="panel-footer"></div>
            </div>
          </div><!--Row-->
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
<script type="text/javascript" src="../js/modifiers/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/Buttons-1.4.2/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/JSZip-2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/pdfmake-0.1.32/pdfmake.js"></script>
  <script type="text/javascript" src="../js/modifiers/JSZip-2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/Buttons-1.4.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/Buttons-1.4.2/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="../js/modifiers/Buttons-1.4.2/js/buttons.colVis.js"></script>
<script type="text/javascript" src="../js/bill.js"></script>
<script>
  $('#dataTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel','print'
    ],"info":false
} );
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
<script src="../js/jquery-3.2.1.min.js"></script>
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