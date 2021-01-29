<?php
session_start();
include'../connection/connect.php';
if (isset($_SESSION['user_id'])) 
{
	$test=$_SESSION['user_id'];
	$role='';
	$user_status_id='';
	$sql1="SELECT * FROM t_user WHERE user_id='".$test."'";
	$result1=mysqli_query($conn,$sql1);
	while ($row1=mysqli_fetch_array($result1)) 
	{
		$user_id=$row1['user_id'];
		$username=$row1['username'];
		$password=$row1['password'];
		$fname=$row1['fname'];
		$mname=$row1['mname'];
		$lname=$row1['lname'];
		$office_position=$row1['office_position'];
		$role_id=$row1['role_id'];
		$user_status_id=$row1['user_status_id'];

		if($user_status_id == 1)
		{
			$role='Administrator';
		}
		elseif($user_status_id == 2)
		{
			$role='User';
		}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profile Information</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script src="../js/jquery-3.2.1.min.js"></script>
  <link href="../css/hover.css" rel="stylesheet" media="all">
  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"></head>
  <script type="text/javascript" src="../js/jquery.dataTables.js"></script>
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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $fname.' '.$lname;?> <span class="caret"></span></a>
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
<div class="row-offcanvas row-offcanvas-left">
  <div id="main" style="padding-top: 2%; padding-right: 3%; padding-left: 5%;">
  <ol class="breadcrumb" style="background-color:white;border-radius: 15px;">
      <li class="breadcrumb-item">
        <a href="../pages/dashboard.php?user_id=<?=$row1['user_id'];?>" style="font-size:20px;"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
      </li>
      <li class="breadcrumb-item active" style="font-size:20px; color:black;"><i class="fa fa-user-o" aria-hidden="true"></i> Profile Information</li>
  </ol>
      <div class="col-md-12">
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
          </p>
          <br>
          <div class="row">
            <div class="panel panel-default">
                <div class="panel-body" style="height: 425px;">
                  <div class="container">
                    <div class="tab">
                      <button class="tablinks" onclick="openForm(event, 'UserProfile')" id="defaultOpen"><i class="fa fa-user" aria-hidden="true"></i> Personal</button>
                      <button class="tablinks" onclick="openForm(event, 'ChangePassword')"><i class="fa fa-lock" aria-hidden="true"></i> Security</button>
                    </div>
                    <div id="UserProfile" class="tab-content">
                      <div class="container-fluid">
                        <form action="../script/update_profile.php" method="POST">
                          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                          <div class="form-group row">
                            <label for="fname" class="col-sm-2">First Name:</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $fname; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="mname" class="col-sm-2">Middle Name:</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" value="<?php echo $mname; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="lname" class="col-sm-2">Last Name:</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="username" class="col-sm-2">Username:</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="position" class="col-sm-2">Position:</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" id="position" name="office_position" value="<?php echo $office_position; ?>">
                            </div>
                          </div>
                          <div>
                            <button type="submit" class="btn btn-primary btn-md" id="submit" name="submit"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                          </div><!--Save button-->
                        </form>
                      </div>
                      <span onclick="this.parentElement.style.display='none'"></span>
                    </div><!--/tab content-->


                    <div id="ChangePassword" class="tab-content">
                      <div class="container-fluid">
                        <form action="../script/update_password.php" method="POST">
                          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                          <div class="form-group row">
                            <label for="password" class="col-sm-2">Current Password:</label>
                            <div class="col-sm-5">
                              <input type="password" class="form-control" id="password" name="password" placeholder="Currrent Password" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="new_password" class="col-sm-2">New Password:</label>
                            <div class="col-sm-5">
                              <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="confirm_password" class="col-sm-2">Confirm Password:</label>
                            <div class="col-sm-5">
                              <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                            </div>
                          </div>
                          <div>
                            <button type="submit" class="btn btn-primary btn-md" id="submit" name="submit"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                          </div><!--Save button-->
                        </form>
                      </div>
                      <span onclick="this.parentElement.style.display='none'"></span> 
                    </div><!--Tab content-->
                  </div><!--Containe-->
                </div><!--Panel-body-->
              </div><!--Panel-default-->
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
  $('#dataTable').dataTable();

}); 

</script>
<script src="../popper/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script>
    function openForm(evt, User) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(User).style.display = "block";
    evt.currentTarget.className += " active";
}
  </script>
  <script>
    document.getElementById("defaultOpen").click();
  </script>
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
  echo "<script>alert('Username/Password is required')</script>";
    echo "<script>window.location.href = '../Error/404error.php'</script>";
}

?>