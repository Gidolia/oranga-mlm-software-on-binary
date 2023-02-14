<?php 
include "database_connect.php";

function for_finding_left_joining_id($d_id)
{
    global $con, $date, $time;
    $d_sel="SELECT * FROM `distributor` WHERE `d_id`='$d_id';";
    $d_que=$con->query($d_sel);
    $d_fet=$d_que->fetch_assoc();
    if($d_fet[left_id]=="n")
    {
        $p_id=$d_id;
    }
    else{
    //////////////////////////level loop
    
        for ($rff = 0; $rff <= 150; $rff++)
        {
            
            $d_sel="SELECT * FROM `distributor` WHERE `d_id`='$d_fet[left_id]';";
            $d_que=$con->query($d_sel);
            if($d_que->num_rows > 0)
            {
                $d_fet=$d_que->fetch_assoc();
                if($d_fet[left_id]=="n")
                {
                    $p_id=$d_fet[d_id];
                    break;
                }
                
            }else{ break; }
        }
        
    }
    return $p_id;
}

function for_finding_right_joining_id($d_id)
{
    global $con, $date, $time;
    $d_sel="SELECT * FROM `distributor` WHERE `d_id`='$d_id';";
    $d_que=$con->query($d_sel);
    $d_fet=$d_que->fetch_assoc();
    if($d_fet[right_id]=="n")
    {
        $p_id=$d_id;
    }
    else{
    //////////////////////////level loop
    
        for ($rff = 0; $rff <= 150; $rff++)
        {
            $d_sel="SELECT * FROM `distributor` WHERE `d_id`='$d_fet[right_id]';";
            $d_que=$con->query($d_sel);
            if($d_que->num_rows > 0)
            {
                $d_fet=$d_que->fetch_assoc();
                if($d_fet[right_id]=="n")
                {
                    $p_id=$d_fet[d_id];
                    break;
                }
              
            }else{ break; }
        }
        
    }
    return $p_id;
}
//echo for_finding_left_joining_id(1);
if(isset($_POST[register]))
{
    
    function isNumber($c) {
        return preg_match('/[0-9]/', $c);
    }
    $string=$_POST[s_id];
       
    $chars = '';
    $d_id = '';
    for ($index=0;$index<strlen($string);$index++) {
        if(isNumber($string[$index]))
        {
            $s_id .= $string[$index];
        }
        else {
            $chars .= $string[$index];}
    }
    
    
    
    if($_POST[password]==$_POST[c_password])
    {
        if($_POST[position]=="left")
        {
            $placement_id=for_finding_left_joining_id($s_id);
            ////////////////////////////for alloting new id no.
            function password_generate($chars) 
            {
              $data = '123456789';
              return substr(str_shuffle($data), 0, $chars);
            }
            for($x=0; $x<100; $x++)
            {
                //echo $x;
                $d_id=password_generate(6);
                $sqsqqs="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
                $qur=$con->query($sqsqqs);
                if(mysqli_num_rows($qur)==0)
                {
                    break;
                }
            }
            
            
           // $reg="INSERT INTO `distributor` (`d_no`, `d_id`, `s_id`, `placement_id`, `name`, `mobile`, `password`, `dob`, `email`, `sex`, `r_date`, `r_time`, `a_status`, `a_date`, `a_time`, `left_id`, `right_id`, `addreass`, `city`, `state`, `pancard`, `adhar_card`, `left_leg_cf`, `right_leg_cf`, `new_activate`, `count_for_leg`) VALUES (NULL, '$d_id', '$s_id', '$placement_id', '$_POST[name]', '$_POST[mobile]', '$_POST[password]', '', '', '$_POST[gender]', '$date', '$time', 'n', '', '', 'n', 'n', '', '', '', '$_POST[pancard]', '', '0', '0', '', '');";
            
            $reg="INSERT INTO `distributor` (`d_no`, `d_id`, `s_id`, `placement_id`, `name`, `mobile`, `password`, `dob`, `email`, `sex`, `r_date`, `r_time`, `a_status`, `a_date`, `a_time`, `left_id`, `right_id`, `addreass`, `city`, `state`, `pancard`, `adhar_card`, `left_leg_cf`, `right_leg_cf`, `new_activate`, `count_for_leg`, `withdrawal_wallet`, `hold_amount`, `pin`, `pin2`, `position`, `pair_caping`, `block_status`, `block_note`, `profile_photo`, `pair_matched`, `tds_wallet`, `admin_wallet`) VALUES (NULL, '$d_id', '$s_id', '$placement_id', '$_POST[name]', '$_POST[mobile]', '$_POST[password]', '', '', '$_POST[gender]', '$date', '$time', 'n', '', '', 'n', 'n', '', '', '', '$_POST[pancard]', '$_POST[adharcard]', '0', '0', '', '', '', '', '', '', 'Distributor', '', '', '', '', '', '', '');";
            
            $upd="UPDATE `distributor` SET `left_id` = '$d_id' WHERE `distributor`.`d_id` = '$placement_id';";
        }
        elseif($_POST[position]=="right")
        {
            $placement_id=for_finding_right_joining_id($s_id);
            ////////////////////////////for alloting new id no.
            function password_generate($chars)
            {
              $data = '123456789';
              return substr(str_shuffle($data), 0, $chars);
            }
            for($x=0; $x<100; $x++)
            {
                //echo $x;
                $d_id=password_generate(6);
                $sqsqqs="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
                $qur=$con->query($sqsqqs);
                if(mysqli_num_rows($qur)==0)
                {
                    break;
                }
            }
            $reg="INSERT INTO `distributor` (`d_no`, `d_id`, `s_id`, `placement_id`, `name`, `mobile`, `password`, `dob`, `email`, `sex`, `r_date`, `r_time`, `a_status`, `a_date`, `a_time`, `left_id`, `right_id`, `addreass`, `city`, `state`, `pancard`, `adhar_card`, `left_leg_cf`, `right_leg_cf`, `new_activate`, `count_for_leg`, `withdrawal_wallet`, `hold_amount`, `pin`, `pin2`, `position`, `pair_caping`, `block_status`, `block_note`, `profile_photo`, `pair_matched`, `tds_wallet`, `admin_wallet`) VALUES (NULL, '$d_id', '$s_id', '$placement_id', '$_POST[name]', '$_POST[mobile]', '$_POST[password]', '', '', '$_POST[gender]', '$date', '$time', 'n', '', '', 'n', 'n', '', '', '', '$_POST[pancard]', '$_POST[adharcard]', '0', '0', '', '', '', '', '', '', 'Distributor', '', '', '', '', '', '', '');";
            
           // $reg="INSERT INTO `distributor` (`d_no`, `d_id`, `s_id`, `placement_id`, `name`, `mobile`, `password`, `dob`, `email`, `sex`, `r_date`, `r_time`, `a_status`, `a_date`, `a_time`, `left_id`, `right_id`, `addreass`, `city`, `state`, `pancard`, `adhar_card`, `left_leg_cf`, `right_leg_cf`, `new_activate`, `count_for_leg`) VALUES (NULL, '$d_id', '$s_id', '$placement_id', '$_POST[name]', '$_POST[mobile]', '$_POST[password]', '', '', '$_POST[gender]', '$date', '$time', 'n', '', '', 'n', 'n', '', '', '', '$_POST[pancard]', '', '0', '0', '', '');";
           
            $upd="UPDATE `distributor` SET `right_id` = '$d_id' WHERE `distributor`.`d_id` = '$placement_id';";
        }
        
        //////////////////////////////////checking Weather adhar card no.
        $seldffsd="SELECT * FROM `distributor` WHERE `adhar_card`='$_POST[adharcard]'";
        $quedooiu=$con->query($seldffsd);
        if($quedooiu->num_rows<4){
        
            if($con->query($reg)===TRUE && $con->query($upd)===TRUE)
            {
                echo "<script>location.href='signup_detail.php?d_id=".$d_id."';</script>";
            }
            else{
                echo "<script>alert('Query Failed! Plz try again');location.href='register.php';</script>";
            }
        }else{
            echo "<script>alert('Adhar Card Already Register in 3 ids');location.href='register.php';</script>";
        }
    }else{
            echo "<script>alert('Failed! password Didnt Match');location.href='register.php';</script>";
        }
    
}