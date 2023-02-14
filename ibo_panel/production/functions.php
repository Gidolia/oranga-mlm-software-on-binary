<?php
//include "../../database_connect.php";
function dateDiff($date1, $date2)
{
    $date1_ts = strtotime($date1);
    $date2_ts = strtotime($date2);
    $diff = $date2_ts - $date1_ts;
    return round($diff / 86400);
}
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
    $sel="SELECT d_id,placement_id FROM `distributor` WHERE `d_id`='$d_id'";
    $que=$con->query($sel);
    $fet=$que->fetch_assoc();
    /////////////////////////for level One
    $temp=array();
    $temp1=array();
    $grand_total=0;
    $sel1="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$fet[d_id]'";
    $que1=$con->query($sel1);
    while($fet1=$que1->fetch_assoc())
    {
       //echo "<br>".$fet1[d_id];
        $temp[]=$fet1[d_id];
        if($fet1[a_status]=="n")
        {
           $grand_total=$grand_total+for_finding_own_pv_date($fet1[d_id],$datee);
          //echo " &nbsp; agt = ".$grand_total;
        }
    }
    /////////////////////////for level second
    for($x=0;$x<count($temp);$x++)
    {
    	$sel3="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'";
    	$que3=$con->query($sel3);
    	while($fet3=$que3->fetch_assoc())
    	{
    	   //echo "<br>".$fet3[d_id];
    		$temp1[]=$fet3[d_id];
    		if($fet3[a_status]=="n")
            {
    		    $grand_total=$grand_total+for_finding_own_pv_date($fet3[d_id],$datee);
    		   //echo " &nbsp; bgt = ".$grand_total;
            }
    	}
    }
    unset($temp);
    $temp=array();
    /////////////////////////////////////////////////////////////////////////////////////////////level 3
    for($x=0;$x<count($temp1);$x++)
    {
    	$sel5="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'";
    	$que5=$con->query($sel5);
    	while($fet5=$que5->fetch_assoc())
    	{
    	echo "<br>".$fet5[d_id];
    		$temp[]=$fet5[d_id];
    				//echo "&nbsp;B.V".find_own_rbv($fet5[ibo_id])."<br>";
    		if($fet5[a_status]=="n")
            {
    		    $grand_total=$grand_total+for_finding_own_pv_date($fet5[d_id],$datee);
    		   //echo " &nbsp; cgt = ".$grand_total;
            }
    	}
    }
    unset($temp1);
    $temp1=array();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    for ($rff = 0; $rff <= 150; $rff++)
    {  //echo $rff."rff<br>";
   //echo count($temp1)."temp1";
    if(count($temp)==0){ if(count($temp1)==0){ //echo "loop completed";
                                                break;}}
    	for($x=0;$x<count($temp);$x++)
    	{
    
    	$sel13=$con->query("SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'");
    	
    		while($fet13=$sel13->fetch_assoc())
    		{
    			$temp1[]=$fet13[d_id];
    			if($fet13[a_status]=="n")
                {
                   // echo "<br>".$fet13[d_id];
    			    $grand_total=$grand_total+for_finding_own_pv_date($fet13[d_id],$datee);
    			   // echo " &nbsp; dgt = ".$grand_total;
                }
    		}
    	
    	}
    
    unset($temp);
    $temp=array();
    	  
    	 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	  for($x=0;$x<count($temp1);$x++)
    	  {
    		 
    		  $sel5=$con->query("SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'");
    	
    		  while($fet15=$sel5->fetch_assoc())
    		  {
    			  $temp[]=$fet15[d_id];
    			 if($fet15[a_status]=="n")
                 {
                     //echo "<br>".$fet15[d_id];
    			    $grand_total=$grand_total+for_finding_own_pv_date($fet15[d_id],$datee);
    			    //echo " &nbsp; egt = ".$grand_total;
                 }
    		  }
    	
    	  }
    unset($temp1);
    $temp1=array();
    	
    }
    return $grand_total;
}
function for_finding_under_id_number($d_id, $u_d_id)
{
    global $con;
    $sel="SELECT d_id,placement_id FROM `distributor` WHERE `d_id`='$d_id'";
    $que=$con->query($sel);
    $fet=$que->fetch_assoc();
    
    
    /////////////////////////for level One
    $temp=array();
    $temp1=array();
    $a=0;
    $sel1="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$fet[d_id]'";
    $que1=$con->query($sel1);
    while($fet1=$que1->fetch_assoc())
    {
        
        $temp[]=$fet1[d_id];
        if($fet1[d_id]==$u_d_id)
        {
           $a=1;
        }
    }
    /////////////////////////for level second
    
    for($x=0;$x<count($temp);$x++)
    {
    	$sel3="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'";
    	$que3=$con->query($sel3);
    	while($fet3=$que3->fetch_assoc())
    	{
    	    //echo "<br>".$fet3[d_id];
    		$temp1[]=$fet3[d_id];
    		if($fet3[d_id]==$u_d_id)
            {
               $a=1;
            }
    	}
    }
    unset($temp);
    $temp=array();
    /////////////////////////////////////////////////////////////////////////////////////////////level 3
    for($x=0;$x<count($temp1);$x++)
    {
    	$sel5="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'";
    	$que5=$con->query($sel5);
    	while($fet5=$que5->fetch_assoc())
    	{
    	//echo "<br>".$fet5[d_id];
    		$temp[]=$fet5[d_id];
    				//echo "&nbsp;B.V".find_own_rbv($fet5[ibo_id])."<br>";
    		if($fet5[d_id]==$u_d_id)
            {
               $a=1;
            }
    	}
    }
    unset($temp1);
    $temp1=array();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    for ($rff = 0; $rff <= 150; $rff++)
    {   //echo $rff."rff<br>";
    //echo count($temp1)."temp1";
    if(count($temp)==0){ if(count($temp1)==0){ break;}}
    	for($x=0;$x<count($temp);$x++)
    	{
    
    	$sel13=$con->query("SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'");
    	
    		while($fet13=$sel13->fetch_assoc())
    		{
    			$temp1[]=$fet13[d_id];
    			if($fet13[d_id]==$u_d_id)
                {
                   $a=1;
                }
    		}
    	
    	}
    
    unset($temp);
    $temp=array();
    	  
    	  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	  for($x=0;$x<count($temp1);$x++)
    	  {
    		 
    		  $sel5=$con->query("SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'");
    	
    		  while($fet15=$sel5->fetch_assoc())
    		  {
    			  $temp[]=$fet15[d_id];
    			    if($fet15[d_id]==$u_d_id)
                    {
                       $a=1;
                    }
    		  }
    	
    	  }
    unset($temp1);
    $temp1=array();
    	
    }
    return $a;
}

////////////////////////////////////function for finding total under ID
///////////////////////////////////

