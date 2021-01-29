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
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <script src="../js/bootstrap.js"></script>
  <script src="../js/jquery-3.2.1.min.js"></script>
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
        <a href="../pages/home.php?user_id=<?=$row['user_id'];?>" style="font-size:20px;"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
      </li>
      <li class="breadcrumb-item active" style="font-size:20px; color:black;"><i class="fa fa-cog" aria-hidden="true"></i> Administrator Panel</li>
  </ol>
      <div class="col-md-12">
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
          </p>
          <br>
          <div class="row col-md-7 col-md-offset-3">
            <div class="panel panel-default">
              <div class="panel-heading"></div>
              <div class="panel-body">
                <div>
                  <a class="nav-link" href="../pages/manage_users.php?user_id=<?=$row['user_id'];?>" style="font-size:150%; text-decoration: none; cursor: pointer;">
                    <i class="fa fa-users" aria-hidden="true" style="color: black;"></i> 
                    <span class="nav-link-text" style="color:black; font-size:150%; cursor:pointer;">Manage Users</span>
                  </a>
                </div>
                <br>
                <div>
                  <a href="../pages/log.php?user_id=<?=$row['user_id'];?>" style="font-size:150%; text-decoration: none; cursor: pointer;">
                    <i class="fa fa-calendar" aria-hidden="true" style="color: black;"></i> 
                    <span class="nav-link-text" style="color:black; font-size:150%; cursor:pointer;">Logs</span>
                  </a>
                </div>
                <br>
                <div>
                  <a href="http://localhost/phpmyadmin/" target="_blank" style="font-size:190%; color:black; text-decoration: none; cursor: pointer;"><i class="fa fa-database" aria-hidden="true" style="color: black;"></i> Database</a>
                </div>
                <br>
                 <div>
                  <a href="../pages/export_data_bills.php?user_id=<?=$row['user_id'];?>" style="font-size:150%; text-decoration: none; cursor: pointer;">
                    <i class="fa fa-download" aria-hidden="true" style="color: black;"></i> 
                    <span class="nav-link-text" style="color:black; font-size:150%; cursor:pointer;">Export Data</span>
                  </a>
                </div>
                <br>
                <div>
                  <a href="../pages/dashboard.php?user_id=<?=$row['user_id'];?>" style="font-size:150%; text-decoration: none; cursor: pointer;">
                    <i class="fa fa-tachometer" aria-hidden="true" style="color: black;"></i> 
                    <span class="nav-link-text" style="color:black; font-size:150%; cursor:pointer;">Dashboard</span>
                  </a>
                </div>
              </div>
              <div class="panel-footer"></div>
            </div>
          </div><!--Row-->
      </div>
  </div>
</div><!--/row-offcanvas -->
</div><!--/Main Content-->


<div id="modalbackup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-database" aria-hidden="true" style="color: black;"></i> Database Backup</h4>
      </div>
      <div class="modal-body">
        <form action="../script/database_backup.php?user_id=<?=$row['user_id'];?>">
          <p>Back-up the database?</p>
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-primary">Proceed</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
      </div>
        </form>
    </div>
  </div>
</div>




<div id="modalrestore" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-refresh" aria-hidden="true" style="color: black;"></i> Database Restore</h4>
      </div>
      <div class="modal-body">
        <form action="../script/database_restore.php" method="POST" enctype="multipart/form-data">
          <p>Restore the database?</p>
          <div>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <span>Browse your computer:<input type="file" name="file" id="file"/></span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-primary">Proceed</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
      </div>
        </form>
    </div>
  </div>
</div>


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