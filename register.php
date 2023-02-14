<?php include "database_connect.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Registration || Oranga Business</title>

  <link rel="stylesheet" href="assets/css/bootstrap.css">
  
  <link rel="stylesheet" href="assets/css/maicons.css">

  <link rel="stylesheet" href="assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="assets/vendor/fancybox/css/jquery.fancybox.css">

  <link rel="stylesheet" href="assets/css/theme.css">
<script>
  
    function validateForm() {
 	var ser_name = document.forms["myForm"]["s_name"].value;
	var password = document.forms["myForm"]["password"].value;
	var c_password = document.forms["myForm"]["c_password"].value;
	var mobile_no = document.forms["myForm"]["mobile_ck"].value;
	if(mobile_no=="This Mobile Number is Already Register")
	{
	    document.getElementById("text_mob").innerHTML = " This Mobile Number is Already Register ";
    return false;
	}
	if(mobile_no=="Please Check Your Mobile Number")
	{
	    document.getElementById("text_mob").innerHTML = " Please Check Your Mobile Number ";
    return false;
	}
	  if (password != c_password)
		  {
    document.getElementById("cp_msg").innerHTML = " Confirm Password didnt matched to password ";
    return false;
		  }
		  
	
	if(ser_name == "")
		{
			document.getElementById("upline_msg").innerHTML = " Please Check Upline no. ";
			return false;
		}
	if(ser_name == "Please check your upline number")
		{
			document.getElementById("upline_msg").innerHTML = " Please Check Upline no. ";
			return false;
		}
}
  
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
        
        function showHint_mob(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint_mob").value = this.responseText;
                if(this.responseText != "Correct")
        				{
        					document.getElementById("text_mob").innerHTML = this.responseText;
        				}
        		else{ document.getElementById("text_mob").innerHTML = "";
        		}
                
              }
            };
            xmlhttp.open("GET", "get_hint_mob.php?q=" + str, true);
            xmlhttp.send();
          
        }

    </script>
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
                <li class="breadcrumb-item active" aria-current="page">Register</li>
              </ol>
            </nav>
            <h1 class="fg-white text-center">Register</h1>
          </div>
        </div>
      </div>
    </div> <!-- .page-banner -->
  </header>
  <main>
    <div class="page-section">
      <div class="container">
        <div class="text-center">
          <h2 class="title-section mb-3">REGISTER</h2>
          
        </div>
        <div class="row justify-content-center mt-5">
          <div class="col-lg-8">
            <form action="process_register.php" class="form-contact" method="post" name="myForm" onsubmit="return validateForm()">
              <div class="row">
                
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">Sponser ID</label>
                  <input type="text" class="form-control" placeholder="Sponser ID" name="s_id" value="<?php echo $_GET[d_id];?>" required onKeyUp="showHint(this.value)" autofocus>
                </div>
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">Sponser Name</label>
                  <?php
						    
						     function isNumber($c) {
                                return preg_match('/[0-9]/', $c);
                            }
                            $stringds=$_GET[d_id];
                               
                            $chars = '';
                            $d_id = '';
                            for ($index=0;$index<strlen($stringds);$index++) {
                                if(isNumber($stringds[$index]))
                                {
                                    $d_id .= $stringds[$index];
                                }
                                else {
                                    $chars .= $stringds[$index];}
                             
                            //echo $_GET[d_id];
                            //echo $d_id;
						    $fdf="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
						    $scv=$con->query($fdf);
						    $dckm=$scv->fetch_assoc();
						    }?>
                  <input type="text" value="<?php echo $dckm[name];?>" class="form-control" id="txtHint" required="" readonly>
                </div>
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">Choose Position</label>
                  <select class="form-control" name="position">
                      <option value="left">Left</option>
                      <option value="right">Right</option>
                  </select>
                </div>
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">Full Name</label>
                  <input type="text" class="form-control" id="subject" placeholder="Full Name" name="name" required>
                </div>
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">Mobile</label>
                  <input type="text" class="form-control" id="subject" placeholder="Mobile" name="mobile" onKeyUp="showHint_mob(this.value)" required>
                   <span id="text_mob" style="color: red"></span>
				<span id="text_mobw" style="color: red"></span>
				<input type="hidden" name="mobile_ck" value="Please Check Your Mobile Number" id="txtHint_mob" readonly />
                </div>
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">Gender</label>
                  <select class="form-control" name="gender">
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                  </select>
                </div>
                
                <div class="col-12 py-2">
                  <label class="fg-grey">Adhar Card No.</label>
                  <input type="text" class="form-control" placeholder="Adharcard" name="adharcard" required>
                </div>
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">Password</label>
                  <input type="password" class="form-control"  placeholder="Password" name="password" required>
                </div>
                <div class="col-12 py-2">
                  <label for="subject" class="fg-grey">Confirm Password</label>
                  <input type="password" class="form-control"  placeholder="Confirm Password"name="c_password" required>
                  <span id="cp_msg" style="color: red"></span>
                </div>
                
                <div class="col-12 mt-3">
                  <input type="submit" class="btn btn-primary px-5" name="register" value="Register">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div> <!-- .container -->
    </div> <!-- .page-section -->

    
  </main>

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