<?php
session_start();
include'../connection/connect.php';
if(isset($_SESSION['user_id']))
{
  session_destroy();
}
elseif(isset($_SESSION['administrator_code']))
{
  session_destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>A.D.F.R.S.|Login</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script src="../js/jquery-3.2.1.js"></script>
  <link rel="stylesheet" href="../css/login.css">
  <link href="../icon/nbi.png" rel="icon"/>
</head>
<body>
       <div class="container" style="margin-top:40px">
    <div class="row">
      <div class="col-sm-6 col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>NBI-EVRO Automated Document Filing and Records System</strong>
          </div>
          <div class="panel-body">
            <form role="form" action="../script/loginprocess.php" method="POST">
              <fieldset>
                <div class="row">
                  <div class="center-block">
                    <img class="profile-img"
                      src="../icon/nbi.png" alt="NBI">
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user" aria-hidden="true"></i>
                        </span> 
                        <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="submit" class="btn btn-lg btn-primary" value="Log in">
                    </div>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
          <div class="panel-footer ">
            Forgot <a data-toggle="modal" data-target="#recovery" style="cursor:pointer;"> password? </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div id="recovery" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #2F4F4F;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="../script/recovery_process.php" method="POST">
          <p>*Please enter the Administrator code to continue</p>
          <input type="password" name="code">
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </div>
        </form>
    </div>
  </div>
</div>
  <script src="../js/jquery-3.2.1.js"></script>
  <script src="../js/bootstrap.js"></script>
</body>
</html>
