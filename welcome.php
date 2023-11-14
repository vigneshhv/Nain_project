<?php
session_start();

if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!= true ){
   header("location:admin.php"); 
   exit();
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
    <link rel="icon" type="image/x-icon" href="logo.jpg">
    <?php include('wrknav.html'); ?>
    <link rel="stylesheet" href="welcome.css">

</head>
<body>
    <h2>ISafe ERP</h2>
    <h2><?php 
    $name= $_SESSION['username'];
    echo "Welcome ".($name);
    ?></h2>
    
</body>
</html>