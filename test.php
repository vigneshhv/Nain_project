<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="test.css">

</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="rfid">
        <input type="submit" value="insert">

    </form>
    <?php

    include("databse.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rfid = $_POST["rfid"];

        $sql = "select rfid_no,time_out from attendance where date=current_date() and rfid_no='$rfid'";
        $result = mysqli_query($conn, $sql);
        $row1 = mysqli_fetch_assoc($result);
        $sql_check = "select rfid_no from register where rfid_no='$rfid'";
        $result_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) == 0 && mysqli_num_rows($result_check) > 0) {
            $sql1 = "insert into attendance(rfid_no,date,time_in) values ('$rfid',current_date(),current_time())";
            $result1 = mysqli_query($conn, $sql1);
            $sql3 = "select register.name,register.class,attendance.time_in ,attendance.date from attendance inner join register on attendance.rfid_no=register.rfid_no where attendance.date= current_date() and attendance.rfid_no='$rfid'";
            $result3 = mysqli_query($conn, $sql3);
            $row = mysqli_fetch_assoc($result3);
            require_once __DIR__ . '/vendor/autoload.php';

            $number = '+918951269743';
            // Set your Twilio account information
            $accountSid = 'AC395b054e1279169508e8e843855401c3';
            $authToken = 'c76348c69b1303caec6b07c820cfc434';
            $twilioNumber = '+15673812378';

            // Set the recipient's phone number and the message body
            $recipientNumber = $number;
            $message = "Good morning this message is to inform that your child  " . $row['name'] . "  has enterd into school at " . $row['time_in'] . " on " . $row['date'] . " thank you";

            // Create a new Twilio client
            $client = new Twilio\Rest\Client($accountSid, $authToken);

            // Send the SMS message
            $client->messages->create(
                $recipientNumber,
                array(
                    'from' => $twilioNumber,
                    'body' => $message
                )
            );

            echo 'entry SMS  sent!';



        } else if (mysqli_num_rows($result) == 1 && mysqli_num_rows($result_check) > 0 && $row1['time_out'] == NULL) {
            $sql2 = "update attendance set time_out=current_time() where rfid_no='$rfid' and date = current_date()";
            $result2 = mysqli_query($conn, $sql2);
            $sql4 = "select register.name,register.class,attendance.time_out ,attendance.date from attendance inner join register on attendance.rfid_no=register.rfid_no where attendance.date= current_date() and attendance.rfid_no='$rfid'";
            $result4 = mysqli_query($conn, $sql4);
            $row = mysqli_fetch_assoc($result4);
            require_once __DIR__ . '/vendor/autoload.php';

            $number = '+918951269743';
            // Set your Twilio account information
            $accountSid = 'AC395b054e1279169508e8e843855401c3';
            $authToken = 'c76348c69b1303caec6b07c820cfc434';
            $twilioNumber = '+15673812378';

            // Set the recipient's phone number and the message body
            $recipientNumber = $number;
            $message = "Good aftrenoon this message is to inform that your child  " . $row['name'] . "  has left the school at " . $row['time_out'] . " on " . $row['date'] . " thank you";

            // Create a new Twilio client
            $client = new Twilio\Rest\Client($accountSid, $authToken);

            // Send the SMS message
            $client->messages->create(
                $recipientNumber,
                array(
                    'from' => $twilioNumber,
                    'body' => $message
                )
            );

            echo 'exit SMS  sent!';

        } else {
            echo "ERROR multiple entry in a day or invalid rfid tag";
        }
    }



    ?>
</body>

</html>