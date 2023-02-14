<?php 
//include "config.php";
function for_finding_own_pv_date($d_id,$datee)
{
    global $con;
    $re=0;
    $ssc="SELECT * FROM `billing` WHERE `d_id`='$d_id' AND `date`='$datee'";
    $squ=$con->query($ssc);
    while($sfe=$squ->fetch_assoc())
    {
        $re=$re+$sfe[pv];
    }
    return $re;
}

function for_finding_under_pv_date($d_id,$datee)
{
    global $con;
    $sel="SELECT d_id,s_id FROM `distributor` WHERE `d_id`='$d_id'";
    $que=$con->query($sel);
    $fet=$que->fetch_assoc();
    
    
    /////////////////////////for level One
    $temp=array();
    $temp1=array();
    $grand_total=0;
    $sel1="SELECT d_id,s_id,a_status FROM `distributor` WHERE `placement_id`='$fet[d_id]'";
    $que1=$con->query($sel1);
    while($fet1=$que1->fetch_assoc())
    {
        echo "<br>".$fet1[d_id];
        $temp[]=$fet1[d_id];
        if($fet1[a_status]=="n")
        {
           $grand_total=$grand_total+for_finding_own_pv_date($fet1[d_id],$datee);
           echo " &nbsp; agt = ".$grand_total;
        }
    }
    /////////////////////////for level second
    
    for($x=0;$x<count($temp);$x++)
    {
    	$sel3="SELECT d_id,s_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'";
    	$que3=$con->query($sel3);
    	while($fet3=$que3->fetch_assoc())
    	{
    	    echo "<br>".$fet3[d_id];
    		$temp1[]=$fet3[d_id];
    		if($fet3[a_status]=="n")
            {
    		    $grand_total=$grand_total+for_finding_own_pv_date($fet3[d_id],$datee);
    		    echo " &nbsp; bgt = ".$grand_total;
            }
    	}
    }
    unset($temp);
    $temp=array();
    /////////////////////////////////////////////////////////////////////////////////////////////level 3
    for($x=0;$x<count($temp1);$x++)
    {
    	$sel5="SELECT d_id,s_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'";
    	$que5=$con->query($sel5);
    	while($fet5=$que5->fetch_assoc())
    	{
    	echo "<br>".$fet5[d_id];
    		$temp[]=$fet5[d_id];
    				//echo "&nbsp;B.V".find_own_rbv($fet5[ibo_id])."<br>";
    		if($fet5[a_status]=="n")
            {
    		    $grand_total=$grand_total+for_finding_own_pv_date($fet5[d_id],$datee);
    		    echo " &nbsp; cgt = ".$grand_total;
            }
    	}
    }
    unset($temp1);
    $temp1=array();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    for ($rff = 0; $rff <= 150; $rff++)
    {   echo $rff."rff<br>";
    echo count($temp1)."temp1";
    if(count($temp)==0){ if(count($temp1)==0){ echo "loop completed";break;}}
    	for($x=0;$x<count($temp);$x++)
    	{
    
    	$sel13=$con->query("SELECT d_id,s_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'");
    	
    		while($fet13=$sel13->fetch_assoc())
    		{
    			$temp1[]=$fet13[d_id];
    			if($fet13[a_status]=="n")
                {
                    echo "<br>".$fet13[d_id];
    			    $grand_total=$grand_total+for_finding_own_pv_date($fet13[d_id],$datee);
    			    echo " &nbsp; dgt = ".$grand_total;
                }
    		}
    	
    	}
    
    unset($temp);
    $temp=array();
    	  
    	 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	  for($x=0;$x<count($temp1);$x++)
    	  {
    		 
    		  $sel5=$con->query("SELECT d_id,s_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'");
    	
    		  while($fet15=$sel5->fetch_assoc())
    		  {
    			  $temp[]=$fet15[d_id];
    			 if($fet15[a_status]=="n")
                 {
                     echo "<br>".$fet15[d_id];
    			    $grand_total=$grand_total+for_finding_own_pv_date($fet15[d_id],$datee);
    			    echo " &nbsp; egt = ".$grand_total;
                 }
    		  }
    	
    	  }
    unset($temp1);
    $temp1=array();
    	
    }
    return $grand_total;
}

