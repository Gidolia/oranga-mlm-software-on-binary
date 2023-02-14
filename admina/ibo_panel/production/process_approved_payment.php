<?php
include "config.php";
if(isset($_GET[sta]))
{
    $self="SELECT * FROM `withdrawal_list` WHERE `wl_id` = $_GET[wl_no];";
    $sdfs=$con->query($self);
    $sdsdddd=$sdfs->fetch_assoc();
    $d_sel="SELECT * FROM `distributor` WHERE `d_id`='$sdsdddd[d_id]'";
    $qd_que=$con->query($d_sel);
    $d_ffet=$qd_que->fetch_assoc();
    
    
    $rf="UPDATE `withdrawal_list` SET `status` = 'c' WHERE `withdrawal_list`.`wl_id` = $_GET[wl_no];";
    $withd=$d_ffet[withdrawal_wallet]+$sdsdddd[amount];
    $upww="UPDATE `distributor` SET `withdrawal_wallet` = '$withd' WHERE `distributor`.`d_id` = '$sdsdddd[d_id]';";
    $insw="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `s_note`, `bh_id`) VALUES (NULL, '$sdsdddd[d_id]', '$date', '$time', '$sdsdddd[amount]', '$d_ffet[withdrawal_wallet]', '$withd', '+', 'Withdrawal To Bank', 'withdraw', '');";
    if($con->query($rf)===TRUE && $con->query($upww)===TRUE && $con->query($insw)===TRUE)
    {
        echo "<script>alert('Approved!');
    		location.href='withdrawal_payment_list_detail.php?wl_no=".$sdsdddd[withdrawal_no]."';</script>";
    }
    else{
         $ref="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', 'n', 'withdrae approved', '$d_id', '$url', '$ipad', '');";
        $con->query($ref);
        echo "<script>alert('failed Plz Again !');
    		location.href='withdrawal_payment_list_detail.php?wl_no=".$sdsdddd[withdrawal_no]."';</script>";
    }
}
elseif(isset($_GET[deny])){
    $self="SELECT * FROM `withdrawal_list` WHERE `wl_id` = $_GET[wl_no];";
    $sdfs=$con->query($self);
    $sdsdddd=$sdfs->fetch_assoc();
    $d_sel="SELECT * FROM `distributor` WHERE `d_id`='$sdsdddd[d_id]'";
    $qd_que=$con->query($d_sel);
    $d_ffet=$qd_que->fetch_assoc();
    
    
    $rf="UPDATE `withdrawal_list` SET `status` = 'r' WHERE `withdrawal_list`.`wl_id` = $_GET[wl_no];";
    $withd=$d_ffet[hold_amount]+$sdsdddd[amount];
    $upww="UPDATE `distributor` SET `hold_amount` = '$withd' WHERE `distributor`.`d_id` = '$sdsdddd[d_id]';";
    $insw="INSERT INTO `hold_wallet` (`hw_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$sdsdddd[d_id]', '$date', '$time', '$sdsdddd[amount]', '$d_ffet[hold_amount]', '$withd', '+', 'Payment Return');";
    
    if($con->query($rf)===TRUE && $con->query($upww)===TRUE && $con->query($insw)===TRUE)
    {
        echo "<script>alert('Approved!');
    		location.href='withdrawal_payment_list_detail.php?wl_no=".$sdsdddd[withdrawal_no]."';</script>";
    }
    else{
         $ref="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', 'n', 'withdrae approved', '$d_id', '$url', '$ipad', '');";
        $con->query($ref);
        echo "<script>alert('failed Plz Again !');
    		location.href='withdrawal_payment_list_detail.php?wl_no=".$sdsdddd[withdrawal_no]."';</script>";
    }
}
?>