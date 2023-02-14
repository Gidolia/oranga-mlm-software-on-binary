<?php
 include "config.php";

 //////////////////////////////////////////////for _deactivaate
     $d_id=$_GET[d_id];
    
   
     if($_GET[status]=="block")
     {
        
        $instq="UPDATE `distributor` SET `block_status` = 'Y' WHERE `distributor`.`d_id` = '$d_id';";
        $instqn="UPDATE `distributor` SET `block_note` = '$_GET[b_note]' WHERE `distributor`.`d_id` = '$d_id';";
        $rff="INSERT INTO `block_history` (`bh_id`, `d_id`, `date`, `time`, `status`, `reason`) VALUES (NULL, '$_GET[d_id]', '$date', '$time', '$_GET[status]', '$_GET[b_note]');";
     }elseif($_GET[status]=="unblock")
     {
        
         $instq="UPDATE `distributor` SET `block_status` = 'N' WHERE `distributor`.`d_id` = '$d_id';";
         $instqn="UPDATE `distributor` SET `block_note` = '$_GET[b_note]' WHERE `distributor`.`d_id` = '$d_id';";
           $rff="INSERT INTO `block_history` (`bh_id`, `d_id`, `date`, `time`, `status`, `reason`) VALUES (NULL, '$_GET[d_id]', '$date', '$time', '$_GET[status]', '$_GET[b_note]');";
     }
  if($con->query($instq) === TRUE && $con->query($instqn) === TRUE && $con->query($rff) === TRUE)
		{
			echo "<script>alert('ID successfully deactivated');location.href='d_detail.php?d_id=".$d_id."';</script>";
		}
	 	else
		{
		 	echo "<script>alert('Query failed to change status please try again');location.href='d_detail.php?d_id=".$d_id."';
		 	</script> ";
	 	}
     
 ?>