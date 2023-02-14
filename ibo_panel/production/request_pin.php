<?php include "config.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Oranga || Request Pin</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
     <!-- Datatables -->
    
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script>
        function showHint(str) {
  
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").value = this.responseText;
    		 // document.getElementById("txtg").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "get_name.php?q=" + str, true);
        xmlhttp.send();
      
        }

    </script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
            <?php include "include/sidebar.php";?>
            
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php include "include/header.php";?>
        <!-- /top navigation -->

        <!-- page content -->
        
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Request E-Pin</h3>
              </div>
            </div>
<?php

if(isset($_GET[s]))
{
    $noti="new PNotify({
                                  title: 'Success',
                                  text: 'Pin Requested',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });";
}
elseif(isset($_GET[f]))
{
    $noti="new PNotify({
                                  title: 'Failed',
                                  text: 'Please Try Again',
                                  type: 'error',
                                  styling: 'bootstrap3'
                              });";
}
elseif(isset($_GET[cs]))
{
    $noti="new PNotify({
                                  title: 'Canceled',
                                  text: 'Pin Requested Canceled',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });";
}


?>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Enter Pin Payment Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <form class="form-horizontal form-label-left" enctype="multipart/form-data" method="post">
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pin Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select name="pin_type" class="form-control "  required> 
                                <optgroup label="Pin Price">
                                 <option value="1">Silver Package - 2700/- (2 Bottle) = 1 pv</option>
                                 
                                 
                                 <option value="2">Silver Package - 3000/- (3 Bottle) = 1 pv</option>
                                 </optgroup>
                            </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pin Qty<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" name="pin" class="form-control "  required>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Select Payment Mode <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select name="p_mode" class="form-control "  required>
                                 <option></option>
                                 <option value="NEFT">NEFT</option>
                                 <option value="RTGS">RTGS</option>
                                 <option value="IMPS">IMPS</option>
                                 <option value="UPI">UPI</option>
                                 <option value="CASH">CASH</option>
                            </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">UTR No.<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" name="txn_id" class="form-control"  required>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Receipt<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="file" name="receipt" class="form-control" required>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="number" name="amount" class="form-control"  required>
                        </div>
                      </div>
                      
                      
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button type="submit" name="submit_dete" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>      
                  <?php
                  if(isset($_POST[submit_dete]))
                  {
                      if($d_detail[a_status]=='n'){
                          $first="Y";
                      }else{
                          $first="N";
                      }
                      
                      ///////////////for creating unique ID
        function unq_id_generate($chars) 
        {
          $data = '123456789';
          return substr(str_shuffle($data), 0, $chars);
        }
        for($x=0; $x<100; $x++)
        {
            //echo $x;
            $unq_id=unq_id_generate(15);
            $sqsqqs="SELECT * FROM `pin_request` WHERE `receipt_img`='$unq_id'";
            $qur=$con->query($sqsqqs);
            if(mysqli_num_rows($qur)==0)
            {
                break;
            }
        }
                      
        if (file_exists("receipt_img/" .$unq_id.".jpg"))
        {
        unlink("receipt_img/" .$unq_id.".jpg");
          echo $unq_id.".jpg" . " already exists. ";
        }
        
        if(move_uploaded_file($_FILES["receipt"]["tmp_name"], "receipt_img/".$unq_id.".jpg"))
		{
		
            echo "Stored in: " . "receipt_img/".$unq_id;
            
            $fui="INSERT INTO `pin_request` (`pr_id`, `d_id`, `date`, `time`, `amount`, `t_mode`, `pin`, `txn_id`, `receipt_img`, `note`, `bank_name`, `acc_no`, `ifsc`, `status`, `c_date`, `c_time`, `pin_type`) VALUES (NULL, '$_SESSION[d_id]', '$date', '$time', '$_POST[amount]', '$_POST[p_mode]', '$_POST[pin]', '$_POST[txn_id]', '$unq_id', 'request by user', '', '', '', 'P', '', '', '$_POST[pin_type]');";
            
                     // $fui="INSERT INTO `pin_request` (`pr_id`, `d_id`, `date`, `time`, `pin_wallet`, `c_date`, `c_time`, `amount`, `pin_qty`, `payment_type`, `txn_no`, `receipt_img`, `status`) VALUES (NULL, '$_SESSION[d_id]', '$date', '$time', '$_POST[pin_type]', '', '', '$_POST[amount]', '$_POST[pin_qty]', '$_POST[p_mode]', '$_POST[txn_id]', '$unq_id', 'P');";
                      
                      if($con->query($fui)===TRUE)
                      {
                          echo "<script>alert('Success! Pin Requested Successfully'); location.href='request_pin.php?s=s';</script>";
                      }else{
                          echo "<script>alert('Failed! Please Try Again'); location.href='request_pin.php?s=f';</script>";
                      }
                  }
                }
                  
                  
                  ?>
                    
                    
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pin Request History</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        
        <div class="card-box table-responsive">
        <table class="table table-striped table-bordered" id="datatable">
            <thead><tr><th width="3%">Req. no.</th><th>Pin Type</th><th>Amount</th><th>Pin</th><th>Payment Mode</th><th>TXN No.</th><th>Status</th><th>View Image</th><th>Clear Date</th>
            <th>Cancel</th></tr></thead>
            <?php
            $a=0;
            $scv="SELECT * FROM `pin_request` WHERE `d_id`='$_SESSION[d_id]' ORDER BY `pin_request`.`pr_id` DESC;";
            $dcdf=$con->query($scv);
            while($gf=mysqli_fetch_assoc($dcdf))
            {
                $a++;
            ?>
            <tr>
                <td><?php echo $gf[pr_id];?></td>
                <td><?php
                switch ($gf[pin_type]) {
  case "1":
    echo "2,700/-";
    break;
  case "2":
    echo "5,400/-";
    break;
  case "3":
    echo "10,800/-";
    break;
  case "4":
    echo "4,050/-";
    break;
  case "5":
    echo "8,100/-";
    break;
  case "6":
    echo "16,200/-";
    break;
}?>
                
                </td>
                <td><?php echo $gf[amount];?>/-</td>
                <td><?php echo $gf[pin];?></td>
                <td><?php echo $gf[t_mode];?></td>
                <td><?php echo $gf[txn_id];?></td>
                <td><?php if($gf[status]=='P'){?>
                <button class="btn btn-warning">Pending</button>
                <?php }
                elseif($gf[status]=='C'){?>
                <button class="btn btn-danger">Cancelled</button>
                <?php }elseif($gf[status]=='R'){?>
                <button class="btn btn-danger">Rejected</button>
                <?php }elseif($gf[status]=='S'){?>
                <button class="btn btn-success">Accepted</button>
                <?php }?></td>
                <td><a href="receipt_img/<?php echo $gf[receipt_img];?>.jpg" target="_blank">View Receipt</a></td>
                <td><?php echo $gf[c_date];?></td>
                <td><?php if($gf[status]=='P'){?>
                <button class="btn btn-danger">Cancel Request</button>
                <?php }?></td>
            </tr>
            <?php
            }?>
            
        </table>
        
           </div>         
                    
                    
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <?php include "include/footer.php";?>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
