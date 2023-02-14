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

    <title>ORANGA || Tree View</title>

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
                <h3>Tree</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tree View</h2>
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
                  
           <ul>
                          <li><i class="fa fa-user fa-2x green"></i>Active ID</li>
                          <li><i class="fa fa-user fa-2x red"></i> Not Active ID</li>
                          <li><i class="fa fa-user fa-2x"></i> Blank ID</li>
                      </ul>
                      
    <table class="table table-bordered">
        <?php 
        $d_id=$_GET[d_id];
        $sql="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
        $que=$con->query($sql);
        $fet=$que->fetch_assoc();
        //////////////level 1
        $temp=array();
        $tempw=array();
        $sql1="SELECT * FROM `distributor` WHERE `placement_id`='$fet[d_id]'";
        $que1=$con->query($sql1);
        while($fet1=$que1->fetch_assoc())
        {
            $temp[]=$fet1[d_id];
            $tempw[]=$fet1[d_id];
        }
        ////////////////
        $temp1=array();
        $tempw1=array();
        if(isset($temp[0]))
        {
         $sql11="SELECT * FROM `distributor` WHERE `placement_id`='$temp[0]'";
        $que11=$con->query($sql11);
        while($fet11=$que11->fetch_assoc())
        {
            $temp1[]=$fet11[d_id];
            $tempw1[]=$fet11[d_id];
        }
        }
        ////////////////
        $temp2=array();
        $tempw2=array();
        if(isset($temp[1]))
        {
         $sql12="SELECT * FROM `distributor` WHERE `placement_id`='$temp[1]'";
        $que12=$con->query($sql12);
        while($fet12=$que12->fetch_assoc())
        {
            $temp2[]=$fet12[d_id];
            $tempw2[]=$fet12[d_id];
        }
        }

        ?>
        <tr><td colspan="4" align="center">
            <?php if($que->num_rows>0)
            {?>
            <a href="tree_binary.php?d_id=<?php echo $fet[d_id];?>">
            <?php 
            
           if($fet[a_status]=='n'){
            ?><i class="fa fa-user fa-4x red"></i>
            <?php }else{?>
            
            <i class="fa fa-user fa-4x green"></i><?php }?>
         <div class="media-body">
          <a class="title" href="#"><?php echo $fet[name]." (OR".$fet[d_id].")";?></a>
          
         </div></a>
         <?php }else{ ?>
         <i class="fa fa-user fa-4x"></i>
         <?php }?>
         </td></tr>
        
        <tr>
            <td colspan="2" align="center">
                <?php if(isset($temp[0]))
            {?>
            <a href="tree_binary.php?d_id=<?php echo $temp[0];?>">
                
            <?php 
            $clcm="SELECT * FROM `distributor` WHERE `d_id`='$temp[0]'";
            $sq=$con->query($clcm);
            $xnm=$sq->fetch_assoc();
           if($xnm[a_status]=='n'){
            ?><i class="fa fa-user fa-4x red"></i>
            <?php }else{?>
            
            <i class="fa fa-user fa-4x green"></i><?php }?>
         <div class="media-body">
             <?php
             $der="SELECT * FROM `distributor` WHERE `d_id`='$tempw[0]'";
             $fdc=$con->query($der);
             $cnm=$fdc->fetch_assoc();
            ?>
          <a class="title" href="#"><?php echo $cnm[name]." (OR".$tempw[0].")";?></a>
          
         </div></a>
         <?php }else{ ?>
         <i class="fa fa-user fa-4x"></i>
         <?php }?>
            </td>
            
            
            <td colspan="2" align="center"><?php if(isset($temp[1]))
            {?>
            <a href="tree_binary.php?d_id=<?php echo $temp[1];?>">
                
            <?php 
            $clcm="SELECT * FROM `distributor` WHERE `d_id`='$temp[1]'";
            $sq=$con->query($clcm);
            $xnm=$sq->fetch_assoc();
           if($xnm[a_status]=='n'){
            ?><i class="fa fa-user fa-4x red"></i>
            <?php }else{?>
            
            <i class="fa fa-user fa-4x green"></i><?php }?>
         <div class="media-body">
             <?php
             $der="SELECT * FROM `distributor` WHERE `d_id`='$tempw[1]'";
             $fdc=$con->query($der);
             $cnm=$fdc->fetch_assoc();
            ?>
          <a class="title" href="#"><?php echo $cnm[name]." (OR".$tempw[1].")";?></a>
          
         </div></a>
         <?php }else{ ?>
         <i class="fa fa-user fa-4x"></i>
         <?php }?></td>
         
        </tr>
        
        <tr>
            <td align="center">
                    <?php if(isset($temp1[0]))
                    {?>
                    <a href="tree_binary.php?d_id=<?php echo $temp1[0];?>">
                        
                    <?php 
                    $clcm="SELECT * FROM `distributor` WHERE `d_id`='$temp1[0]'";
                    $sq=$con->query($clcm);
                    $xnm=$sq->fetch_assoc();
                   if($xnm[a_status]=='n'){
                    ?><i class="fa fa-user fa-4x red"></i>
                    <?php }else{?>
                    
                    <i class="fa fa-user fa-4x green"></i><?php }?>
                 <div class="media-body">
                     <?php
                     $der="SELECT * FROM `distributor` WHERE `d_id`='$tempw1[0]'";
                     $fdc=$con->query($der);
                     $cnm=$fdc->fetch_assoc();
                    ?>
                  <a class="title" href="#"><?php echo $cnm[name]." (OR".$tempw1[0].")";?></a>
                  
                 </div></a>
                 <?php }else{ ?>
                 <i class="fa fa-user fa-4x"></i>
                 <?php }?>
            </td>
            <td align="center">
                    <?php if(isset($temp1[1]))
                    {?>
                    <a href="tree_binary.php?d_id=<?php echo $temp1[1];?>">
                        
                    <?php 
                    $clcm="SELECT * FROM `distributor` WHERE `d_id`='$temp1[1]'";
                    $sq=$con->query($clcm);
                    $xnm=$sq->fetch_assoc();
                   if($xnm[a_status]=='n'){
                    ?><i class="fa fa-user fa-4x red"></i>
                    <?php }else{?>
                    
                    <i class="fa fa-user fa-4x green"></i><?php }?>
                 <div class="media-body">
                     <?php
                     $der="SELECT * FROM `distributor` WHERE `d_id`='$tempw1[1]'";
                     $fdc=$con->query($der);
                     $cnm=$fdc->fetch_assoc();
                    ?>
                  <a class="title" href="#"><?php echo $cnm[name]." (OR".$tempw1[1].")";?></a>
                  
                 </div></a>
                 <?php }else{ ?>
                 <i class="fa fa-user fa-4x"></i>
                 <?php }?>
            </td>
            <td align="center">
                 <?php if(isset($temp2[0]))
                    {?>
                    <a href="tree_binary.php?d_id=<?php echo $temp2[0];?>">
                        
                    <?php 
                    $clcm="SELECT * FROM `distributor` WHERE `d_id`='$temp2[0]'";
                    $sq=$con->query($clcm);
                    $xnm=$sq->fetch_assoc();
                   if($xnm[a_status]=='n'){
                    ?><i class="fa fa-user fa-4x red"></i>
                    <?php }else{?>
                    
                    <i class="fa fa-user fa-4x green"></i><?php }?>
                 <div class="media-body">
                     <?php
                     $der="SELECT * FROM `distributor` WHERE `d_id`='$tempw2[0]'";
                     $fdc=$con->query($der);
                     $cnm=$fdc->fetch_assoc();
                    ?>
                  <a class="title" href="#"><?php echo $cnm[name]." (OR".$tempw2[0].")";?></a>
                  
                 </div></a>
                 <?php }else{ ?>
                 <i class="fa fa-user fa-4x"></i>
                 <?php }?>
            </td>
            <td align="center">
                     <?php if(isset($temp2[1]))
                    {?>
                    <a href="tree_binary.php?d_id=<?php echo $temp2[1];?>">
                        
                    <?php 
                    $clcm="SELECT * FROM `distributor` WHERE `d_id`='$temp2[1]'";
                    $sq=$con->query($clcm);
                    $xnm=$sq->fetch_assoc();
                   if($xnm[a_status]=='n'){
                    ?><i class="fa fa-user fa-4x red"></i>
                    <?php }else{?>
                    
                    <i class="fa fa-user fa-4x green"></i><?php }?>
                 <div class="media-body">
                     <?php
                     $der="SELECT * FROM `distributor` WHERE `d_id`='$tempw2[1]'";
                     $fdc=$con->query($der);
                     $cnm=$fdc->fetch_assoc();
                    ?>
                  <a class="title" href="#"><?php echo $cnm[name]." (OR".$tempw2[1].")";?></a>
                  
                 </div></a>
                 <?php }else{ ?>
                 <i class="fa fa-user fa-4x"></i>
                 <?php }?>
            </td>
            
            
          
            
            
        </tr>
    </table>    
                    
                    
                    
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
