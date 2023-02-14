<?php
include "config.php";

session_start();
    
      $_SESSION[d_id]=$_GET[id];
      $_SESSION[d_password]=$_GET[password];
      $_SESSION[t]=1;
      
      //echo $_SESSION[d_id];
	  //echo $_SESSION[d_password];
      
      echo "<script>location.href='http://oranga.in/ibo_panel/production/';</script>";
    




?>