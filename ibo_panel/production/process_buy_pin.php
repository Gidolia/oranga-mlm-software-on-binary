<?php
include "config.php";

if(isset($_POST[submit]))
{
    switch ($_POST[pw]) {
      case "1":
        $d="pw_1";
        break;
      case "2":
        $d="pw_2";
        break;
      case "3":
        $d="pw_3";
        break;
      case "4":
        $d="pw_4";
        break;
      case "5":
        $d="pw_5";
        break;
      case "6":
        $d="pw_6";
        break;
      case "7":
        $d="pw_7";
        break;
      case "8":
        $d="pw_8";
        break;
      case "9":
        $d="pw_9";
        break;
      case "10":
        $d="pw_10";
        break;
      case "11":
        $d="pw_11";
        break;
      
    }
    
    $a_pin=$d_detail[$d]+$_POST[qty];
    
    $sel="INSERT INTO `pw_history` (`pwh_id`, `d_id`, `pw_type`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`) VALUES (NULL, '$_SESSION[d_id]', '$_POST[pw]', '$date', '$time', '$_POST[qty]', '$d_detail[$d]', '$a_pin', '+', 'Pin Purchased');";
    $up="UPDATE `distributor` SET `$d` = '$a_pin' WHERE `distributor`.`d_id` = '$_SESSION[d_id]';";
    if($con->query($sel)===TRUE && $con->query($up)===TRUE)
    {
        	echo "<script>alert('Success! Pin Purchased Successfully');
    		location.href='pin_wallet.php';</script>";
    }
    else{
        echo "<script>alert('Failed! Plz Try Again');
    		location.href='pin_wallet.php';</script>";
    }


}


?>