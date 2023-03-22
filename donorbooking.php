<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
}
?>



<?php

error_reporting(0);
$con=mysqli_connect("localhost","root","","blood");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendemail_confirmation($email,$bankname,$address,$date,$slot){
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();  
    $mail->SMTPAuth   = true;    

    $mail->Host       = 'smtp.gmail.com';                                                       
    $mail->Username   = 'ebloodbankdemo@gmail.com';                    
    $mail->Password   = 'lgnscghhpgefjhvn';   

    $mail->SMTPSecure = "tls";            
    $mail->Port       = 587;

    $mail->setFrom("ebloodbankdemo@gmail.com",'E-Bloodbank');
    $mail->addAddress($email);    

    $mail->isHTML(true);                                  
    $mail->Subject = 'Confirmation from E-Bloodbank';

    $email_template="
    <h3> Your Booking is Confirmed</h3>
    <h3>Name of Blood Bank:<strong>$bankname</strong></h3>
    <h3>Address:<strong>$address</strong></h3>
    <h3>Date:<strong>$date</strong></h3>
    <h3>Time:<strong>$slot</strong></h3>
    ";
    $mail->Body    = $email_template;
    $mail->send();
}














if(isset($_POST['submit'])){
$email=$_SESSION['email'];
$bankname=$_POST['myBank'];
$date=$_POST['myDate'];
$slot=$_POST['mySlot'];
$bg=$_POST['bg'];
$query="select name from donor_details where email='$email'";
$result1=mysqli_query($con,$query);
$fetch=mysqli_fetch_array($result1);
$name=$fetch['name'];



$sql="insert into `donorbooking` (`nameofdonor`,`email`,`nameofbloodbank`, `date`, `slot`, `bloodgroup`) VALUES ('$name','$email','$bankname', '$date', '$slot', '$bg');";


$result=mysqli_query($con,$sql);

$sql2="select * from bloodbanklogin where name='$bankname'";
$result2=mysqli_query($con,$sql2);
$row=mysqli_fetch_array($result2);
$address=$row['address'];
// echo $address;

sendemail_confirmation("$email","$bankname","$address","$date","$slot");
$msg="Your Booking has been confirmed<br/>For more detail check your mailbox.";

}



?>



























<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <style>

        *{
            margin: 0;
            padding: 0;
        }
        #container {
            border: 2px solid black;
            width: 35%;
            margin-left: 33%;
            margin-top: 10%;
            background-color:aliceblue;
            z-index: 500;
            padding: 46px;
            position: absolute;
            top: 35px;
            left: -390px;
            border-radius:15px;
            height:322px;
        }
        
        .form h2 {
            font: 30px;
            text-align:center;
            padding: 0 0 35px 0px;
            color:red;
            /* background-color: aqua; */
        }

        img{
            width:100%;
            height: 100%;
        }

        .btn2{
            position: absolute;
            left: 293px;
            background: blue;
            color: white;
            padding: 3px;
            border-radius: 9px;
            cursor: pointer;
        }
        .btn{
            position: absolute;
            left: 184px;
            background: blue;
            color: white;
            padding: 3px;
            border-radius: 9px;
            cursor: pointer;
        }
        .form .message{
            color:#00B74A;
            padding: 15px;
            text-align:center
        }
        .form .back{
            display: block;
            text-align: ;
            margin: 31px 0px;
            padding: 0 165px;
        }
        </style>
</head>

<body>
    <img src="booking.jpg" alt="">
    <div id="container">
        <div class="form">
            <h2>Blood Donation Form</h2>

            <div class="message">
                <?php
              echo $msg;
                ?>
            </div>
            <form method="post">

                <div>
                    <label for="Blood-Bank">Choose Blood Bank:</label>
                    <?php
                      $query=mysqli_query($con,"select * from bloodbanklogin");
                    ?>
                    <select name="myBank" id="Blood-Bank">

                    <?php
                       while($row=mysqli_fetch_array($query)){

                    ?>
                        <option value=<?php echo $row['name']   ?>><?php echo $row['name']   ?></option>
                        
                        <?php
                       }
                       ?>
                    </select>
                </div>
                <br>
                <div>
                    Date: <input type="date" name="myDate">
                </div>
                <br>
                <div>
                    <label for="Time-Slot">Choose your slot:</label>
                    <select name="mySlot" id="Time-Slot">
                        <option value="8 a.m. - 11 a.m.">8 a.m. - 11 a.m.</option>
                        <option value="12 p.m. - 3 p.m.">12 p.m. - 3 p.m.</option>
                        <option value="4 p.m. - 7 p.m.">4 p.m. - 7 p.m.</option>
                    </select>
                </div>
                <br>
                <div>
                    Have you donated Blood earlier?: <input type="checkbox" name="myEligibility">
                </div>
                <br>
                <div>
                <label for="Blood-Bank">Blood Group:</label>
                    <select name="bg" id="bg">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <br>
                <div>
                   <input type="submit" class="btn" name="submit" id="submit" value="Submit Now">
                   <input type="reset" class="btn2" value="Reset Now">
                   
                </div>
                <div class="back">
                    <a href="1.php">Back to home page</a>
                </div>
            </form>
            
        </div>

    </div>
</body>

</html>