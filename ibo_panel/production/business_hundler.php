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

    <title>ORANGA</title>

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
                <h3>Business Closing Information</h3>
              </div>
              <div class="title_right">
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6" >
                <div class="tile-stats" style="background:#38a125;">
                  <?php
                    $a=0;
                    $sdafw="SELECT * FROM `id_business_handler` WHERE `d_id`='$_SESSION[d_id]'";
                    $edw=$con->query($sdafw);
                    while($sdfw=$edw->fetch_assoc())
                    {
                            $d_iw=$d_iw+$sdfw[commission];
                    }
                   ?>
                  <div class="count" style="color:white;"><i class="fa fa-rupee" style="color:white;"></i> <?php echo $d_iw;?> </div>
                  <h3 style="color:white;">Matching Income</h3>
                </div></div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Business Closing Information List</h2>
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
            <thead>
                                        <tr>
                                            <th hidden></th>
                                            <th>Closing No.</th>
                                            <th>Date</th>
                                            <th>Interval</th>
                                            <th>LEFT</th>
                                            <th>RIGHT</th>
                                           
                                            <th>Total Pair Matched</th>
                                            <th>Flushed Pair</th>
                                            <th>Cut Off</th>
                                            <th>Amount</th>
                                            <th>TDS</th>
                                            <th>Admin</th>
                                            <th>Net Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $final_no=0;
                                        $sdaf="SELECT * FROM `id_business_handler` WHERE `d_id`='$_SESSION[d_id]'";
                                        $ed=$con->query($sdaf);
                                        $sdadr=$ed->num_rows;
                                        while($sdf=$ed->fetch_assoc())
                                        {
                                            $final_no++;
                                            
                                           
                                        ?>
                                     <tr>
                                         <td hidden><?php echo $sdadr;?></td>
                                         <td><?php echo $final_no;?></td>
                                         <td><?php echo $sdf[date];?></td>
                                         <td><?php echo $sdf[interval];?></td>
                                         <td>
                                         <table>
                                             <tr><th>Old CF</th><td><?php echo $sdf[o_cf_left_id]/10;?></td></tr>
                                             <tr><th>New CF</th><td><?php echo $sdf[n_left_nv]/10;?></td></tr>
                                             <tr><th>Remained CF</th><td><?php echo $sdf[total_n_cf_left]/10;?></td></tr>
                                         </table></td>
                                         <td><table>
                                             <tr><th>Old CF</th><td><?php echo $sdf[o_cf_right_id]/10;?></td></tr>
                                             <tr><th>New CF</th><td><?php echo $sdf[n_right_nv]/10;?></td></tr>
                                             <tr><th>Remained CF</th><td><?php echo $sdf[total_n_cf_right]/10;?></td></tr>
                                         </table></td>
                                         
                                         <td><?php echo $sdf[pair_matched];?></td>
                                         <td><?php echo $sdf[flush_pair];?></td>
                                         <td><?php 
                                         $dpla="SELECT * FROM `pair_cutting_information` WHERE `d_id`='$sdf[d_id]' AND `date`='$sdf[date]' AND `interval`='$sdf[interval]'";
                                         $dxe=$con->query($dpla);
                                         $fetc=$dxe->fetch_assoc();
                                         if($dxe->num_rows>0){
                                             $rfcmoiujikolp=$fetc[pair_no]-1;
                                         echo "1 (pair no.=".$rfcmoiujikolp.")";}
                                         ?></td>
                                         <td><?php echo $sdf[commission];?></td>
                                         <td><?php echo $sdf[tds];?></td>
                                         <td><?php echo $sdf[admin];?></td>
                                         <td><?php echo $sdf[final_commission];?></td>
                                        
                                         
                                     </tr>
                                     <?php 
                                     if(is_int($final_no/60)==1)
                                            { 
                                                $final_no=0;
                                            }
                                     $sdadr--;
                                     }?>
                                    </tbody>
        </table></div>       
                    
                    
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