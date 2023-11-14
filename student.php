<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:admin.php");
    exit();

}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="student.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISafe</title>
    <link rel="icon" type="image/x-icon" href="logo.jpg">
    <?php include("wrknav.html"); ?>
</head>

<body>
    <div class="container1">
        <div class="container">
            <div class="title">Class attendance</div>
            <div class="content">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="admission">Admission Number</label>
                    <input type="text" name="admission" placeholder="Enter Admission Number" required>
                    <input type="submit" value="search">
                    <div class="user-details">
                </form>

            </div>


            <div style="overflow-x:auto;">
                <table>
                    <tr>
                        <th>SL No.</th>
                        <th>Date</th>
                     <th>Time in</th>
                        <th>Time out</th>
                    </tr>
                    <?php
                    include("databse.php");
                    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                        $admin = $_POST['admission'];
                        $count=1;

                        $sql = "select date, time_in,time_out from attendance inner join register on attendance.rfid_no=register.rfid_no where register.admission_no='$admin';";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "
                                                            <tr>
                                                            <td>" . $count . "</td>
                                                           <td>" . $row['date'] . "</td>
                                                            <td>" . $row['time_in'] . "</td>
                                                            <td>" . $row['time_out'] . "</td>
                                                        
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