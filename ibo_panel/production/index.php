
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

    <title>Index || ORANGA BUSINESS </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- profile -->
    <link href="../vendors/profile/profile.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="extra.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
        
            
            <h2 style="text-align: left;background-color:green;"><marquee><span class="" style="color: white;"><strong>Welcome To ORANGA BUSINESS</strong></span></marquee></h2>

          
          <br />
          
          
          <div class="row">
              <div class="col-md-6 col-sm-12 ">
                <div class="x_panel">
                  
                  
                   
            <div class="card p-12 py-12">
                <?php
                if($d_detail[profile_photo]=="y")
                {
                    $imgsrc="profile_photo/".$_SESSION[d_id].".jpg";
                }
                else{
                    $imgsrc="https://cdn-icons-png.flaticon.com/512/149/149071.png";
                }
                ?>
                <div class="text-center"> <img src="<?php echo $imgsrc;?>" width="100" class="rounded-circle"> </div>
                <div class="text-center mt-3"> <span class="bg-secondary p-1 px-4 rounded text-white"><?php echo $d_detail[name];?></span> <br><br>
                <a href="profile_edit.php"><button class="bg-success p-1 px-4 rounded text-white">Edit Profile</button></a>
                <a href="change_profile_photo.php"><button class="bg-success p-1 px-4 rounded text-white">Change Profile Photo</button></a>
           
              <div class="card-body">
                    <div>
                      <ul class="list-inline widget_tally">
                        <li>
                          <p>
                            <span class="month">ID </span>
                            <span class="count">OR<?php echo $_SESSION[d_id];?></span>
                          </p>
                        </li>
                        <li>
                          <p>
                            <span class="month">Joining Date / Time</span>
                            <span class="count"><?php echo $d_detail[r_date];?> / <?php echo $d_detail[r_time];?></span>
                          </p>
                        </li>
                        <li>
                          <p>
                            <span class="month">ID Status </span>
                            <span class="count"><?php 
                        if($d_detail[a_status]=="y"){?>
                        <span class="badge badge-success">Active</span>
                         
                         <?php   
                        }
                        else{
                            echo "<span class='badge badge-danger'>Not Active</span>";
                        }
                        ?></span>
                          </p>
                        </li>
                        <li>
                          <p>
                            <span class="month">Activation Date / Time</span>
                            <span class="count"><?php echo $d_detail[a_date];?> / <?php echo $d_detail[a_time];?></span>
                          </p>
                        </li>
                        <li>
                          <p>
                            <span class="month">Position</span>
                            <span class="badge badge-primary"><?php echo $d_detail[position];?></span>
                          </p>
                        </li>
                        <li>
                          <p>
                            <span class="month">Your Joining Link</span>
                            <span class="count"><div class="buttons"> 
                        <input type="text" value="http://oranga.in/register.php?d_id=<?php echo $_SESSION[d_id];?>" id="myInput">
                    <button onclick="myFunction()" class="btn btn-primary">Copy Joining Link</button></div></span>
                     <script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
  
  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>
                          </p>
                        </li>
                      </ul>
                    </div>
                 <hr>
    
                    
                 
              <div>
                   
 
                </div>
            </div>
        </div>
  
    
   
                   
                    
                </div>
              </div>
            </div>
            <?php
            
            if($d_detail[left_id]=="n")
            {
                $total_left=0;
                $total_left_activated_id=0;
                $total_left_inactive_id=0;
            }
            else{
                $total_left=for_finding_under_total_id($d_detail[left_id])+0;
                $total_left_activated_id=for_finding_under_total_activated_id($d_detail[left_id])+0;
                //echo $total_left_activated_id;
                $total_left_inactive_id=$total_left-$total_left_activated_id;
            }
            if($d_detail[right_id]=="n")
            {
                $total_right=0;
                $total_right_activated_id=0;
                $total_right_inactive_id=0;
            }
            else{
                $total_right=for_finding_under_total_id($d_detail[right_id])+0;
            
                $total_right_activated_id=for_finding_under_total_activated_id($d_detail[right_id])+0;
                
                $total_right_inactive_id=$total_right-$total_right_activated_id;
            }
            $total_acti=$total_left_activated_id+$total_right_activated_id;
            $total_inacti=$total_left_inactive_id+$total_right_inactive_id;
            ?>
            
            
            <div class="col-md-6 col-sm-12 ">
                <div class="row tile_count">
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <a href="hold_wallet_ledger.php">
                <div class="tile-stats" style="background:#38a125">
                  
                  <div class="count" style="color:white;"><i class="fa fa-inr" style="color:white;"></i> <?php echo $d_detail[hold_amount]+0;?> </div>
                  <h4 style="color:white;"> &nbsp;Hold Wallet</h4>
                </div></a>
              </div>
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="tile-stats" style="background:#38a125">
                  
                 <div class="count" style="color:white;"><i class="fa fa-inr" style="color:white;"></i> <?php echo $d_detail[withdrawal_wallet]+0;?> </div>
                  <h4 style="color:white;"> &nbsp;Withdrawal Wallet</h4>
                </div>
              </div>
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <a href="business_hundler.php">
                <div class="tile-stats" style="background:#38a125">
                  <?php
                    $a=0;
                    $sdafw="SELECT * FROM `id_business_handler` WHERE `d_id`='$_SESSION[d_id]' AND `pin_level`='Distributor'";
                    $edw=$con->query($sdafw);
                    while($sdfw=$edw->fetch_assoc())
                    {
                       
                            $d_iw=$d_iw+$sdfw[commission];
                     
                    }
                   ?>
                 <div class="count" style="color:white;"><i class="fa fa-inr" style="color:white;"></i> <?php echo $d_iw+0;?> </div>
                  <h4 style="color:white;"> &nbsp;Silver Income</h4>
                </div></a>
              </div>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <a href="business_hundler.php">
                <div class="tile-stats" style="background:#38a125">
                  
                 <div class="count" style="color:white;"><i class="fa fa-inr" style="color:white;"></i> <?php echo 0;?> </div>
                  <h4 style="color:white;"> &nbsp;Gold Income</h4>
                </div></a>
              </div>
             <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <a href="business_hundler.php">
                <div class="tile-stats" style="background:#38a125">
                  <?php
                    $a=0;
                    $str2 = date('Y-m-d', strtotime('-1 days', strtotime($date))); 
                    $sdafwe="SELECT * FROM `hold_wallet` WHERE `d_id`='$_SESSION[d_id]' AND `date`='$str2' AND `type`='+'";
                    $edwe=$con->query($sdafwe);
                    while($sdfwe=$edwe->fetch_assoc())
                    {
                       
                            $d_iwe=$d_iwe+$sdfwe[amount];
                     
                    }
                   ?>
                 <div class="count" style="color:white;"><i class="fa fa-inr" style="color:white;"></i> <?php echo $d_iwe+0;?> </div>
                  <h4 style="color:white;"> &nbsp;Today Income</h4>
                </div></a>
              </div>
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="tile-stats" style="background:#38a125">
                  
                 <div class="count" style="color:white;"><i class="fa fa-users" style="color:white;"></i> <?php echo $d_detail[left_leg_cf]/10+0;?> </div>
                  <h4 style="color:white;"> &nbsp;Left CF</h4>
                </div>
              </div>
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="tile-stats" style="background:#38a125">
                  
                 <div class="count" style="color:white;"><i class="fa fa-users" style="color:white;"></i> <?php echo $d_detail[	right_leg_cf]/10+0;?> </div>
                  <h4 style="color:white;"> &nbsp;Right CF</h4>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <a href="business_hundler.php">
                <div class="tile-stats" style="background:#38a125">
                  <?php
                    $a=0;
                    $sdafwe="SELECT * FROM `pair_cutting_information` WHERE `d_id`='$_SESSION[d_id]'";
                    $edwe=$con->query($sdafwe);
                    while($sdfwe=$edwe->fetch_assoc())
                    {
                       
                            $d_iwep=$d_iwep+$sdfwe[amount];
                     
                    }
                   ?>
                 <div class="count" style="color:white;"><i class="fa fa-inr" style="color:white;"></i> <?php echo $d_iwep+0;?> </div>
                  <h4 style="color:white;"> &nbsp;Flushout Income</h4>
                </div></a>
              </div>
            </div>
            
    
            
                
                    
                  
                </div>
              </div>
     <div class="row">      
            
    <div class="col-md-6 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Active <small>Basic Information</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <canvas id="myChart" style="width:100%;max-width:510px"></canvas>

