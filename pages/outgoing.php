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
  <title>Outgoing Communications</title>
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
<div class="row-offcanvas row-offcanvas-left">
  <div id="sidebar" class="sidebar-offcanvas" style=" padding-top: 3%;">
      <div class="col-md-12">
        <a class="btn btn-default btn-sm btn-block" style="background-color: lightgray;" data-toggle="modal" data-target="#addModal" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Add Data</a>
        <hr />
        <ul class="nav nav-pills nav-stacked">
          <li>
              <a href="../pages/bill.php?user_id=<?=$row['user_id'];?>" style="font-size:20px; color:black; text-decoration: none;"><i class="fa fa-money" aria-hidden="true" style="color:black;"></i> Bills</a>
            </li>
            <li>
              <a href="../pages/voucher.php?user_id=<?=$row['user_id'];?>" style="font-size:20px; color:black; text-decoration: none;"><i class="fa fa-book" aria-hidden="true" style="color:black;"></i> Vouchers</a>
            </li>
            <li>
              <a  href="../pages/incoming.php?user_id=<?=$row['user_id'];?>" style="font-size:20px; color:black; text-decoration: none;"><i class="fa fa-inbox" aria-hidden="true" style="color:black;"></i> Incoming</a>
            </li>
            <li class="active">
              <a href="../pages/outgoing.php?user_id=<?=$row['user_id'];?>" style="font-size:20px; color:black; text-decoration: none;"><i class="fa fa-paper-plane" aria-hidden="true" style="color:black;"></i> Outgoing</a>
            </li>
          <hr />
        </ul>
      </div>
  </div>
  <div id="main" style="overflow:auto; padding-top: 2%;">
  <ol class="breadcrumb" style="background-color:white;border-radius: 15px;">
      <li class="breadcrumb-item">
        <a href="../pages/dashboard.php?user_id=<?=$row['user_id'];?>" style="font-size:20px;"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
      </li>
      <li class="breadcrumb-item active" style="font-size:20px; color:black;"><i class="fa fa-paper-plane" aria-hidden="true" style="color: black;"></i> Outgoing Communications Records</li>
  </ol>
      <div class="col-md-12">
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
          </p>
          <br>
          <div class="row">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-hover" id="dataTable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Sender</th>
                        <th>Addressee</th>
                        <th>Date Released</th>
                        <th>Reference Number</th>
                        <th width="28%">Remarks</th>
                        <th width="17%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        date_default_timezone_set("Asia/Kuala_Lumpur");
                        $current_date=date('Y-m-d');
                        $due='';
                        $x=1;
                        $sql="SELECT t_files.file_id,t_files.filename,t_files.filetype,t_files.filesize,t_files.filepath,t_outgoing.outgoing_id,t_outgoing.outgoing_sender,t_outgoing.outgoing_addressee,t_outgoing.date_released, t_outgoing.outgoing_reference_number,t_outgoing.outgoing_remarks FROM t_outgoing LEFT JOIN t_files ON t_files.outgoing_id = t_outgoing.outgoing_id ORDER BY outgoing_id DESC";
                        $result=mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                        while($row=mysqli_fetch_array($result))
                          {

                              $outgoing_id=$row['outgoing_id'];
                              $outgoing_sender=$row['outgoing_sender'];
                              $outgoing_addressee=$row['outgoing_addressee'];
                              $date_released=$row['date_released'];
                              $outgoing_reference_number=$row['outgoing_reference_number'];
                              $outgoing_remarks=$row['outgoing_remarks'];
                              $file_id=$row['file_id'];
                              $filename=$row['filename'];
                              $filetype=$row['filetype'];
                              $filesize=$row['filesize'];
                              $filepath=$row['filepath'];
                              if(empty($outgoing_reference_number))
                              {
                                $outgoing_reference_number='N/A';
                              }
                      ?>
                      <tr>
                        <td><?php echo $x; $x++; ?></td>
                        <td><?php echo $outgoing_sender; ?></td>
                        <td><?php echo $outgoing_addressee; ?></td>
                        <td><?php echo $date_released; ?></td>
                        <td><?php echo $outgoing_reference_number; ?></td>
                        <td><?php echo $outgoing_remarks; ?></td>
                        <td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#<?php echo $outgoing_id; ?>" id="viewModal" ><i class="fa fa-eye" aria-hidden="true" style="color:black;"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <div id="<?php echo $outgoing_id; ?>" class="modal fade" role="dialog">
                              <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color: #2F4F4F;">
                                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                                    <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                                    <h4 class="modal-title pull-left"><i class="fa fa-info-circle" aria-hidden="true"></i> <b style="color:white;">Outgoing Communication Information</b>
                                  </div>
                                  <div class="modal-body" style="width:50%;">
                                    <div class="container">
                                      <div class="row">
                                        <div class="col-sm-5">
                                            <form action="../script/edit_outgoing.php" method="POST" class="form-horizontal" id="edit_outgoing_form"
                                            enctype="multipart/form-data">
                                              <input type="hidden" name="outgoing_id" value="<?php echo $outgoing_id; ?>">
                                              <div class="form-group">
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-md-3" for="outgoing_sender"><h6><b>Sender:</b></h6></label>
                                                <div class="col-sm-6">
                                                  <input type="text" class="form-control" style="width:;" name="outgoing_sender" id="sender" value="<?php echo $outgoing_sender; ?>" required>
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-sm-3" for="outgoing_addressee"><h6><b>Addressee:</b></h6></label>
                                                <div class="col-sm-6">
                                                  <input type="text" class="form-control" name="outgoing_addressee" id="outgoing_addressee" placeholder="Addressee" value="<?php echo $outgoing_addressee; ?>" required>
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-sm-3" for="date_released"><h6><b>Date Released:</b></h6></label>
                                                <div class="col-sm-6">
                                                  <input type="date" min="2010-01-01"  max="<?=date('Y-m-d');?>" class="form-control" name="date_released" id="date_released" required value="<?php echo $date_released; ?>">
                                                </div>
                                              </div>
                                                <div class="form-group">
                                                  <label class="control-label col-sm-3" for="outgoing_reference_number"><h6><b>Reference Number:</b></h6></label>
                                                  <div class="col-sm-6">
                                                    <input type="number" class="form-control" id="outgoing_reference_number" name="outgoing_reference_number" id="outgoing_reference_number" placeholder="Reference Number" value="<?php echo $outgoing_reference_number; ?>" required>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="control-label col-sm-3" for="outgoing_remarks"><h6><b>Remarks</b></h6></label>
                                                  <div class="col-sm-6">
                                                    <textarea type="text" rows="5" class="form-control" name="outgoing_remarks" id="remarks" placeholder="Remarks" required><?php echo $outgoing_remarks; ?></textarea>
                                                  </div>
                                                </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="thumbnail" style="width:300px;height:350px;">
                                              <object style="height:50%; width:90%;" data="<?php echo $filepath; ?>">
                                               <?php 

                                                  if(empty($filepath))
                                                  {
                                                    echo "<img style='width:50%;' src='../icon/broken.png'>";
                                                  }

                                                ?>
                                              </object>
                                             <div style="text-align: left;" class="caption">
                                                <ul style="list-style: none;">
                                                  <li>File ID:<?php echo $file_id; if(empty($file_id)){echo "Not Available";} ?></li>
                                                  <li class="name" style="text-overflow: ellipsis;  white-space: nowrap; max-width: 200px;overflow: hidden;"><b>Name:</b><?php echo $filename; if(empty($filename)){echo "Not Available";} ?></li>
                                                 <li><b>Type:</b><?php echo $filetype; if(empty($filetype)){echo "Not Available";} ?></li>
                                                  <li><b>Size:</b><?php echo $filesize; if(empty($filesize)){echo "Not Available";} ?></li>
                                                </ul>
                                                <p>
                                                  <?php
                                                  if(!empty($filepath))
                                                  {
                                                  ?>
                                                    <a href="<?php echo $filepath; ?>" target="_blank" class="btn btn-default pull-right" role="button"><i class="fa fa-pencil-square" aria-hidden="true"></i> View</a>
                                                 <?php 
                                                  }
                                                  else
                                                  {
                                                  ?>
                                                    <a href="#" class="btn btn-default pull-right" role="button" disabled><i class="fa fa-pencil-square" aria-hidden="true"></i> View</a>
                                                  <?php  
                                                  }
                                                  ?>

                                                  <a class="btn btn-danger btn-sm" href="../script/delete_outgoing_file.php?file_delete=<?=$row['file_id']; ?>" data-toggle="tooltip" title="Delete" onclick="return confirm('This will delete the record permanently. Click OK to continue');"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                                </p>
                                              </div>
                                            </div>
                                            <input type="file" name="file" id="id" accept="application/pdf" />
                                              <script type="text/javascript">
                                                  var file = document.getElementById('id');

                                                  file.onchange = function(e){
                                                  var ext = this.value.match(/\.([^\.]+)$/)[1];
                                                  switch(ext)
                                                  {
                                                      case 'pdf':
                                                      //alert('allowed');
                                                      break;
                                                      default:
                                                      alert('Upload PDF File Only');
                                                      this.value='';
                                                  }
                                                  };
                                                </script>
                                        </div><!--END OF THUMBNAIL-->
                                      </div>
                                    </div>
                                  </div><!--/Modal Body-->
                                  <div class="modal-footer">
                                    <div>
                                      <button type="submit" id="Editsubmit" name="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save" aria-hidden="true"></i> <b>Save</b></button>
                                    </div>
                                  </div>
                                          </form>
                                      </div>
                                    </div><!--END OF EDIT BILL INFO-->
                                  </div><!--END Modal Body-->
                                  </div><!--END OF UPLOADED FILE-->
                                </div><!--END OF BILL INFORMATION-->
                              </div>
                            </div>

                            <a class="btn btn-danger" href="../script/delete_outgoing.php?delete=<?=$row['outgoing_id']; ?>"onclick="return confirm('This will delete the record permanently. Click OK to continue');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
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

    <div id="addModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="background-color: #2F4F4F;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><i class="fa fa-info-circle" aria-hidden="true"></i> <b style="color:white;">Add Outgoing Information</b></h4>
          </div>
          <div class="modal-body">
            <form action="../script/add_outgoing.php" method="POST" enctype="multipart/form-data" autocomplete="on" name="outgoing_form" onsubmit="return(validate());">
               <div class="form-group">
                  <label for="sender">Sender:</label>
                  <input type="text" class="form-control" name="outgoing_sender" placeholder="Sender" id="sender">
               </div>
              <div class="form-group">
                  <label for="addressee">Addressee</label>
                  <input type="text" class="form-control" name="outgoing_addressee" placeholder="Addressee">
              </div>
              <div class="form-group">
                  <label for="date_released">Date Released&nbsp;<span style="color:red;">(day-month-year)</span></label>
                  <input type="date" min="2010-01-01" max="<?=date('Y-m-d');?>" class="form-control" name="date_released" id="received" required>
                </div>
                <div class="form-group">
                  <label for="reference">Reference Number</label>
                  <input type="number" class="form-control" name="outgoing_reference_number" id="reference" placeholder="Reference Number">
                </div>
                <div class="form-group">
                  <label for="outgoing_remarks">Remarks</label>
                  <textarea type="text" rows="5" class="form-control" name="outgoing_remarks" id="remarks" placeholder="Remarks" required></textarea>
                </div>
                <div>
                  <input type="file" name="file" id="fileid" accept="application/pdf" />
                  <script type="text/javascript">
                 var file = document.getElementById('fileid');

                  file.onchange = function(e){
                      var ext = this.value.match(/\.([^\.]+)$/)[1];
                      switch(ext)
                      {
                          case 'pdf':
                              //alert('allowed');
                              break;
                          default:
                              alert('Upload PDF File Only');
                              this.value='';
                      }
                  };
              </script>
                </div>
          </div><!--/Modal Body-->
          <div class="modal-footer">
            <button type="reset" class="btn btn-danger pull-left"><i class="fa fa-repeat" aria-hidden="true"></i> Clear</button>
            <button type="submit" id="submit" name="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
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
<script type="text/javascript">
  $(document).ready(function(){
  $('#dataTable').dataTable({
    "info":false
  });

}); 

</script>
<script src="../popper/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script type="text/javascript">
  function validate()
  {
    if (document.incoming_form.sender.value == "")
    {
      alert("Please enter the name of the Sender");
      document.incoming_form.sender.focus();
      return false;
    }
    if(document.incoming_form.addressee.value == "")
    {
      alert("Please don't forget the Addressee ");
      document.incoming_form.addressee.focus();
      return false;
    }
  }
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