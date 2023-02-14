
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

    <title>Oranga ||Pin Wallet Ledger View</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="extra.css" rel="stylesheet">
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
                <h3> 4500/- Pins Ledger View</h3>
              </div>
              <div class="title_right">
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6" >
                <div class="tile-stats" style="background:#38a125;">
                  
                  <div class="count" style="color:white;"><i class="fa fa-circle" style="color:white;"></i> <?php echo $d_detail[pin2]+0;?> </div>
                  <h3 style="color:white;">Pin Balance</h3>
                </div></div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Your Pin Ledger View </h2>
                  
              
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      
            <br>
            <div class="card-box table-responsive">
        <table class="table table-striped table-bordered jambo_table" id="datatable">
            <thead><tr class="headings"><th width="10%">Sr. no.</th><th>Date / Time</th><th>PIN</th><th>Status</th><th>After Pin</th><th>From ID</th><th>To ID</th><th>Activate ID</th><th>Note</th></tr></thead>
            <tbody>
            <?php
            $a=0;
            $g="SELECT * FROM `pin_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `pin_type`='2';";
            $dc=$con->query($g);
            while($d=$dc->fetch_assoc())
            { $a++; ?>
            <tr>
                <td><?php echo $a;?></td>
                <td><?php echo $d[date]." / ".$d[time];?></td>
                <th><?php echo $d[pin];?></th>
                <td><?php if($d[type]=="+"){?>
                <font style="color:green;">Credit</font><?php 
                }else{?><font style="color:red;">Debit</font>
                <?php }?></td>
                <th><?php echo $d[a_pin];?></th>
                <td>
                    <?php
                $axxx="SELECT * FROM `distributor` WHERE `d_id`='$d[from_d_id]'";
                $cdcd=$con->query($axxx);
                $cscs=$cdcd->fetch_assoc();
                if($d[from_d_id]!=""){
                echo "DS".$d[from_d_id]." (".$cscs[name].")";
                }?></td>
                <td><?php if($d[to_d_id]!=""){
                echo $d[to_d_id];}?></td>
                <td><?php
                $axxx="SELECT * FROM `distributor` WHERE `d_id`='$d[activated_id]'";
                $cdcd=$con->query($axxx);
                $cscs=$cdcd->fetch_assoc();
                echo $d[activated_id]." (".$cscs[name].")";?></td>
                <td><?php echo $d[note];?></td>
            </tr>
            <?php
            }?>
            </tbody>
        </table>
        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

      <!-- footer content -->
        <?php include "include/footer.php";?>
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
    
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>