function for_finding_under_total_id($d_id)
{
    
    global $con;
    $a=0;
    $sel="SELECT d_id,placement_id FROM `distributor` WHERE `d_id`='$d_id'";
    $que=$con->query($sel);
    $fet=$que->fetch_assoc();
    if($que->num_rows>0)
    {
        $a=1;
    }
    /////////////////////////for level One
    $temp=array();
    $temp1=array();
    $sel1="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$fet[d_id]'";
    $que1=$con->query($sel1);
    while($fet1=$que1->fetch_assoc())
    {
        $temp[]=$fet1[d_id];
        $a++;
    }
    /////////////////////////for level second
    
    for($x=0;$x<count($temp);$x++)
    {
    	$sel3="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'";
    	$que3=$con->query($sel3);
    	while($fet3=$que3->fetch_assoc())
    	{
    	    //echo "<br>".$fet3[d_id];
    		$temp1[]=$fet3[d_id];
    		$a++;
    	}
    }
    unset($temp);
    $temp=array();
    /////////////////////////////////////////////////////////////////////////////////////////////level 3
    for($x=0;$x<count($temp1);$x++)
    {
    	$sel5="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'";
    	$que5=$con->query($sel5);
    	while($fet5=$que5->fetch_assoc())
    	{
    	//echo "<br>".$fet5[d_id];
    		$temp[]=$fet5[d_id];
    				//echo "&nbsp;B.V".find_own_rbv($fet5[ibo_id])."<br>";
    		$a++;
    	}
    }
    unset($temp1);
    $temp1=array();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    for ($rff = 0; $rff <= 150; $rff++)
    {   //echo $rff."rff<br>";
    //echo count($temp1)."temp1";
    if(count($temp)==0){ if(count($temp1)==0){ break;}}
    	for($x=0;$x<count($temp);$x++)
    	{
    
    	$sel13=$con->query("SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'");
    	
    		while($fet13=$sel13->fetch_assoc())
    		{
    			$temp1[]=$fet13[d_id];
    			$a++;
    		}
    	
    	}
    
    unset($temp);
    $temp=array();
    	  
    	  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	  for($x=0;$x<count($temp1);$x++)
    	  {
    		 
    		  $sel5=$con->query("SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'");
    	
    		  while($fet15=$sel5->fetch_assoc())
    		  {
    			  $temp[]=$fet15[d_id];
    			    $a++;
    		  }
    	
    	  }
    unset($temp1);
    $temp1=array();
    }
    return $a;
}

///////////////////////////////////function for finding total activated ID
//////////////////////////////////////
/////////////////////////////////////////////////////////
function for_finding_under_total_activated_id($d_id)
{
    global $con;
    $a=0;
    $sel="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `d_id`='$d_id'";
    $que=$con->query($sel);
    $fet=$que->fetch_assoc();
    if($fet[a_status]=="y")
    {
          $a=1;
    }
    
    /////////////////////////for level One
    $temp=array();
    $temp1=array();
    
    $sel1="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$fet[d_id]'";
    $que1=$con->query($sel1);
    while($fet1=$que1->fetch_assoc())
    {
        
        $temp[]=$fet1[d_id];
        if($fet1[a_status]=="y")
        {
           $a++;
        }
    }
    /////////////////////////for level second
    
    for($x=0;$x<count($temp);$x++)
    {
    	$sel3="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'";
    	$que3=$con->query($sel3);
    	while($fet3=$que3->fetch_assoc())
    	{
    	    //echo "<br>".$fet3[d_id];
    		$temp1[]=$fet3[d_id];
    		if($fet3[a_status]=="y")
            {
               $a++;
            }
    	}
    }
    unset($temp);
    $temp=array();
    /////////////////////////////////////////////////////////////////////////////////////////////level 3
    for($x=0;$x<count($temp1);$x++)
    {
    	$sel5="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'";
    	$que5=$con->query($sel5);
    	while($fet5=$que5->fetch_assoc())
    	{
    	//echo "<br>".$fet5[d_id];
    		$temp[]=$fet5[d_id];
    				//echo "&nbsp;B.V".find_own_rbv($fet5[ibo_id])."<br>";
    		if($fet5[a_status]=="y")
            {
               $a++;
            }
    	}
    }
    unset($temp1);
    $temp1=array();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    for ($rff = 0; $rff <= 150; $rff++)
    {   //echo $rff."rff<br>";
    //echo count($temp1)."temp1";
    if(count($temp)==0){ if(count($temp1)==0){ break;}}
    	for($x=0;$x<count($temp);$x++)
    	{
    
    	$sel13=$con->query("SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'");
    	
    		while($fet13=$sel13->fetch_assoc())
    		{
    			$temp1[]=$fet13[d_id];
    			if($fet13[a_status]=="y")
                {
                   $a++;
                }
    		}
    	
    	}
    
    unset($temp);
    $temp=array();
    	  
    	  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	  for($x=0;$x<count($temp1);$x++)
    	  {
    		 
    		  $sel5=$con->query("SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'");
    	
    		  while($fet15=$sel5->fetch_assoc())
    		  {
    			  $temp[]=$fet15[d_id];
    			    if($fet15[a_status]=="y")
                    {
                       $a++;
                    }
    		  }
    	
    	  }
    unset($temp1);
    $temp1=array();
    	
    }
    return $a;
}

