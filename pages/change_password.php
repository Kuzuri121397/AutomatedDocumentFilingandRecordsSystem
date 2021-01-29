<?php
session_start();
include'../connection/connect.php';
include'../script/auth2.php';
if (isset($_SESSION['administrator_code'])) 
{
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Password Recovery</title>
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
    </nav><!--end of navbar-->
  </div><!--End of Head-->
<div class="row-offcanvas row-offcanvas-left">
  <div id="main" style="padding-top: 2%; padding-right: 3%; padding-left: 5%;">
  <ol class="breadcrumb" style="background-color:white;border-radius: 15px;">
      <li class="breadcrumb-item">
        <a href="../script/destroy_admin_code.php" style="font-size:20px;"><i class="fa fa-home" aria-hidden="true"></i> Login</a>
      </li>
      <li class="breadcrumb-item active" style="font-size:20px; color:black;"><i class="fa fa-refresh" aria-hidden="true"></i> Change Password</li>
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
                    <div class="table-responsive">
                      <table class="table table-hover" id="dataTable">
            <thead>
              <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>User Name</th>
                <th>Position</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                include'../connection/connect.php';


                $x=1;
                $sql="SELECT * FROM t_user";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($result))
                {

                  $user_id=$row['user_id'];
                  $username=$row['username'];
                  $fname=$row['fname'];
                  $mname=$row['mname'];
                  $lname=$row['lname'];
                  $role_id=$row['role_id'];

                  if ($role_id == 1) 
                  {
                    $role_type="Administrator";
                  }
                  elseif ($role_id==2) 
                  {
                    $role_type="User";
                  }
                  
              ?>
              <tr>
                <td><?php echo $x; $x++; ?></td>
                <td><?php echo $fname; ?></td>
                <td><?php echo $mname; ?></td>
                <td><?php echo $lname; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $role_type; ?></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#<?php echo $user_id; ?>">Change Password</button>
                  </div>
                </td>
              </tr>
              <!-- Modal -->
              <div id="<?php echo $user_id; ?>" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: #2F4F4F;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title" style="color:white;">Change Password</h4>
                    </div>
                    <div class="modal-body">
                      <form action="../script/change_forgot_password.php" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <div class="form-group">
                          <label for="password">New Password: &nbsp; &nbsp; &nbsp; </label>
                          <input type="password" class="form-control" id="password" name="password">
                        </div><br>
                        <div class="form-group">
                          <label for="confirm_password">Confirm Password: </label>
                          <input type="password" class="form-control" id="confirm_password" name="confirm">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="submit">Save</button>
                    </div>
                      </form>
                  </div>
                </div>
              </div>
              <?php
                }
              ?>
            </tbody>
          </table>
                    </div>
                  </div><!--Containe-->
                </div><!--Panel-body-->
              </div><!--Panel-default-->
          </div>
      </div>
  </div>
</div><!--/row-offcanvas -->
</div><!--/Main Content-->
</div>
<script src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $('#dataTable').dataTable({
    "info":false
  });
}); 

</script>
<script src="../popper/popper.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>
<?php
}
else
{
  echo "<script>alert('Admiistrator code required')</script>";
    echo "<script>window.location.href = '../Error/404error.php'</script>";
}

?>