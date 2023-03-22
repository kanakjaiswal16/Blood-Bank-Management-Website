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
$msg="<strong>Your message has been sent successfully to our team</strong>";



}
// else{
//     echo "no";
// }




?>














<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>

        *{
            margin: 0;
            padding: 0;
        }
        #contact {
            position: relative;
        }

        h1 {
            margin-top: -67%;
            margin-left: -9%;
            font-family: 'Bree Serif', serif;
            color: rgb(247, 82, 82);
            font-size: 2.8rem;
            padding: 12px;
            text-align: center;
        }

        #contact::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.7;
            /* background: url('855.jpg') no-repeat center center/cover; */

        }

        #contact-box {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-bottom: 34px;
            /* margin-top: -70%; */
            margin-left: -9%;
        }

        #contact-box input,
        #contact-box textarea {
            width: 100%;
            padding: 0.5rem;
            border-radius: 9px;
            font-size: 1.1rem;
        }

        #contact-box form {
            width: 40%;
        }

        #contact-box label {
            font-size: 1.3rem;
            font-family: 'Bree Serif', serif;

        }

        img {
            width: 100%;
        }

        .btn{
    background-color: #0b0fe6;
    color: white;
    margin: 5px 233px;
    padding: 6px;
    border: 2px solid white;
    border-radius: 64px;
    font-size: 16px;
    width: 166px;
    height: 45px;
    cursor: pointer;

}


.message{
    color: #00B74A;
    margin: auto 524px;
}

#navbar {
    display: flex;
    align-items: center;
    position: sticky;
    top: 0px;
    right: 0px;
    /* position: relative; */
}

#navbar::before {
    content: "";
    background-color: black;
    position: absolute;
    top: 0px;
    left: 0px;
    height: 100%;
    width: 100%;
    z-index: -1;
    opacity: 0.7;
}



#navbar ul {
    display: flex;
}

#navbar ul li {
    list-style: none;
    font-size: 1.3rem;
}

#navbar ul li a {
    color: white;
    display: block;
    padding: 3px 22px;
    border-radius: 20px;
    text-decoration: none;
}

#navbar ul li a:hover {
    color: black;
    background-color: white;
}

    </style>
</head>

<body>
<div id="navbar">
        <!-- <div id="logo">
            <img src="img/logo.png" alt="BloodDonation.com">
        </div> -->
        <ul>
            <li class="item"><a href="1.php">Home</a></li>
        </ul>
    </div>
    <img src="855.jpg" alt="">
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
                <input type="text" name="name" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number: </label>
                <input type="phone" name="phone" id="phone" placeholder="Enter your phone">
            </div>
            <div class="form-group">
                <label for="message">Message: </label>
                <textarea name="message" id="message" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" name="submit" id="submit" class="btn">Submit</button>

        </form>
    </div>
</body>

</html>