///////////////////////////////////////////////function for finding direct ids
function for_finding_under_direct_id_number($d_id, $s_id)
{
    global $con;
    $a=0;
    $sel="SELECT d_id,placement_id,s_id FROM `distributor` WHERE `d_id`='$d_id'";
    $que=$con->query($sel);
    $fet=$que->fetch_assoc();
    //echo $d_id;
    if($fet[s_id]==$s_id)
    {
       $a++;
    }
    
    /////////////////////////for level One
    $temp=array();
    $temp1=array();
    
    $sel1="SELECT d_id,placement_id,a_status,s_id FROM `distributor` WHERE `placement_id`='$fet[d_id]'";
    $que1=$con->query($sel1);
    while($fet1=$que1->fetch_assoc())
    {
        
        $temp[]=$fet1[d_id];
        if($fet1[s_id]==$s_id)
        {
           $a++;
        }
    }
    /////////////////////////for level second
    
    for($x=0;$x<count($temp);$x++)
    {
    	$sel3="SELECT d_id,placement_id,a_status,s_id FROM `distributor` WHERE `placement_id`='$temp[$x]'";
    	$que3=$con->query($sel3);
    	while($fet3=$que3->fetch_assoc())
    	{
    	    //echo "<br>".$fet3[d_id];
    		$temp1[]=$fet3[d_id];
    		if($fet3[s_id]==$s_id)
            {
               $a++;
            }
    	}
    }
    unset($temp);
    $temp=array();
    /////////////////////////////////////////////////////////////////////////////////////////////level 3
    for($x=0;$x<count($temp1);$x++)
    {
    	$sel5="SELECT d_id,placement_id,a_status,s_id FROM `distributor` WHERE `placement_id`='$temp1[$x]'";
    	$que5=$con->query($sel5);
    	while($fet5=$que5->fetch_assoc())
    	{
    	//echo "<br>".$fet5[d_id];
    		$temp[]=$fet5[d_id];
    				//echo "&nbsp;B.V".find_own_rbv($fet5[ibo_id])."<br>";
    		if($fet5[s_id]==$s_id)
            {
               $a++;
            }
    	}
    }
    unset($temp1);
    $temp1=array();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    for ($rff = 0; $rff <= 150; $rff++)
    {   //echo $rff."rff<br>";
    //echo count($temp1)."temp1";
    if(count($temp)==0){ if(count($temp1)==0){ break;}}
    	for($x=0;$x<count($temp);$x++)
    	{
    
    	$sel13=$con->query("SELECT d_id,placement_id,a_status,s_id FROM `distributor` WHERE `placement_id`='$temp[$x]'");
    	
    		while($fet13=$sel13->fetch_assoc())
    		{
    			$temp1[]=$fet13[d_id];
    			if($fet13[s_id]==$s_id)
                {
                   $a++;
                }
    		}
    	
    	}
    
    unset($temp);
    $temp=array();
    	  
    	  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	  for($x=0;$x<count($temp1);$x++)
    	  {
    		 
    		  $sel5=$con->query("SELECT d_id,placement_id,a_status,s_id FROM `distributor` WHERE `placement_id`='$temp1[$x]'");
    	
    		  while($fet15=$sel5->fetch_assoc())
    		  {
    			  $temp[]=$fet15[d_id];
    			    if($fet15[s_id]==$s_id)
                    {
                       $a++;
                    }
    		  }
    	
    	  }
    unset($temp1);
    $temp1=array();
    	
    }
    return $a;
}
///////////////////////////////////////////////function for finding direct Activated ids
function for_finding_under_direct_activated_id_number($d_id, $s_id)
{
    global $con;
    $a=0;
    $sel="SELECT d_id,placement_id,s_id,a_status FROM `distributor` WHERE `d_id`='$d_id'";
    $que=$con->query($sel);
    $fet=$que->fetch_assoc();
    //echo $d_id;
    if($fet[s_id]==$s_id)
    {
        if($fet[a_status]=='y')
        {
            $a++;
        }
    }
    
    /////////////////////////for level One
    $temp=array();
    $temp1=array();
    
    $sel1="SELECT d_id,placement_id,a_status,s_id FROM `distributor` WHERE `placement_id`='$fet[d_id]'";
    $que1=$con->query($sel1);
    while($fet1=$que1->fetch_assoc())
    {
        
        $temp[]=$fet1[d_id];
        if($fet1[s_id]==$s_id)
        {
           if($fet1[a_status]=='y')
            {
                $a++;
            }
        }
    }
    /////////////////////////for level second
    
    for($x=0;$x<count($temp);$x++)
    {
    	$sel3="SELECT d_id,placement_id,a_status,s_id FROM `distributor` WHERE `placement_id`='$temp[$x]'";
    	$que3=$con->query($sel3);
    	while($fet3=$que3->fetch_assoc())
    	{
    	    //echo "<br>".$fet3[d_id];
    		$temp1[]=$fet3[d_id];
    		if($fet3[s_id]==$s_id)
            {
               if($fet3[a_status]=='y')
                {
                    $a++;
                }
            }
    	}
    }
    unset($temp);
    $temp=array();
    /////////////////////////////////////////////////////////////////////////////////////////////level 3
    for($x=0;$x<count($temp1);$x++)
    {
    	$sel5="SELECT d_id,placement_id,a_status,s_id FROM `distributor` WHERE `placement_id`='$temp1[$x]'";
    	$que5=$con->query($sel5);
    	while($fet5=$que5->fetch_assoc())
    	{
    	//echo "<br>".$fet5[d_id];
    		$temp[]=$fet5[d_id];
    				//echo "&nbsp;B.V".find_own_rbv($fet5[ibo_id])."<br>";
    		if($fet5[s_id]==$s_id)
            {
               if($fet5[a_status]=='y')
                {
                    $a++;
                }
            }
    	}
    }
    unset($temp1);
    $temp1=array();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    for ($rff = 0; $rff <= 150; $rff++)
    {   //echo $rff."rff<br>";
    //echo count($temp1)."temp1";
    if(count($temp)==0){ if(count($temp1)==0){ break;}}
    	for($x=0;$x<count($temp);$x++)
    	{
    
    	$sel13=$con->query("SELECT d_id,placement_id,a_status,s_id FROM `distributor` WHERE `placement_id`='$temp[$x]'");
    	
    		while($fet13=$sel13->fetch_assoc())
    		{
    			$temp1[]=$fet13[d_id];
    			if($fet13[s_id]==$s_id)
                {
                   if($fet13[a_status]=='y')
                    {
                        $a++;
                    }
                }
    		}
    	
    	}
    
    unset($temp);
    $temp=array();
    	  
    	  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	  for($x=0;$x<count($temp1);$x++)
    	  {
    		 
    		  $sel5=$con->query("SELECT d_id,placement_id,a_status,s_id FROM `distributor` WHERE `placement_id`='$temp1[$x]'");
    	
    		  while($fet15=$sel5->fetch_assoc())
    		  {
    			  $temp[]=$fet15[d_id];
    			    if($fet15[s_id]==$s_id)
                    {
                       if($fet15[a_status]=='y')
                        {
                            $a++;
                        }
                    }
    		  }
    	
    	  }
    unset($temp1);
    $temp1=array();
    	
    }
    return $a;
}

