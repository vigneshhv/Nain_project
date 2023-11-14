<?php
$login =false;
$error=false;

include("databse.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
  
    $sql= "select * from sign where username ='$username' AND  passwrd='$password'";
    $result=mysqli_query($conn,$sql);
    $num= mysqli_num_rows($result);
    
    if($num==1){
        $login=true;
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']="$username";
    }
    elseif($num==0){
        $error=true;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" href="logo.jpg">

    <link rel="stylesheet" href="admin.css">

</head>
<body>
    <div class="main">
        <div class="navbar">
            <div class = "icon">
                
                    <h1 class ="logo">ISafe</h2>
                <div class="menu">
                    <ul>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="about.php">ABOUT</a></li>
                    <li><a href="index.html">LOGIN</a></li>
                    <li><a href="contact.php">CONTACT</a></li>
                    <div class="search">
                    <input class="srch" type="search" name="" placeholder="Type To text">
                    <a href="#"><button class="btn">Search</button></a>
                </div>    
                </ul>
                </div>
                <div>
                <form  method ="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                 <div class="form">
                 <h2>  Admin Login </h2>
                 <input type="text" name="username" placeholder="Username">
                 <input type="password" name="password" placeholder="Password">
                 <button class ="btn1"><a href="">login</a></button>
                 </div>
                 </form>
                 

                </div>
                <?php
                if($error){
                echo '<div class="alert">
                    <span class="clsbtn">&times;</span>
                    <strong>Invaild Credentials  </strong>Check and try again.
                </div>';
               
                
                }
                if($login)
                {
                    echo ' <div class="alert success">
                    <span class="clsbtn">&times;</span>
                    <strong>You are logged in</strong>
                    </div>';
                    header("Location:welcome.php");}
                   
                ?>
                <script>
                
var close = document.getElementsByClassName("clsbtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0.2";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>
                </div>
            </div>
        </div>
    
</body>

</html>