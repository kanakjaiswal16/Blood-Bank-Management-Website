<?php
$con=mysqli_connect("localhost","root","","blood");
$msg="";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendemail_reset($email,$verified_token){
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
    $mail->Subject = 'Recovery Link from E-Bloodbank';

    $email_template="
    <h2>Reset Link</h2>
    <h5>Verify your email to reset your password with the given below link</h5>
    <br/>
    <a href='http://localhost/practice/update_passwordbb.php?token=$verified_token'>Click to Reset Password </a>";
    $mail->Body    = $email_template;
    $mail->send();
}




if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $emailquery="SELECT * FROM bloodbanklogin where email='$email'";
    $emailquery_run=mysqli_query($con,$emailquery);

    if(mysqli_num_rows($emailquery_run)>0){
       $userdata=mysqli_fetch_array($emailquery_run);
       $verified_token=$userdata['verified_token'];
       sendemail_reset("$email","$verified_token");
       $msg="Password Reset link successfull send to <strong>$email</strong>.";
    }
    else{
        $_SESSION['status']="Email address does not exists.";
    }
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover Password</title>
    <link rel="stylesheet" href="forget_password.css">
</head>
<body>
    <div class="container">
        <div class="heading">
            <h2>Recover Your Account</h2>
        </div>
        
        <div class="sent">
            <?php
   echo $msg;
            ?>
        </div>
<?php  
 if(isset($_SESSION['status']))
 {
?>
<div class="reset">
    <h5><?=$_SESSION['status'];?></h5>
</div>
<?php
unset($_SESSION['status']);
 }
?>
        
        <form method="post">
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <button class="btn" name="submit" id="submit" >Recover</button> 
        </form>
    </div>
</body>
</html>