///////////////////////////////////function for finding total activated ID
//////////////////////////////////////
/////////////////////////////////////////////////////////
function for_finding_under_total_activated_id_date($d_id,$date)
{
        global $con;
        $a=0;
    $sel="SELECT d_id,placement_id,a_status,a_date FROM `distributor` WHERE `d_id`='$d_id'";
    $que=$con->query($sel);
    $fet=$que->fetch_assoc();
    if($fet[a_status]=="y" && $fet[a_date]==$date)
    {
          $a=1;
    }
    
    /////////////////////////for level One
    $temp=array();
    $temp1=array();
    
    $sel1="SELECT d_id,placement_id,a_status,a_date FROM `distributor` WHERE `placement_id`='$fet[d_id]'";
    $que1=$con->query($sel1);
    while($fet1=$que1->fetch_assoc())
    {
        
        $temp[]=$fet1[d_id];
        if($fet1[a_status]=="y" && $fet1[a_date]==$date)
        {
           $a++;
        }
    }
    /////////////////////////for level second
    
    for($x=0;$x<count($temp);$x++)
    {
    	$sel3="SELECT d_id,placement_id,a_status,a_date FROM `distributor` WHERE `placement_id`='$temp[$x]'";
    	$que3=$con->query($sel3);
    	while($fet3=$que3->fetch_assoc())
    	{
    	    //echo "<br>".$fet3[d_id];
    		$temp1[]=$fet3[d_id];
    		if($fet3[a_status]=="y" && $fet3[a_date]==$date)
            {
               $a++;
            }
    	}
    }
    unset($temp);
    $temp=array();
    /////////////////////////////////////////////////////////////////////////////////////////////level 3
    for($x=0;$x<count($temp1);$x++)
    {
    	$sel5="SELECT d_id,placement_id,a_status,a_date FROM `distributor` WHERE `placement_id`='$temp1[$x]'";
    	$que5=$con->query($sel5);
    	while($fet5=$que5->fetch_assoc())
    	{
    	//echo "<br>".$fet5[d_id];
    		$temp[]=$fet5[d_id];
    				//echo "&nbsp;B.V".find_own_rbv($fet5[ibo_id])."<br>";
    		if($fet5[a_status]=="y" && $fet5[a_date]==$date)
            {
               $a++;
            }
    	}
    }
    unset($temp1);
    $temp1=array();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    for ($rff = 0; $rff <= 150; $rff++)
    {   //echo $rff."rff<br>";
    //echo count($temp1)."temp1";
    if(count($temp)==0){ if(count($temp1)==0){ break;}}
    	for($x=0;$x<count($temp);$x++)
    	{
    
    	$sel13=$con->query("SELECT d_id,placement_id,a_status,a_date FROM `distributor` WHERE `placement_id`='$temp[$x]'");
    	
    		while($fet13=$sel13->fetch_assoc())
    		{
    			$temp1[]=$fet13[d_id];
    			if($fet13[a_status]=="y" && $fet13[a_date]==$date)
                {
                   $a++;
                }
    		}
    	}
    unset($temp);
    $temp=array();
    	  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	  for($x=0;$x<count($temp1);$x++)
    	  {
    		  $sel5=$con->query("SELECT d_id,placement_id,a_status,a_date FROM `distributor` WHERE `placement_id`='$temp1[$x]'");
    	
    		  while($fet15=$sel5->fetch_assoc())
    		  {
    			  $temp[]=$fet15[d_id];
    			    if($fet15[a_status]=="y" && $fet15[a_date]==$date)
                    {
                       $a++;
                    }
    		  }
    	
    	  }
    unset($temp1);
    $temp1=array();
    }
    return $a;
}

/////////////////////////////////function for finalising business
//////////////
function find_to_business_to_final($dateee,$interval)
{
    global $con,$date,$time;
     if (strpos($time, 'am') == true) {
            $current_interval="am";
        }
    elseif(strpos($time, 'pm') == true){
        $current_interval="pm";
    }
    $frss="SELECT * FROM `business_hundler` WHERE `date`='$dateee' AND `date_interval`='$interval'";
    $sdsd=$con->query($frss);
    $cou=$sdsd->num_rows;
    
    if($date<=$dateee && $current_interval==$interval)
    {
        $a=0;
    }
    elseif($date<=$dateee && $current_interval=='pm'){
        $a=0;
    }
    elseif($cou>0){
        $a=0;
    }
    else
    {
        $a=1;
    }
    return $a;
}