<script>
var xValues = ["Left ID : <?php echo $total_left_activated_id;?>", "Right ID : <?php echo $total_right_activated_id;?>", "Total ID : <?php echo $total_acti;?>"];
var yValues = [<?php echo $total_left_activated_id;?>, <?php echo $total_right_activated_id;?>, <?php echo $total_acti;?>, 0];
var barColors = ["red", "#38a125", "orange"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Active ID"
    }
  }
});
</script>
                    
                  
                </div>
              </div>
              </div>
            
            <div class="col-md-6 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Inactive <small>Basic Information</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <canvas id="myChart2" style="width:100%;max-width:510px"></canvas>

<script>
var xValues = ["Left ID : <?php echo $total_left_inactive_id;?>", "Right ID : <?php echo $total_right_inactive_id;?>", "Total ID : <?php echo $total_inacti;?>"];
var yValues = [<?php echo $total_left_inactive_id;?>, <?php echo $total_right_inactive_id;?>, <?php echo $total_inacti;?>, 0];
var barColors = ["red", "#38a125", "orange"];

new Chart("myChart2", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Inactive ID"
    }
  }
});
</script>
                    
                  
                </div></div>
              </div>
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Today Activation<small>Basic Information</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <canvas id="myChart3" style="width:100%;"></canvas>

<script>
<?php
$to_a_l=for_finding_under_total_activated_id_date($d_detail[left_id],$date);
$to_a_r=for_finding_under_total_activated_id_date($d_detail[right_id],$date);
$to_a=$to_a_l+$to_a_r;

?>
var xValues = ["Left ID : <?php echo $to_a_l;?>", "Right ID : <?php echo $to_a_r;?>", "Total ID : <?php echo $to_a;?>"];
var yValues = [<?php echo $to_a_l;?>, <?php echo $to_a_r;?>, <?php echo $to_a;?>, 0];
var barColors = ["green", "#38a125", "orange"];

new Chart("myChart3", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Total Activate ID"
    }
  }
});
</script>
                    
                  
                </div>
              
            
            
            </div></div></div>
            
            
  
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
