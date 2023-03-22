<?php

$msg="";
$msg1="";
$showalert=false;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendemail_verify($email,$verified_token){
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
    $mail->Subject = 'Email verification from E-Bloodbank';

    $email_template="
    <h2>You have registered with E-Bloodbank</h2>
    <h4>Verify your email to login with the given below link</h4>
    <br/>
    <a href='http://localhost/practice/verify_mailbb.php?token=$verified_token'>Click to Verify </a>
    ";
    $mail->Body    = $email_template;
    $mail->send();
}


if($_SERVER["REQUEST_METHOD"]=="POST"){ 

 $server="localhost";
 $username="root";
 $password="";
 $database="blood";

 $con=mysqli_connect($server,$username,$password,$database);

 if(!$con){
     die("connection to this database failed due to".mysqli_connect_error());
 }
// echo "Connecting to database";

$name=$_POST['name'];
$person=$_POST['person'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$city=$_POST['city'];
$pincode=$_POST['pincode'];
$address=$_POST['address'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$verified_token=md5(rand());

$check=mysqli_num_rows(mysqli_query($con,"select * from bloodbanklogin where email='$email'"));
if($check>0){
  $msg="Email already exists";
}
else{
if($password==$cpassword){

    $hash=password_hash($password,PASSWORD_DEFAULT);

$sql="INSERT INTO `bloodbanklogin` ( `name`,`contact_person`, `email`,`contact`,`city`,`pincode`,`address`,`password`,`verified_token`, `date`) VALUES ('$name','$person', '$email','$phone','$city','$pincode','$address','$hash','$verified_token', current_timestamp());";
// echo $verified_token;

sendemail_verify("$email","$verified_token");

$msg="We have just sent a verification link to <strong>$email</strong>.Please check your inbox and click on the link to get started.If you can't find this email (which could be due to spam filters), just request a new one here.";





$result=mysqli_query($con,$sql);
}
else
{
    $msg1="Password does not match";
}


       $exit_query="SELECT verified_status FROM bloodbanklogin WHERE email='$email' LIMIT 1";
       $exit_query_run=mysqli_query($con,$exit_query);

       if(mysqli_num_rows($exit_query_run)>0){
        $row= mysqli_fetch_array($exit_query_run);
        if($row['verified_status']=="1"){
            exit(0);
        }
    }

}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Sign Up</title>
    
    <link rel="stylesheet" href="bloodbanklogin.css">
</head>
<body>
    <div class="container">
    <div class="headline">
        <h1>Sign Up</h1>
        <div class="message">
        <?php
        echo $msg;
        ?>
        </div>
        <div class="message1">
        <?php
        echo $msg1;
        ?>
        </div>
        <?php
        session_start();
 if(isset($_SESSION['status']))
 {
?>
<div class="success">
    <h5><?=$_SESSION['status'];?></h5>
</div>
<?php
unset($_SESSION['status']);
 }
?>
    
    </div class=signup>
    <form  method="post">
        <div class="form-group first_box">
        <input type="text" name="name" id="name" placeholder="Enter Blood Bank Name" required>
    <input type="text" name="person" id="person" placeholder="Contact Person Name" required>
    <input type="email" name="email" id="email" placeholder="Enter Email" required>
    <input type="tel" name="phone" size="10" id="phone" placeholder="Enter Contact Number" required>
    <input type="tel" name="address" size="10" id="address" placeholder="Enter Address" required>
    <input type="text" name="city" size="10" id="city" placeholder="Enter City" required>
    <input type="pincode" name="pincode" size="10" id="pincode" placeholder="Enter Pincode" required>
    <input type="password" name="password" id="password" minlength="8" placeholder="Create password" required>
    <input type="password" name="cpassword" minlength="8" id="cpassword" placeholder="Confirm password" required>
    <button type="submit" name="submit" class="btn">Create</button>
    </div>

    </form>
    
    <p>Already Have An Account?</p>
    <a href="bblogin.php">Sign In</a>
   
    
    <div class="bottom">
        <h1>DONATE BLOOD</h1>
        <img src="donation.png" alt="Donate Blood">
    </div>

    </div>
</div>


<!-- <script src="index.js"></script> -->
</body>
</html>