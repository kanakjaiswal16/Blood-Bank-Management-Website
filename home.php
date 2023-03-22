<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendemail_contact($email){
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
    $mail->Subject = 'Greetings from E-Bloodbank';

    $email_template="
    <h2>Your message has been sent to our team</h2>
    <h2>We will get back to you shortly</h2>
    <br/>
    ";
    $mail->Body    = $email_template;
    $mail->send();
}




$msg="";

$con=mysqli_connect("localhost","root","","blood");
if(isset($_POST['submit'])){
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$message=$_POST['message'];

$sql="INSERT INTO `contact_us` (`name`, `email`, `phone`, `message`, `date`) VALUES ('$name', '$email', '$phone', '$message', current_timestamp());";

$result=mysqli_query($con,$sql);

sendemail_contact("$email");
$msg="Your message has been sent successfully to our team";



}


?>














<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BLOODBANK</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <div id="navbar">
        <!-- <div id="logo">
            <img src="img/logo.png" alt="BloodDonation.com">
        </div> -->
        <ul>
            <li class="item"><a href="home.php">Home</a></li>
            <li class="item"><a href="login.php">Donor Login</a></li>
            <li class="item"><a href="bloodbanklogin.php">Blood Bank Login</a></li>
            <li class="item"><a href="#contact">Contact Us</a></li>
        </ul>
    </div>
    <section id="home">
        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">
                <div class="slide first">
                    <img src="slogan1.png">
                </div>
                <div class="slide">
                    <img src="slogan3new.png">
                </div>
                <div class="slide">
                    <img src="slogan5.png">
                </div>
                <div class="slide">
                    <img src="slogan4new.png">
                </div>
            </div>

      

            <div class="navigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        var counter = 1;
        setInterval(function () {
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if (counter > 4) {
                counter = 1;
            }
        }, 5000);
    </script>

        <h1 class="h-primary center">LEARN ABOUT DONATION</h1>
        <img src="donationFact.png" alt="">

        <table class="content-table">
            <thead>
                <tr>
                    <th>Blood Type</th>
                    <th>Donate Blood To</th>
                    <th>Receive Blood From</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A+</td>
                    <td>A+ AB+</td>
                    <td>A+ A- O+ O-</td>
                </tr>
                <tr>
                    <td>O+</td>
                    <td>O+ A+ B+ AB+</td>
                    <td>O+ O-</td>
                </tr>
                <tr>
                    <td>B+</td>
                    <td>B+ AB+</td>
                    <td>B+ B- O+ O-</td>
                </tr>
                <tr>
                    <td>AB+</td>
                    <td>AB+</td>
                    <td>Everyone</td>
                </tr>
                <tr>
                    <td>A-</td>
                    <td>A+ A- AB- AB+</td>
                    <td>A- O-</td>
                </tr>
                <tr>
                    <td>O-</td>
                    <td>Everyone</td>
                    <td>O-</td>
                </tr>
                <tr>
                    <td>B-</td>
                    <td>B+ B- AB+ AB-</td>
                    <td>B- O-</td>
                </tr>
                <tr>
                    <td>AB-</td>
                    <td>AB+ AB-</td>
                    <td>AB- A- B- O-</td>
                </tr>

            </tbody>
        </table>

    <section id="contact">
        <h1>Contact Us</h1>
        <div class="message">
                    <?php
                     echo $msg;
                    ?>
               </div>
        <div id="contact-box">
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number: </label>
                    <input type="phone" name="phone" id="phone" placeholder="Enter your phone" required>
                </div>
                <div class="form-group">
                    <label for="message">Message: </label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" name="submit" id="submit" class="btn">Submit</button>
           
            </form>
        </div>
    </section>

</body>

</html>