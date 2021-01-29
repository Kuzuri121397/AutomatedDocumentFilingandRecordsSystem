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
  <title>Manage Users</title>
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
  <div id="main" style="overflow:auto; padding-top: 2%; padding-right:5%; padding-left:5%;">
  <ol class="breadcrumb" style="background-color:white; width:100%; border-radius: 15px; ">
      <li class="breadcrumb-item">
        <a href="../pages/dashboard.php?user_id=<?=$row['user_id'];?>" style="font-size:20px;"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
      </li>
      <li class="breadcrumb-item active" style="font-size:20px; color:black;"><i class="fa fa-users" aria-hidden="true" style="color: black;"></i> Manage Users</li>
  </ol>
      <div class="col-md-12">
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
          </p>
          <br>
          <div class="row">
            <div class="panel panel-default">
              <div class="panel-heading" style="padding-right:3%;">
                <div class="row">
                  <div class="pull-right">
                    <button class="btn btn-default" data-toggle="modal" data-target="#add_new_user" aria-hidden="true">Add New User</button>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-hover" id="dataTable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th width="15%">First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Access Level</th>
                        <th width="11%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                          $x=1;
                          $user_status='';
                          $role='';
                          $sql1="SELECT t_role.role_id, t_role.role_type, t_status.user_status_id, t_status.user_status, t_user.user_id, t_user.fname, t_user.mname, t_user.lname, t_user.username, t_user.role_id, t_user.user_status_id, t_user.office_position FROM t_user LEFT JOIN t_role ON t_role.role_id = t_user.role_id LEFT JOIN t_status ON t_status.user_status_id = t_user.user_status_id ORDER BY t_role.role_id = 2, t_user.user_status_id = 1 DESC";
                          $result2=mysqli_query($conn, $sql1)or die("database error:". mysqli_error($conn));
                          while($row=mysqli_fetch_array($result2)) 
                          {
                            $user_id=$row['user_id'];
                            $role_id=$row['role_id'];
                            $role_type=$row['role_type'];
                            $user_status_id=$row['user_status_id'];
                            $office_position=$row['office_position'];
                            $fname=$row['fname'];
                            $mname=$row['mname'];
                            $lname=$row['lname'];
                            $username=$row['username'];
                            if($user_status_id == 1)
                            {
                              $user_status = 'Active';
                            }
                            elseif($user_status_id == 2)
                            {
                              $user_status = 'InActive';
                            }

                            if($role_id == 1)
                            {
                              $role = 'Administrator';
                            }
                            elseif($role_id == 2)
                            {
                              $role = 'User';
                            }
                          
                      ?>
                      <tr>
                        <td><?php echo $x; $x++; ?></td>
                        <td><?php echo $fname; ?></td>
                        <td><?php echo $mname; ?></td>
                        <td><?php echo $lname; ?></td>
                        <td><?php echo $username; ?></td>
                        <td><?php echo $office_position; ?></td>
                        <td><?php echo $user_status; ?></td>
                        <td><?php echo $role_type; ?></td>
                        <td>
                              <?php
                                if($user_status_id == 2)
                                {
                              ?>
                              <a class="btn btn-danger" data-toggle="tooltip" title="In-active User" href="../script/activate_user.php?inactive=<?=$row['user_id']; ?>" onclick="return confirm('Activate this User?. Click OK to continue');"><i class="fa fa-user-times" aria-hidden="true"></i></a>
                              <?php
                                }
                                elseif($user_status_id == 1)
                                {
                              ?>
                              <button class="btn btn-success" data-toggle="modal" data-target="#<?php echo $user_id; ?>" id="viewModal"><i class="fa fa-eye" aria-hidden="true" style="color:black;"></i></button>&nbsp;
                              <div id="<?php echo $user_id; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header" style="background-color: #2F4F4F;">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title" style="color:white; text-align: left;"><i class="fa fa-user" aria-hidden="true" style="color: white;"></i> User Information</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form class="form-horizontal" action="../script/edit_profile.php" method="POST">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="fname">First Name:</label>
                                          <div class="col-xs-9">
                                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="mname">Middle Name:</label>
                                          <div class="col-xs-9">
                                            <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $mname; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="lname">Last Name:</label>
                                          <div class="col-xs-9">
                                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="username">UserName:</label>
                                          <div class="col-xs-9">
                                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="position">Position:</label>
                                          <div class="col-xs-9">
                                            <input type="text" class="form-control" id="position" name="office_position" value="<?php echo $office_position; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="access_level">Access Level:</label>
                                          <div class="col-xs-9">
                                            <select name="role_id" class="form-control" id="role">
                                              <option><?php echo $role; ?></option>
                                              <option  value="2">User</option>
                                              <option  value="1">Administrator</option>
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Save</button>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                                    </div>
                                      </form>
                                  </div>
                                </div>
                              </div>
                              <a class="btn btn-danger" data-toggle="tooltip" title="Deactivate User" href="../script/deactivate_user.php?inactive=<?=$row['user_id']; ?>"onclick="return confirm('Deactivate this User?. Click OK to continue');"><i class="fa fa-times-circle" aria-hidden="true"></i></a>

                              <?php
                                }
                                elseif($user_status_id == 1 && $role_id == 2)
                                {
                              ?>
                              <button  class="btn btn-success" data-toggle="modal" data-target="#<?php echo $user_id; ?>" id="viewModal"><i class="fa fa-eye" aria-hidden="true" style="color:black;"></i></button>&nbsp;
                              <div id="<?php echo $user_id; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header" style="background-color: #2F4F4F;">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title" style="color:white; text-align: left;"><i class="fa fa-user" aria-hidden="true" style="color: white;"></i> User Information</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form class="form-horizontal" action="../script/edit_profile.php" method="POST">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="fname">First Name:</label>
                                          <div class="col-xs-9">
                                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="mname">Middle Name:</label>
                                          <div class="col-xs-9">
                                            <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $mname; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="lname">Last Name:</label>
                                          <div class="col-xs-9">
                                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="username">UserName:</label>
                                          <div class="col-xs-9">
                                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="position">Position:</label>
                                          <div class="col-xs-9">
                                            <input type="text" class="form-control" id="position" name="office_position" value="<?php echo $office_position; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="access_level">Access Level:</label>
                                          <div class="col-xs-9">
                                            <select name="role_id" class="form-control" id="role">
                                              <option><?php echo $role; ?></option>
                                              <option  value="2">User</option>
                                              <option  value="1">Administrator</option>
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Save</button>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                                    </div>
                                      </form>
                                  </div>
                                </div>
                              </div>
                              <a class="btn btn-danger" data-toggle="tooltip" title="Deactivate User" href="../script/deactivate_user.php?inactive=<?=$row['user_id']; ?>"onclick="return confirm('Deactivate this User?. Click OK to continue');"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                              <?php
                                }
                              ?>
                        </td>
                      </tr>
                    <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div><!--Table-responsive-->
              </div><!--Panel body-->
            </div>





          </div><!--Row-->
      </div>
  </div>
</div><!--/row-offcanvas -->
</div><!--/Main Content-->


<div id="add_new_user" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #2F4F4F;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white;"><i class="fa fa-user" aria-hidden="true" style="color: white;"></i> Add New User</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="../script/add_user.php" method="POST">
          <div class="form-group">
            <label class="control-label col-sm-2" for="fname">First Name:</label>
            <div class="col-xs-9">
              <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="mname">Middle Name:</label>
            <div class="col-xs-9">
              <input type="text" class="form-control" name="mname" id="mname" placeholder="Middle Name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="lname">Last Name:</label>
            <div class="col-xs-9">
              <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="username">UserName:</label>
            <div class="col-xs-9">
              <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="office_position">Position:</label>
            <div class="col-xs-9">
              <input type="text" class="form-control" name="office_position" id="office_position" placeholder="Office Position">
            </div>
          </div>
          <input type="hidden" class="form-control" name="role_id" id="role_id" value="2">
          <input type="hidden" class="form-control" name="user_status_id" id="user_status_id" value="1">
          <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password:</label>
            <div class="col-xs-9">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="confirm_password">Confirm Password:</label>
            <div class="col-xs-9">
              <input type="password" class="form-control" name="confirm" id="confirm_password" placeholder="Confirm Password">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Save</button>
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
  $('#dataTable').dataTable({
    "info":false
  });

}); 

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
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
</body>
</html>
<?php
  }
}
else
{
  echo "<script>alert('username and Password Required')</script>";
   echo "<script>window.location.href = '../Error/404error.php'</script>";
}
?>