/////////////////////////////////function for finding next finalising date
function find_next_final_interval()
{
    global $con,$date,$time;
    //////////////////find last final date interval
    $fvsasas="SELECT MAX(bh_id) AS `max_id` FROM `business_hundler`";
    $erf=$con->query($fvsasas);
    $max_id=$erf->fetch_assoc();
    //echo $max_id[max_id];
    /////////////////////////find last final date
    $frss="SELECT * FROM `business_hundler` WHERE `bh_id`='$max_id[max_id]'";
    $sdsd=$con->query($frss);
    $ds=$sdsd->fetch_assoc();
    
    $dfrss="SELECT * FROM `business_hundler` WHERE `date`='$ds[date]'";
    $dsdsd=$con->query($dfrss);
    
    //echo $ds[date];
    ////////////////////////for checking weather two entry are their or not on last date finalising
    if($dsdsd->num_rows==1)
    {
        $datee=$ds[date];
        $interv="pm";
    }elseif($dsdsd->num_rows>=2)
    {
        $datee = new DateTime($ds[date]);

        $datee->modify('+1 day');
        $datee=$datee->format('Y-m-d');
        $interv="am";
    }
    //echo $interv;
    $bh_id=$max_id[max_id]+1;
    //echo find_to_business_to_final($datee,$interv);
    if(find_to_business_to_final($datee,$interv)==1)
    {
        $sel_d="SELECT * FROM `distributor` WHERE `a_status`='y'";
        $d_que=$con->query($sel_d);
        while($ert=$d_que->fetch_assoc())
        {
         //   echo $ert[d_id]." D_id , ".$datee." Date, ".$interv." interval, ".$bh_id."<br>";
            for_finaling_business_commission($ert[d_id], $datee, $interv, $bh_id);
            //for_distributing_direct_id_commission($ert[d_id], $datee, $interv, $bh_id);
        }
        $bh_ins="INSERT INTO `business_hundler` (`bh_id`, `date`, `date_interval`, `f_date`, `f_time`, `amount_distributed`, `amount_flush_out`, `business_month`) VALUES (NULL, '$datee', '$interv', '$date', '$time', '', '', '');";
        $con->query($bh_ins);
        //echo "ins";
        
    }
   //echo $datee.$interv;
}
//////////////////function for finding downline business
function final_own_business_nv_by_interval($d_id, $datee, $interv)
{
    global $con,$date,$time;
    $re=0;
    $ssc="SELECT * FROM `billing` WHERE `d_id`='$d_id' AND `date`='$datee'";
    $squ=$con->query($ssc);
    while($sfe=$squ->fetch_assoc())
    {
        //$re=$re+$sfe[pv];
        if (strpos($sfe[time], $interv) == true) {
            $re=$re+$sfe[pv];
        }
    }
    return $re;
}
////////////////////////////////function for calculating business
function for_finding_under_total_nv_inter($d_id, $datee, $interv)
{
    
    global $con, $date, $time;
    $a=0;
    $sel="SELECT d_id,placement_id FROM `distributor` WHERE `d_id`='$d_id'";
    $que=$con->query($sel);
    $fet=$que->fetch_assoc();
    if($que->num_rows>0)
    {
        $a=$a+final_own_business_nv_by_interval($d_id, $datee, $interv);
    }
    /////////////////////////for level One
    $temp=array();
    $temp1=array();
    $sel1="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$fet[d_id]'";
    $que1=$con->query($sel1);
    while($fet1=$que1->fetch_assoc())
    {
        $temp[]=$fet1[d_id];
        $a=$a+final_own_business_nv_by_interval($fet1[d_id], $datee, $interv);
    }
    /////////////////////////for level second
    
    for($x=0;$x<count($temp);$x++)
    {
    	$sel3="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'";
    	$que3=$con->query($sel3);
    	while($fet3=$que3->fetch_assoc())
    	{
    	    //echo "<br>".$fet3[d_id];
    		$temp1[]=$fet3[d_id];
    		$a=$a+final_own_business_nv_by_interval($fet3[d_id], $datee, $interv);
    	}
    }
    unset($temp);
    $temp=array();
    /////////////////////////////////////////////////////////////////////////////////////////////level 3
    for($x=0;$x<count($temp1);$x++)
    {
    	$sel5="SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'";
    	$que5=$con->query($sel5);
    	while($fet5=$que5->fetch_assoc())
    	{
    	//echo "<br>".$fet5[d_id];
    		$temp[]=$fet5[d_id];
    				//echo "&nbsp;B.V".find_own_rbv($fet5[ibo_id])."<br>";
    		$a=$a+final_own_business_nv_by_interval($fet5[d_id], $datee, $interv);
    	}
    }
    unset($temp1);
    $temp1=array();
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    for ($rff = 0; $rff <= 150; $rff++)
    {   //echo $rff."rff<br>";
    //echo count($temp1)."temp1";
    if(count($temp)==0){ if(count($temp1)==0){ break;}}
    	for($x=0;$x<count($temp);$x++)
    	{
    
    	$sel13=$con->query("SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp[$x]'");
    	
    		while($fet13=$sel13->fetch_assoc())
    		{
    			$temp1[]=$fet13[d_id];
    			$a=$a+final_own_business_nv_by_interval($fet13[d_id], $datee, $interv);
    		}
    	
    	}
    
    unset($temp);
    $temp=array();
    	  
    	  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	  for($x=0;$x<count($temp1);$x++)
    	  {
    		 
    		  $sel5=$con->query("SELECT d_id,placement_id,a_status FROM `distributor` WHERE `placement_id`='$temp1[$x]'");
    	
    		  while($fet15=$sel5->fetch_assoc())
    		  {
    			  $temp[]=$fet15[d_id];
    			    $a=$a+final_own_business_nv_by_interval($fet15[d_id], $datee, $interv);
    		  }
    	
    	  }
    unset($temp1);
    $temp1=array();
    }
    return $a;
}
///////////////////////function for_finaling_business_commission
function for_finaling_business_commission($d_id, $datee, $interv, $bh_id)
{
    global $con, $date, $time, $url, $ipad;
    $frpoer="SELECT * FROM `id_business_handler` WHERE `d_id`='$d_id'";
    $erplzk=$con->query($frpoer);
    $count_fina=$erplzk->num_rows;
    $count_fina=$count_fina/60;
  /*  if(is_int($count_fina)==1)
    {
        $l_0cf="UPDATE `distributor` SET `left_leg_cf` = '0' WHERE `distributor`.`d_id` = '$d_id';";
        $r_0cf="UPDATE `distributor` SET `right_leg_cf` = '0' WHERE `distributor`.`d_id` = '$d_id';";
        if($con->query($l_0cf)===TRUE && $con->query($r_0cf)===TRUE)
        {
            
        }else{
            $ref="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', 'n', 'id_business_handler table insert', '$d_id', '$url', '$ipad', 'after 30 day cf 0 update query');";
            $con->query($ref);
        }
        
    }*/
    
    
    $sel="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
    $que=$con->query($sel);
    $fet=$que->fetch_assoc();
    
    $left_new_nv=for_finding_under_total_nv_inter($fet[left_id], $datee, $interv);
    $right_new_nv=for_finding_under_total_nv_inter($fet[right_id], $datee, $interv);
    $b_left_cf_left=$fet[left_leg_cf];
    $b_left_cf_right=$fet[right_leg_cf];
    //echo "before leg cf ".$b_left_cf_left." - ".$b_left_cf_right;
    $to_n_left=$left_new_nv+$b_left_cf_left+0;
    $to_n_right=$right_new_nv+$b_left_cf_right+0;
    
   //echo "new leg cf ".$left_new_nv." - ".$right_new_nv;
    
    if($fet[pair_matched]>0)
    {
        ///////////////////find small nv leg
        if($to_n_left>$to_n_right){ $total_pair_will_matched=$to_n_right;
                                    $small_leg="Right";
            
            $tot_new_left_cf_left=$to_n_left-$to_n_right;
            $tot_new_left_cf_right=0;
            
        }
        elseif($to_n_left<$to_n_right){ $total_pair_will_matched=$to_n_left;
                                        $small_leg="Left";
            $tot_new_left_cf_left=0;
            $tot_new_left_cf_right=$to_n_right-$to_n_left;
        }
        else{
            $total_pair_will_matched=$to_n_right;
             $small_leg="Right";
             $tot_new_left_cf_left=$to_n_left-$to_n_right;
             $tot_new_left_cf_right=0;
        }
        $loop_run=($total_pair_will_matched/10)+$fet[pair_matched];
       //echo $loop_run;
        
        //////////////////finaling commission 
        $id_pair_matched_before=$fet[pair_matched]+1;
        //////////////////////////for finding how much pair to be matched
        if($fet[position]=="Distributor"){$pair_match_no=$id_pair_matched_before+0; $pair_caping=3;}
        elseif($fet[position]=="Silver"){$pair_match_no=$id_pair_matched_before+0; $pair_caping=3;}
        elseif($fet[position]=="Gold"){$pair_match_no=$id_pair_matched_before+4; $pair_caping=15;}
        else{$pair_match_no=$id_pair_matched_before+0; $pair_caping=3;}
        $pair_counter=0;
        $pair_e=0;
        $pair_cut=0;
        if($total_pair_will_matched>0){
            for($x=$id_pair_matched_before; $x<=$loop_run; $x++)
            {
                $pair_counter++;
                $xe=$x/4;
                
                //echo $x;
                if($x==3 || $x==5 || $x==7 || $x==10)
                {
                    //distribute commission
                    $pair_cut++;
                    
                }else{
                    
                    
                    $pair_e++;
                    //echo " -> pair cut";
                }
                
                if($pair_counter==$pair_caping){
                    break;
                }
            }
        }else{
            $pair_e=0;
            $pair_cut=0;
        }
        //echo $pair_e."/".$pair_cut."<br>";
        $commission_amount=$pair_e*1000;
        $tds_cut=$commission_amount*5/100;
        $admin_cut=0;
        $net_amount=$commission_amount-$tds_cut-$admin_cut;
        
        if($pair_cut==1)
        {
            $pair_cut_amount=$pair_cut*1000;
            $pair_cut_ins="INSERT INTO `pair_cutting_information` (`pci_id`, `d_id`, `bh_id`, `date`, `interval`, `pair_no`, `amount`) VALUES (NULL, '$d_id', '$bh_id', '$datee', '$interv', '$x', '$pair_cut_amount');";
            $con->query($pair_cut_ins);
        }
        $flushed_paired=($total_pair_will_matched/10)-($pair_e+$pair_cut);
        $flush_amount=$flushed_paired*1000;
        $t_pair_matched=$pair_e+$pair_cut;
        $new_no_of_pair_matched=$fet[pair_matched]+$t_pair_matched;
        
        ///////////////insert_into tds
        $tds_yyt=$fet[tds_wallet]+$tds_cut;
        $tds_up="UPDATE `distributor` SET `tds_wallet` = '$tds_yyt' WHERE `distributor`.`d_id` = '$d_id'";
        $tds_ins="INSERT INTO `tds_collected_history` (`tch_id`, `d_id`, `date`, `interval`, `tds`, `b_tds`, `a_tds`, `note`, `of_amount`, `pancard`) VALUES (NULL, '$d_id', '$datee', '$interv', '$tds_cut', '$fet[tds_wallet]', '$tds_yyt', 'Pair Matched Commission', '$commission_amount', '');";
        
        //////////////////insert admin Information
        $admin_sadsa=$fet[admin_wallet]+$admin_cut;
        $admin_ins="INSERT INTO `admin_wallet_history` (`awh_id`, `d_id`, `date`, `interval`, `admin`, `b_admin`, `a_admin`, `note`) VALUES (NULL, '$d_id', '$datee', '$interv', '$admin_cut', '$fet[admin_wallet]', '$admin_sadsa', 'Pair Commission');";
        $admin_up="UPDATE `distributor` SET `admin_wallet` = '$admin_sadsa' WHERE `distributor`.`d_id` = '$d_id';";
        
        //////////////////////////for update hold wallet
        $hold_abal=$fet[hold_amount]+$net_amount;
        $hold_ins="INSERT INTO `hold_wallet` (`hw_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id', '$datee', '$interv', '$net_amount', '$fet[hold_amount]', '$hold_abal', '+', 'Direct Commission');";
        $hold_up="UPDATE `distributor` SET `hold_amount` = '$hold_abal' WHERE `distributor`.`d_id` = '$d_id';";
        
        /////////////////////////////
        $updt="UPDATE `distributor` SET `pair_matched` = '$new_no_of_pair_matched' WHERE `distributor`.`d_id` = '$d_id';";
        $upcfl="UPDATE `distributor` SET `left_leg_cf` = '$tot_new_left_cf_left' WHERE `distributor`.`d_id` = '$d_id';";
        $upcfr="UPDATE `distributor` SET `right_leg_cf` = '$tot_new_left_cf_right' WHERE `distributor`.`d_id` = '$d_id';";
        $inss="INSERT INTO `id_business_handler` (`ibh_id`, `bh_id`, `d_id`, `date`, `interval`, `n_left_nv`, `n_right_nv`, `o_cf_left_id`, `o_cf_right_id`, `total_n_cf_left`, `total_n_cf_right`, `pair_matched`, `flush_pair`, `commission`, `flush_amount`, `tds`, `admin`, `final_commission`, `pin_level`) VALUES (NULL, '$bh_id', '$d_id', '$datee', '$interv', '$left_new_nv', '$right_new_nv', '$b_left_cf_left', '$b_left_cf_right', '$tot_new_left_cf_left', '$tot_new_left_cf_right', '$t_pair_matched', '$flushed_paired', '$commission_amount', '$flush_amount', '$tds_cut', '$admin_cut', '$net_amount', '$fet[position]');";
        
        if($con->query($inss)==TRUE && $con->query($updt)==TRUE && $con->query($upcfl)==TRUE && $con->query($upcfr)==TRUE && $con->query($tds_ins)==TRUE && $con->query($tds_up)==TRUE  && $con->query($admin_ins)==TRUE  && $con->query($admin_up)==TRUE  && $con->query($hold_ins)==TRUE  && $con->query($hold_up)==TRUE)
        {
           //echo "Success";
        }
        else{
            $ref="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', 'n', 'id_business_handler table insert', '$d_id', '$url', '$ipad', 'business final');";
            $con->query($ref);
        }
    }
    else{
        //echo "first pair tag open<br>";
        if($to_n_left>=$to_n_right){ $total_pair_will_matched=$to_n_right;
                                $small_leg="Right";
        
            $tot_new_left_cf_left=$to_n_left-20;
            $tot_new_left_cf_right=$to_n_right-10;
            
        }
        elseif($to_n_left<$to_n_right){ $total_pair_will_matched=$to_n_left;
                                        $small_leg="Left";
            $tot_new_left_cf_left=$to_n_left-10;
            $tot_new_left_cf_right=$to_n_right-20;
        }
        
        if($tot_new_left_cf_left>=0 && $tot_new_left_cf_right>=0)
        {
        
            ///////////////direct_id information
            $left_d_a=for_finding_under_direct_activated_id_number($fet[left_id], $d_id);
            $right_d_a=for_finding_under_direct_activated_id_number($fet[right_id], $d_id);
            if($left_d_a > 0 && $right_d_a >0)
            {
               //echo "left direct big tag<br>";
               
                
                
               //echo $tot_new_left_cf_left."left leg cf<br>";
                //echo $tot_new_left_cf_right."right leg cf<br>";
                if($tot_new_left_cf_left>=0 && $tot_new_left_cf_right>=0)
                {
                    $commission_amount=1000;
                    $tds_cut=$commission_amount*5/100;
                    $admin_cut=0;
                    $net_amount=$commission_amount-$tds_cut-$admin_cut; 
                    
                    $flushed_paired=0;
                    $flush_amount=0;
                    $t_pair_matched=1;
                    
                    $new_no_of_pair_matched=1;
                    
                    ///////////////insert_into tds
                    $tds_yyt=$fet[tds_wallet]+$tds_cut;
                    $tds_up="UPDATE `distributor` SET `tds_wallet` = '$tds_yyt' WHERE `distributor`.`d_id` = '$d_id'";
                    $tds_ins="INSERT INTO `tds_collected_history` (`tch_id`, `d_id`, `date`, `interval`, `tds`, `b_tds`, `a_tds`, `note`, `of_amount`, `pancard`) VALUES (NULL, '$d_id', '$datee', '$interv', '$tds_cut', '$fet[tds_wallet]', '$tds_yyt', 'Pair Matched Commission', '$commission_amount', '');";
                    
                    //////////////////insert admin Information
                    $admin_sadsa=$fet[admin_wallet]+$admin_cut;
                    $admin_ins="INSERT INTO `admin_wallet_history` (`awh_id`, `d_id`, `date`, `interval`, `admin`, `b_admin`, `a_admin`, `note`) VALUES (NULL, '$d_id', '$datee', '$interv', '$admin_cut', '$fet[admin_wallet]', '$admin_sadsa', 'Pair Commission');";
                    $admin_up="UPDATE `distributor` SET `admin_wallet` = '$admin_sadsa' WHERE `distributor`.`d_id` = '$d_id';";
                    
                    //////////////////////////for update hold wallet
                    $hold_abal=$fet[hold_amount]+$net_amount;
                    $hold_ins="INSERT INTO `hold_wallet` (`hw_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id', '$datee', '$interv', '$net_amount', '$fet[hold_amount]', '$hold_abal', '+', 'Direct Commission');";
                    $hold_up="UPDATE `distributor` SET `hold_amount` = '$hold_abal' WHERE `distributor`.`d_id` = '$d_id';";
                    
                    //////////////////
                    $updt="UPDATE `distributor` SET `pair_matched` = '1'     WHERE `distributor`.`d_id` = '$d_id';";
                    $upcfl="UPDATE `distributor` SET `left_leg_cf` = '$tot_new_left_cf_left' WHERE `distributor`.`d_id` = '$d_id';";
                    $upcfr="UPDATE `distributor` SET `right_leg_cf` = '$tot_new_left_cf_right' WHERE `distributor`.`d_id` = '$d_id';";
                    $inss="INSERT INTO `id_business_handler` (`ibh_id`, `bh_id`, `d_id`, `date`, `interval`, `n_left_nv`, `n_right_nv`, `o_cf_left_id`, `o_cf_right_id`, `total_n_cf_left`, `total_n_cf_right`, `pair_matched`, `flush_pair`, `commission`, `flush_amount`, `tds`, `admin`, `final_commission`, `pin_level`) VALUES (NULL, '$bh_id', '$d_id', '$datee', '$interv', '$left_new_nv', '$right_new_nv', '$b_left_cf_left', '$b_left_cf_right', '$tot_new_left_cf_left', '$tot_new_left_cf_right', '1', '$flushed_paired', '$commission_amount', '$flush_amount', '$tds_cut', '$admin_cut', '$net_amount', '$fet[position]');";
                    
                    if($con->query($inss)==TRUE && $con->query($updt)==TRUE && $con->query($upcfl)==TRUE && $con->query($upcfr)==TRUE && $con->query($tds_ins)==TRUE && $con->query($tds_up)==TRUE  && $con->query($admin_ins)==TRUE  && $con->query($admin_up)==TRUE  && $con->query($hold_ins)==TRUE  && $con->query($hold_up)==TRUE)
                    {
                       //echo "Success";
                    }
                    else{
                        $ref="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', 'n', 'id_business_handler table insert', '$d_id', '$url', '$ipad', 'business final');";
                        $con->query($ref);
                    }
                    /*$flushed_paired=($tot_new_left_cf_right/10)+1;
                    $flush_amount=$flushed_paired*1000;
                    $t_pair_matched=$flushed_paired+1;
                    $new_no_of_pair_matched=1;
                    $updt="UPDATE `distributor` SET `pair_matched` = '1'     WHERE `distributor`.`d_id` = '$d_id';";
                    $upcfl="UPDATE `distributor` SET `left_leg_cf` = '$tot_new_left_cf_left' WHERE `distributor`.`d_id` = '$d_id';";
                    $upcfr="UPDATE `distributor` SET `right_leg_cf` = '0' WHERE `distributor`.`d_id` = '$d_id';";
                    $inss="INSERT INTO `id_business_handler` (`ibh_id`, `bh_id`, `d_id`, `date`, `interval`, `n_left_nv`, `n_right_nv`, `o_cf_left_id`, `o_cf_right_id`, `total_n_cf_left`, `total_n_cf_right`, `pair_matched`, `flush_pair`, `commission`, `flush_amount`, `tds`, `admin`, `final_commission`, `pin_level`) VALUES (NULL, '$bh_id', '$d_id', '$datee', '$interv', '$left_new_nv', '$right_new_nv', '$b_left_cf_left', '$b_left_cf_right', '$tot_new_left_cf_left', '0', '0', '$flushed_paired', '0', '$flush_amount', '0', '0', '0', '$fet[position]');";
                    
                    if($con->query($inss)==TRUE && $con->query($updt)==TRUE && $con->query($upcfl)==TRUE && $con->query($upcfr)==TRUE)
                    {
                       //echo "Success";
                    }
                    else{
                        $ref="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', 'n', 'id_business_handler table insert', '$d_id', '$url', '$ipad', 'business final');";
                        $con->query($ref);
                    }*/
                }
                else{
                    $upcfl="UPDATE `distributor` SET `left_leg_cf` = '$to_n_left' WHERE `distributor`.`d_id` = '$d_id';";
                    $upcfr="UPDATE `distributor` SET `right_leg_cf` = '$to_n_right' WHERE `distributor`.`d_id` = '$d_id';";
                    $inss="INSERT INTO `id_business_handler` (`ibh_id`, `bh_id`, `d_id`, `date`, `interval`, `n_left_nv`, `n_right_nv`, `o_cf_left_id`, `o_cf_right_id`, `total_n_cf_left`, `total_n_cf_right`, `pair_matched`, `flush_pair`, `commission`, `flush_amount`, `tds`, `admin`, `final_commission`, `pin_level`) VALUES (NULL, '$bh_id', '$d_id', '$datee', '$interv', '$left_new_nv', '$right_new_nv', '$b_left_cf_left', '$b_left_cf_right', '$to_n_left', '$to_n_right', '0', '0', '0', '0', '0', '0', '0', '$fet[position]');";
                    if($con->query($upcfl)===TRUE && $con->query($upcfr)===TRUE && $con->query($inss)===TRUE)
                    {
                        
                    }
                    else{
                        $ref="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', 'n', 'id_business_handler table insert', '$d_id', '$url', '$ipad', 'business final');";
                        $con->query($ref);
                    }
                }
                
            }
            else{
                $upcfl="UPDATE `distributor` SET `left_leg_cf` = '$to_n_left' WHERE `distributor`.`d_id` = '$d_id';";
                $upcfr="UPDATE `distributor` SET `right_leg_cf` = '$to_n_right' WHERE `distributor`.`d_id` = '$d_id';";
                $inss="INSERT INTO `id_business_handler` (`ibh_id`, `bh_id`, `d_id`, `date`, `interval`, `n_left_nv`, `n_right_nv`, `o_cf_left_id`, `o_cf_right_id`, `total_n_cf_left`, `total_n_cf_right`, `pair_matched`, `flush_pair`, `commission`, `flush_amount`, `tds`, `admin`, `final_commission`, `pin_level`) VALUES (NULL, '$bh_id', '$d_id', '$datee', '$interv', '$left_new_nv', '$right_new_nv', '$b_left_cf_left', '$b_left_cf_right', '$to_n_left', '$to_n_right', '0', '0', '0', '0', '0', '0', '0', '$fet[position]');";
                if($con->query($upcfl)===TRUE && $con->query($upcfr)===TRUE && $con->query($inss)===TRUE)
                {
                    
                }
                else{
                    $ref="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', 'n', 'id_business_handler table insert', '$d_id', '$url', '$ipad', 'business final');";
                    $con->query($ref);
                }
            }
        }else{
                $upcfl="UPDATE `distributor` SET `left_leg_cf` = '$to_n_left' WHERE `distributor`.`d_id` = '$d_id';";
                $upcfr="UPDATE `distributor` SET `right_leg_cf` = '$to_n_right' WHERE `distributor`.`d_id` = '$d_id';";
                $inss="INSERT INTO `id_business_handler` (`ibh_id`, `bh_id`, `d_id`, `date`, `interval`, `n_left_nv`, `n_right_nv`, `o_cf_left_id`, `o_cf_right_id`, `total_n_cf_left`, `total_n_cf_right`, `pair_matched`, `flush_pair`, `commission`, `flush_amount`, `tds`, `admin`, `final_commission`, `pin_level`) VALUES (NULL, '$bh_id', '$d_id', '$datee', '$interv', '$left_new_nv', '$right_new_nv', '$b_left_cf_left', '$b_left_cf_right', '$to_n_left', '$to_n_right', '0', '0', '0', '0', '0', '0', '0', '$fet[position]');";
                if($con->query($upcfl)===TRUE && $con->query($upcfr)===TRUE && $con->query($inss)===TRUE)
                {
                    
                }
                else{
                    $ref="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', 'n', 'id_business_handler table insert', '$d_id', '$url', '$ipad', 'business final');";
                    $con->query($ref);
                }
            }
    }
   //echo "Done";
}
////////////////////////
function for_distributing_direct_id_commission($d_id, $datee, $interv, $bh_id)
{
    global $con,$date,$time,$url;
    $a=0;
    $sel="SELECT * FROM `distributor` WHERE `s_id`='$d_id'";
    $que=$con->query($sel);
    while($sdd=$que->fetch_assoc())
    {
        if($sdd[a_date]==$datee)
        {
            if (strpos($sdd[a_time], $interv) == true) {
                $a++;
            }
        }
    }
    
    $seld="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
    $sqoi=$con->query($seld);
    $fet=$sqoi->fetch_assoc();
    
    $commission=$a*700;
    $tds=$commission*5/100;
    $admin=$commission*10/100;
    $net_a=$commission-$tds-$admin;
    
        ///////////////insert_into tds
    $tds_yyt=$fet[tds_wallet]+$tds;
    $tds_up="UPDATE `distributor` SET `tds_wallet` = '$tds_yyt' WHERE `distributor`.`d_id` = '$d_id'";
    $tds_ins="INSERT INTO `tds_collected_history` (`tch_id`, `d_id`, `date`, `interval`, `tds`, `b_tds`, `a_tds`, `note`, `of_amount`, `pancard`) VALUES (NULL, '$d_id', '$datee', '$interv', '$tds', '$fet[tds_wallet]', '$tds_yyt', 'Pair Matched Commission', '$commission_amount', '');";
    
    //////////////////insert admin Information
    $admin_sadsa=$fet[admin_wallet]+$admin;
    $admin_ins="INSERT INTO `admin_wallet_history` (`awh_id`, `d_id`, `date`, `interval`, `admin`, `b_admin`, `a_admin`, `note`) VALUES (NULL, '$d_id', '$datee', '$interv', '$admin', '$fet[admin_wallet]', '$admin_sadsa', 'Pair Commission');";
    $admin_up="UPDATE `distributor` SET `admin_wallet` = '$admin_sadsa' WHERE `distributor`.`d_id` = '$d_id';";
    
    
    //////////////////insert withdrawal Wallet
    
    $hold_abal=$fet[hold_amount]+$net_a;
    $hold_ins="INSERT INTO `hold_wallet` (`hw_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id', '$datee', '$interv', '$net_a', '$fet[hold_amount]', '$hold_abal', '+', 'Direct Commission');";
    $hold_up="UPDATE `distributor` SET `hold_amount` = '$hold_abal' WHERE `distributor`.`d_id` = '$d_id';";
    
    
    $rds="INSERT INTO `direct_commission` (`dc_id`, `bh_id`, `d_id`, `direct_id`, `datee`, `interval`, `commission`, `tds_cut`, `admin_cut`, `net_amount`) VALUES (NULL, '$bh_id', '$d_id', '$a', '$datee', '$interv', '$commission', '$tds', '$admin', '$net_a');";
    if($con->query($rds)==TRUE && $con->query($tds_up)==TRUE && $con->query($tds_ins)==TRUE && $con->query($admin_ins)==TRUE && $con->query($admin_up)==TRUE && $con->query($hold_ins)==TRUE && $con->query($hold_up)==TRUE)
    {
       //echo "Success";
    }
    else{
        $ref="INSERT INTO `fail_entry` (`fe_id`, `date`, `time`, `session_id`, `admin`, `query`, `failed_in_id`, `url`, `ip_addreass`, `note`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', 'n', 'direct_commission table insert', '$d_id', '$url', '$ipad', 'business final');";
        $con->query($ref);
    }
    return $a;
}

