<?php 
include "database_connect.php";


       $reg="INSERT INTO `contact` (`s_id`, `name`, `email`, `mobile`, `subject`, `description`, `date`, `time`) VALUES (NULL, '$_POST[name]', '$_POST[email]', '$_POST[mobile]', '$_POST[subject]', '$_POST[description]', '$date', '$time');";
            
           
        if($con->query($reg)===TRUE )
        {
            echo "<script>alert('Your contact information has been submitted successfully.');location.href='index.php';</script>";
        }
        else{
            echo "<script>alert('Query Failed! Plz try again');location.href='index.php';</script>";
        }
   
    
?>