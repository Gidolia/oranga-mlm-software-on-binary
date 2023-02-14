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

  <title>Login || Oranga Business</title>

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
       </br>
      <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
              </ol>
            </nav>
            <h1 class="fg-white text-center">Login</h1>
          </div>
          <!---->
           <div class="row justify-content-center mt-5">
          <div class="col-lg-8">
            <form class="form-contact" method="post" action="ibo_panel/production/login/process_login.php">
              <div class="row">
                
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">User ID</label>
                  <input type="text" class="form-control" name="id" placeholder="User ID" style="border: 1px solid green; background:white;">
                </div>
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">Password</label>
                  <input type="password" class="form-control" name="password" id="subject" placeholder="Password" style="border: 1px solid green; background:white;">
                </div>
                
                <div class="col-12 mt-3">
                  <input type="submit" name="sub_login" class="btn btn-primary px-5" value="Login">
                </div>
                 <div class="col-12 mt-3" style="text-align:center;">
                  <h5><a href="forget_password.php" style="color:white;">Forget Password</a></h5>
                </div>
                
              </div>
            </form>
          </div>
        </div>
       
        </div>
      </div>
       </br>
        </br>
    </div> <!-- .page-banner -->
  </header>
  
  
      
   


<?php
if(isset($_POST[sub_log]))
{   session_start();
    $dds="SELECT * FROM `distributor` WHERE `d_id`='$_POST[id]' AND `password`='$_POST[password]'";
    $ss=$con->query($dds);
    if($ss->num_rows>0)
    {
        //echo $_POST[id];
        $_SESSION[d_id]=$_POST[id];
        $_SESSION[d_password]=$_POST[password];
        //echo $_POST[password];
        echo "<script>location.href='/ibo_panel/production/';</script>";
      // echo $_SESSION[d_id];
      // echo $_SESSION[d_password];
    }
    else{
        echo "<script>alert('Failed! Invalid User ID OR Password');location.href='login.php';</script>";
    }
}

?>





  

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