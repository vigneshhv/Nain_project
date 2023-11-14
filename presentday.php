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
            <div class="title">Todays attendance</div>
            <div class="content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="date">Select date</label>
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
                            <th>Class</th>
                            <th>Time in</th>
                            <th>Time out</th>
                        </tr>
                        <?php
                                    include("databse.php");
                                    $date=null;
                                    $count=1;
                                    if($_SERVER["REQUEST_METHOD"]=='POST'){
                                        $date= $_POST['date'];

                                                    $sql="select  attendance.rfid_no, register.name,register.class,attendance.time_in,attendance.time_out
                                                    from attendance inner join register on attendance.rfid_no=register.rfid_no where date='$date' ;";
                                                    $result=mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                        while($row=mysqli_fetch_assoc($result))
                                                        {echo"
                                                            <tr>
                                                            <td>".$count."</td>
                                                            <td>".$row['rfid_no']."</td>
                                                            <td>".$row['name']."</td>
                                                            <td>".$row['class']."</td>
                                                            <td>".$row['time_in']."</td>
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
