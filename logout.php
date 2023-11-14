<?php
session_start();
if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!= true ){
    header("location:admin.php"); 
    exit();
    }

else{
    session_unset();
    session_destroy();
    header("location:admin.php");
    exit();
}

?>