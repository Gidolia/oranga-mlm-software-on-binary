<?php
include "config.php";

if($_GET[clear_payment]=="y")
{
    while ($con->next_result()) {;}
    
    $edfg="SELECT * FROM `pin_request` WHERE `pr_id`='$_GET[pr_id]'";
    $fv=$con->query($edfg);
    $fet=$fv->fetch_assoc();
    
    $d_query="SELECT * FROM `distributor` WHERE `d_id`='$fet[d_id]'";
    $d_run=$con->query($d_query);
    $d_fet=$d_run->fetch_assoc();
    
    if($fet[pin_type]==1)
    {
    /////////////////////for 2700 10NV
        $a_pin=$d_fet[pin]+$fet[pin];
        
        $r="UPDATE `pin_request` SET `status` = 'S' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
        $c="INSERT INTO `pin_wallet_history` (`pwh_id`, `d_id`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`, `activated_id`, `used`, `pin_type`) VALUES (NULL, '$fet[d_id]', '$date', '$time', '$fet[pin]', '$d_fet[pin]', '$a_pin', '+', 'Pin Requested', '', '', '1');";
        $up="UPDATE `distributor` SET `pin` = '$a_pin' WHERE `distributor`.`d_id` = '$fet[d_id]';";
        $d="UPDATE `pin_request` SET `c_date` = '$date' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
        $v="UPDATE `pin_request` SET `c_time` = '$time' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
    }
    
    elseif($fet[pin_type]==2)
    {
        /////////////////////for pin 4500 10NV
        $a_pin=$d_fet[pin2]+$fet[pin];
        
        $r="UPDATE `pin_request` SET `status` = 'S' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
        $c="INSERT INTO `pin_wallet_history` (`pwh_id`, `d_id`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`, `activated_id`, `used`, `pin_type`) VALUES (NULL, '$fet[d_id]', '$date', '$time', '$fet[pin]', '$d_fet[pin]', '$a_pin', '+', 'Pin Requested', '', '', '2');";
        $up="UPDATE `distributor` SET `pin2` = '$a_pin' WHERE `distributor`.`d_id` = '$fet[d_id]';";
        $d="UPDATE `pin_request` SET `c_date` = '$date' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
        $v="UPDATE `pin_request` SET `c_time` = '$time' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
    }
    if($con->query($r)===TRUE && $con->query($c)===TRUE && $con->query($up)===TRUE && $con->query($d)===TRUE && $con->query($v)===TRUE)
    {
         echo "<script>alert('Success! Pin requested Accepted Successfully');location.href='payment_request_history.php';</script>";
    }else{
        echo "<script>alert('Query Failed! Plz Try Again');location.href='payment_request_history.php';</script>";
    }
}
elseif($_GET[clear_payment]=="n")
{
    while ($con->next_result()) {;}
    $edfg="SELECT * FROM `pin_request` WHERE `pr_id`='$_GET[pr_id]'";
    $fv=$con->query($edfg);
    $fet=$fv->fetch_assoc();
    
    $r="UPDATE `pin_request` SET `status` = 'C' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
    $d="UPDATE `pin_request` SET `c_date` = '$date' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
    $v="UPDATE `pin_request` SET `c_time` = '$time' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
    if($con->query($r)===TRUE && $con->query($d)===TRUE && $con->query($v)===TRUE)
    {
         echo "<script>alert('Success! Pin requested Cancelled Successfully');location.href='payment_request_history.php';</script>";
    }else{
        echo "<script>alert('Query Failed! Plz Try Again');location.href='payment_request_history.php';</script>";
    }
}
?>