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

    <title>Navyug Group || Network List</title>

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

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include "include/sidebar.php";?>
        <!-- top navigation -->
        <?php include "include/header.php";?>
        <!-- /top navigation -->
<?php
            $fdt="SELECT * FROM `project_name` WHERE `pn_id`='$_GET[pn_id]'";
            $fey=$con->query($fdt);
            $re=$fey->fetch_assoc();
            ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>"<?php echo $re[project_name];?>" Project Detail</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form method="post" name="myForm">
        <table class="table table-striped table-bordered">
            
            <tr>
                <th>Project Name</th>
                <td><?php echo $re[project_name];?></td>
                <input type="hidden" name="pn_id" value="<?php echo $re[pn_id];?>">
            </tr>
            <tr>
                <th>Project Note</th>
                <td><?php echo $re[note];?></td>
            </tr>
            <tr>
                <th>Plot No.</th>
                <td><input type="text" name="plot_no" class="form-control"></td>
            </tr>
            <tr>
                <th>Plot Size</th>
                <td><input type="text" name="size" class="form-control"></td>
            </tr>
            <tr>
                <th>Plot Sq feet</th>
                <td><input type="text" name="sq_feet" class="form-control"></td>
            </tr>
            <tr>
                <th>Plot Note</th>
                <td><textarea name="note" class="form-control"></textarea>
                </td>
            </tr>
            
            <tr>
                <th></th>
                <td><input type="submit" class="btn btn-success" name="submit_plot"></td>
            </tr>
            </table>
            </form>
            <?php
            if(isset($_POST[submit_plot]))
            {
              $ret="INSERT INTO `plot_details` (`pd_id`, `pn_id`, `size`, `sq_feet`, `note`, `filed_status`, `date`, `time`) VALUES (NULL, '$_POST[pn_id]', '$_POST[size]', '$_POST[sq_feet]', '$_POST[note]', 'N', '$date', '$time');";  
              if($con->query($ret) === TRUE)
              {
                  echo "<script>alert('successfully! Entered'); location.href='enter_plot.php?pn_id=".$_POST[pn_id]."';</script>";
              }
              else{
                  echo "<script>alert('Failed ! Please Try Again'); location.href='enter_plot.php?pn_id=".$_POST[pn_id]."';</script>";
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
                    <h2>Plot No</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
            <br>
        <table class="table table-striped table-bordered" id="datatable">
            <thead><tr><th>Sr. no.</th><th>Date / Time</th><th>size (sq_feet)</th><th>Note</th></tr></thead>
            <?php
            $a=0;
            $g="SELECT * FROM `plot_details` WHERE `pn_id`='$_GET[pn_id]'";
            $dc=$con->query($g);
            while($d=$dc->fetch_assoc())
            { $a++; ?>
            <tr>
                <td bgcolor="red"><?php echo $d[pd_id];?></td>
                <td><?php echo $d[date]." / ".$d[time];?></td>
                <th><?php echo $d[size]." (".$d[sq_feet].")";?></th>
                <td><?php echo $d[note];?></td>
                <td></td>
                
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
        <!-- /page content -->

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

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
