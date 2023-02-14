<?php
include "config.php";

if(isset($_POST[ac_submit]))
{
    function isNumber($c) {
        return preg_match('/[0-9]/', $c);
    }
    $string=$_POST[a_d_id];
       
    $chars = '';
    $d_id = '';
    for ($index=0;$index<strlen($string);$index++) {
        if(isNumber($string[$index]))
        {
            $d_id .= $string[$index];
        }
        else {
            $chars .= $string[$index];}
    }
    
    switch ($_POST[pin_type]) {
      case "1":
        $pv=10;
        $amount=2700;
        $caping=1;
        $a_pin=$d_detail[pin]-1;
        $up_pin="UPDATE `distributor` SET `pin` = '$a_pin' WHERE `distributor`.`d_id` = '$_SESSION[d_id]';";
        $ins_pin="INSERT INTO `pin_wallet_history` (`pwh_id`, `d_id`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`, `activated_id`, `used`, `pin_type`) VALUES (NULL, '$_SESSION[d_id]', '$date', '$time', '1', '$d_detail[pin]', '$a_pin', '-', 'Activated ID', '$d_id', 'y', '1');";
        break;
      case "2":
        $pv=10;
        $amount=4500;
        $caping=1;
        $a_pin=$d_detail[pin2]-1;
        $up_pin="UPDATE `distributor` SET `pin2` = '$a_pin' WHERE `distributor`.`d_id` = '$_SESSION[d_id]';";
        $ins_pin="INSERT INTO `pin_wallet_history` (`pwh_id`, `d_id`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`, `activated_id`, `used`, `pin_type`) VALUES (NULL, '$_SESSION[d_id]', '$date', '$time', '1', '$d_detail[pin]', '$a_pin', '-', 'Activated ID', '$d_id', 'y', '2');";
        break;
      
    }
    
    
    
    
    $dis="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
    $dis_que=$con->query($dis);
    if($dis_que->num_rows>0)
    {
        $fet_d=$dis_que->fetch_assoc();
        if($fet_d[a_status]!='y')
        {
            $date1=date_create($fet_d['r_date']);
            $date2=date_create($date);
            $diff=date_diff($date1,$date2);
            $as=$diff->format("%R%a");
            if($as<16 || $_SESSION[d_id]=='786')
            {
                //echo $d_detail[pin];
                if($a_pin>=0){
                    $in_bill="INSERT INTO `billing` (`b_id`, `d_id`, `date`, `time`, `business_type`, `amount`, `pv`, `note`, `counted_business`) VALUES (NULL, '$d_id', '$date', '$time', 'pv', '$amount', '$pv', 'ID Activated', 'y');";
                    $up_dis="UPDATE `distributor` SET `a_status` = 'y' WHERE `distributor`.`d_id` = '$d_id';";
                    $up_date="UPDATE `distributor` SET `a_date` = '$date' WHERE `distributor`.`d_id` = '$d_id';";
                    $up_time="UPDATE `distributor` SET `a_time` = '$time' WHERE `distributor`.`d_id` = '$d_id';";
                    
                    $up_caping="UPDATE `distributor` SET `pair_caping` = '$caping' WHERE `distributor`.`d_id` = '$d_id';";
                    if($con->query($in_bill)===TRUE && $con->query($up_dis)===TRUE && $con->query($up_date)===TRUE && $con->query($up_time)===TRUE && $con->query($up_pin)===TRUE && $con->query($ins_pin)===TRUE && $con->query($up_caping)===TRUE)
                    {
                        echo "<script>alert('Success! ID Activated Successfully');
            		location.href='upgrade_id.php';</script>";
                    }
                    else{
                        echo "<script>alert('Failed! Query Failed Plz Try');
            		location.href='upgrade_id.php';</script>";
                    }
                }else{
                    echo "<script>alert('Failed! You Dont Have pins to active');
            		location.href='upgrade_id.php';</script>";
                }
            }else{
                echo "<script>alert('Failed! you cannot activate Blocked ID');
    		location.href='upgrade_id.php';</script>";
            }
                
        }
        else{
        echo "<script>alert('User Already Activated!');
    		location.href='upgrade_id.php';</script>";}
    }else{
        echo "<script>alert('Failed! No Such ID Founded In Our Database');
    		location.href='upgrade_id.php';</script>";
    }
    
}else{
    echo "<script>alert('Failed! Sorry Some Thing Went Wrong');
    		location.href='upgrade_id.php';</script>";
}

?>