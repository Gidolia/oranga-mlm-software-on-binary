<?php
include "config.php";
if(isset($_GET[asd]))
{
    $fvsasas="SELECT MAX(withdrawal_no) AS `max_no` FROM `withdrawal_list`";
    $erf=$con->query($fvsasas);
    $max_no=$erf->fetch_assoc();
    $max_no=$max_no[max_no]+1;
    $ckls="SELECT * FROM `distributor`";
    $dpolk=$con->query($ckls);
    while($fdp=$dpolk->fetch_assoc())
    {
        if($fdp[hold_amount]>0)
        {
            echo $fdp[d_id]."d_id ".$fdp[hold_amount]."<br>";
            
            $rvpo="INSERT INTO `withdrawal_list` (`wl_id`, `d_id`, `date`, `amount`, `note`, `status`, `clear_date`, `withdrawal_no`) VALUES (NULL, '$fdp[d_id]', '$date', '$fdp[hold_amount]', '', 'p', '', '$max_no');";
            //////////////////////////for update hold wallet
            $hold_abal=0;
            $hold_ins="INSERT INTO `hold_wallet` (`hw_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$fdp[d_id]', '$date', '', '$fdp[hold_amount]', '$fdp[hold_amount]', '$hold_abal', '-', 'Withdraw');";
            $hold_up="UPDATE `distributor` SET `hold_amount` = '$hold_abal' WHERE `distributor`.`d_id` = '$fdp[d_id]';";
            if($con->query($rvpo)===TRUE && $con->query($hold_ins)===TRUE && $con->query($hold_up)===TRUE)
            {
                echo "Success";
            }else{
                echo "Failed";
                $re="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '', '1', 'create payment list', '$fdp[d_id]', '$url', '', 'create payment list');";
                $con->query($re);
            }
        }
        
    }
    
    echo "<script>alert('Payment Distributed Successfully');
                          location.href='withdrawal_payment_list.php'</script>";
}


?>