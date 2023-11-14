<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:admin.php");
  exit();

}
?>
<?php
$register = false;
$eroor = false;
include("databse.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $dob = $_POST["date"];
  $gender = $_POST["gender"];
  $father = $_POST["father"];
  $mother = $_POST["mother"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];
  $admission = $_POST["admission"];
  $rfid = $_POST["rfid"];
  $class = $_POST["class"];


  $sql = "select admission_no from register where admission_no='$admission'";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($result);

  if ($rows > 1) {
    $eroor = true;
    header("regerstation.php");
  } else {
    $sql = "insert into register(name, dob,father_name,mother_name,phone,email,admission_no,rfid_no,class,gender) 
            values(' $name','$dob','$father','$mother','$phone','$email','$admission','$rfid','$class','$gender')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $register = true;
    }
  }

}
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="regerster.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Isafe</title>
  <link rel="icon" type="image/x-icon" href="logo.jpg">
  <?php include("wrknav.html"); ?>
</head>

<body>

  <div class="container1">

    <div class="container">
      <div class="title">Registration</div>
      <?php
      if ($register) {
        echo ' <div class="alert success">
        <span class="clsbtn">&times;</span>
        <strong>Student Registerd Sucessfully</strong>
        </div>';
        $sql_msg="select name ,admission_no ,class from register where admission_no='$admission'";
        $result_msg = mysqli_query($conn,$sql_msg);
        $row_msg=mysqli_fetch_assoc($result_msg);
        require_once __DIR__ . '/vendor/autoload.php';
       
        $number = '+918951269743';
        // Set your Twilio account information
        $accountSid = 'AC395b054e1279169508e8e843855401c3';
        $authToken = 'c76348c69b1303caec6b07c820cfc434';
        $twilioNumber = '+15673812378';

        // Set the recipient's phone number and the message body
        $recipientNumber = $number;
        $message = "Congratulations your child ".$row_msg['name']."with admission number ".$row_msg['admission_no']." got registed to isafe for class ".$row_msg['class']."  thank you";

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
        echo 'SMS message sent!';

        
      }
      if (($eroor == true)) {
        echo ' <div class="alert">
        <span class="clsbtn">&times;</span>
        <strong>Student already Registerd </strong>
        </div>';
      }
      ?>
      <div class="content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="user-details">

            <div class="input-box">
              <span class="details">Full Name</span>
              <input type="text" name="name" placeholder="Enter  name" required>
            </div>
            <div class="input-box">
              <span class="details">Date Of Birth</span>
              <input type="date" name="date" required>
            </div>
            <div class="input-box">
              <span class="details">Gender</span>
              <select id="gender" name="gender" placeholder="select">
                <option value="none" selected disabled hidden>Select an Option</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>

            <div class="input-box">
              <span class="details">Father name</span>
              <input type="text" name="father" placeholder="Enter  Father name" required>
            </div>
            <div class="input-box">
              <span class="details">Mother name</span>
              <input type="text" name="mother" placeholder="Enter Mother name" required>
            </div>
            <div class="input-box">
              <span class="details">Phone number</span>
              <input type="text" name="phone" placeholder="Enter Phone number" required>
            </div>
            <div class="input-box">
              <span class="details">Email</span>
              <input type="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="input-box">
              <span class="details">Addmission Number</span>
              <input type="text" name="admission" placeholder="Provide Addmission number" required>
            </div>
            <div class="input-box">
              <span class="details">RFID Number </span>
              <input type="text" name="rfid" placeholder="Provide RFID number" required>
            </div>
            <div class="input-box">
              <span class="details">Present class</span>
              <input type="text" name="class" placeholder="Present class" required>
            </div>
          </div>


          <div class="button">
            <input type="submit" value="Submit">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>

    var close = document.getElementsByClassName("clsbtn");
    var i;

    for (i = 0; i < close.length; i++) {
      close[i].onclick = function () {
        var div = this.parentElement;
        div.style.opacity = "0.2";
        setTimeout(function () { div.style.display = "none"; }, 600);
      }
    }
  </script>
</body>

</html>