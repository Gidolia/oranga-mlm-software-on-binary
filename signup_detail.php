<?php include "database_connect.php";
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>SignUp Detail || Oranga Business</title>

  <link rel="stylesheet" href="assets/css/bootstrap.css">
  
  <link rel="stylesheet" href="assets/css/maicons.css">

  <link rel="stylesheet" href="assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="assets/vendor/fancybox/css/jquery.fancybox.css">

  <link rel="stylesheet" href="assets/css/theme.css">

</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>
  <header>
  <?php include "include/header.php";?>
  <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image: url(assets/img/bg_image_3.jpg);">
      <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registeration Details</li>
              </ol>
            </nav>
            <?php
            $re="SELECT * FROM `distributor` WHERE `d_id`='$_GET[d_id]'";
            $fd=$con->query($re);
            $fet=$fd->fetch_assoc();
            
            $message='Welcome to oranga , '.$fet[name].' your id OR'.$_GET[d_id].' pass '.$fet[password].' thanks Orgwel';
	                
	                $dd = str_replace(' ', '%20', $message);
	$url = 'http://sms.hspsms.com/sendSMS?username=oranga&message='.$dd.'&sendername=ORGWEL&smstype=TRANS&numbers='.$fet[mobile].'&apikey=67b73c31-8c2e-4406-aafd-dda03cf3d224';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	
	$sms_query="INSERT INTO `sms_handling` (`sh_id`, `d_id`, `message`, `date`, `time`, `response`, `mobile`, `session_d_id`, `url`) VALUES (NULL, '$d_id', '$message', '$date', '$time', '$response', '$_POST[mobile]', '$_SESSION[d_id]', '$url');";
	$con->query($sms_query);
            
            ?>
            <h1 class="fg-white text-center">Welcome <?php echo $fet[name];?></h1>
            <table class="text-center table" align="center" style="background-color: aliceblue; opacity: 0.7;">
                <tr><th>User ID </th><td>OR<?php echo $_GET[d_id];?></td></tr>
                <tr><th>Name </th><td><?php echo $fet[name];?></td></tr>
                <tr><th>Password </th><td><?php echo $fet[password];?></td></tr>
            </table>
            <span class="fg-white text-center">Keep Your ID No. Safe</span>
          </div>
        </div>
      </div>
    </div> <!-- .page-banner -->
  </header>
 

<?php include "include/footer.php";?>

  
<script src="assets/js/jquery-3.5.1.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="assets/vendor/wow/wow.min.js"></script>

<script src="assets/vendor/fancybox/js/jquery.fancybox.min.js"></script>

<script src="assets/vendor/isotope/isotope.pkgd.min.js"></script>

<script src="assets/js/google-maps.js"></script>

<script src="assets/js/theme.js"></script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIA_zqjFMsJM_sxP9-6Pde5vVCTyJmUHM&callback=initMap"></script>

</body>
</html>