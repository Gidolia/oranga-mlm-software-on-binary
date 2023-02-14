<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "../../database_connect.php";
session_start();
                //echo $_SESSION[d_id];
		     // echo $_SESSION[d_password];
    $que="SELECT * FROM `distributor` WHERE `d_id`='$_SESSION[d_id]' AND `password`='$_SESSION[d_password]'";
    $res=$con->query($que);
		  if ($res->num_rows != 1)
		  {
			   echo "<script>location.href='../../login.php';</script>";
		  }
		  else
			  include("functions.php");
			  $d_detail=mysqli_fetch_assoc($res);
			  if($_SESSION[t]!=1){
			 if($d_detail['a_status']=="n")
			 {
    			$date1=date_create($d_detail['r_date']);
                $date2=date_create($date);
                $diff=date_diff($date1,$date2);
                $as=$diff->format("%R%a");
                if($as>15)
                {
                    echo "<script>alert('Blocked ! Exceeded 15 days');location.href='../../login.php';</script>";
                }
			 }}
			  
?>