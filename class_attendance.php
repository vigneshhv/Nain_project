<?php
session_start();

if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!= true ){
   header("location:admin.php"); 
   exit();
   
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="presentday.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ISafe</title>
     <link rel="icon" type="image/x-icon" href="logo.jpg">
     <?php include("wrknav.html");?>
   </head>
<body>
    <div class="container1">
        <div class="container">
            <div class="title">Class attendance</div>
            <div class="content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="class">Class</label>
        <select id="gender" name="class" placeholder="select">
                <option value="none" selected disabled hidden>Select an Option</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
         </select>
         <label for="date">Date</label>
                    <input type="date" name="date">
                    <input type="submit">
                <div class="user-details">
            </form>
                
                </div>
                
                
                <div style="overflow-x:auto;">
                    <table>
                        <tr>
                            <th>SL No.</th>
                            <th>Rfid number</th>
                            <th>Name</th>
                            <th>Time in</th>
                            <th>Time out</th>
                        </tr>
                        <?php
                                    include("databse.php");
                                    if($_SERVER["REQUEST_METHOD"]=='POST'){
                                        $date= $_POST['date'];
                                        $class=$_POST['class'];
                                        $count=1;

                                                    $sql="select attendance.sl_no, attendance.rfid_no, register.name,register.class,attendance.time,attendance.time_out
                                                    from attendance inner join register on attendance.rfid_no=register.rfid_no where date='$date' and class='$class' ;";
                                                    $result=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                        while($row=mysqli_fetch_assoc($result))
                                                        {echo"
                                                            <tr>
                                                            <td>".$count."</td>
                                                            <td>".$row['rfid_no']."</td>
                                                            <td>".$row['name']."</td>
                                                            <td>".$row['time']."</td>
                                                            <td>".$row['time_out']."</td>
                                                        
                                                        </tr>";
                                                        $count++;
                                                        }

                                                    }
                                }
    
    
    ?>
                        </table>
               
                  
                
                    
                </div>
                
            </div>
        </div>
    </div>


</body>
</html>