function for_changing_position(){
    global $con,$date,$time,$url;
    $ds="SELECT * FROM `distributor`";
    $sa=$con->query($ds);
    while($s=$sa->fetch_assoc()){
        if($s[position]=="Distributor"){
            if($s[position]!="Silver"){
                if($s[pair_matched]>0){
                    $upd="UPDATE `distributor` SET `position` = 'Silver' WHERE `distributor`.`d_id` = '$s[d_id]';";
                    $con->query($upd);
                }
            }
        }
        if($s[position]=="Silver"){
            if($s[pair_matched]>10){
                if($s[position]!="Gold"){
                    $upd="UPDATE `distributor` SET `position` = 'Gold' WHERE `distributor`.`d_id` = '$s[d_id]';";
                    $con->query($upd);
                }
            }
        }
        
    }
}

//for_finalising_business_by_date();
//echo for_finding_under_id_number('81466', '81467');
//echo for_finding_under_pv_date("81465","11-11-2021");
//echo for_finding_own_business_date('1', '2');
//echo for_finding_under_total_activated_id('786');
//echo for_finding_under_total_activated_id_date("786",$date);
//echo final_own_business_nv_by_interval('714236', '2022-01-08', 'pm');
//echo find_to_business_to_final("2022-01-13","pm");
//echo for_finaling_business_commission('786', '2022-01-20', "pm", '1');
//echo for_finding_under_direct_id_number('81466', '81465');
//echo find_to_business_to_final('2021-01-26','am');
echo find_next_final_interval();
echo for_changing_position();
//echo for_finaling_business_commission('786', '2022-01-21', 'pm', '5');
//echo for_distributing_direct_id_commission('786', '2022-01-30', 'pm', '5');
?>




