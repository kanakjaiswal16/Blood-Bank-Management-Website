<?php
$msg="";
session_start();
$con=mysqli_connect("localhost","root","","blood");

if(isset($_POST['submit'])){

 
  
  
    $newpassword=$_POST['password'];
    $npassword=$_POST['cpassword'];
    $email=$_SESSION['emailbb'];
$sql="select * from bloodbanklogin where email='$email'";
$sql_result=mysqli_query($con,$sql);
$fetch=mysqli_fetch_array($sql_result);
$verify=password_verify($newpassword,$fetch['password']);

    if($verify==1){
 $hash=password_hash($npassword,PASSWORD_DEFAULT);

 $update="UPDATE bloodbanklogin set password='$hash' where email='$email' ";
  $check=mysqli_query($con,$update);

  if($check){
    header("Location:bblogin.php");
  $_SERVER['status']="Password updated successfully";
  exit(0);
  }
  else{
    header("Location:bblogin.php");
    $_SERVER['status']="Password updation failed";
    exit(0);
  }


    }
    else{
       $msg="Your current password does not match";
    }
}
  


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new password</title>
    <link rel="stylesheet" href="update_password.css">
</head>
<body>
    <div class="container">
        <div class="heading">
            <h2>Change Password</h2>
        </div>

        <div class="message">
            <?php
         echo $msg;
?>
        </div>
      
      <form action="" method="post">
          <input type="password" name="password" id="password" placeholder="Enter current password" required>
          <input type="password" name="cpassword" id="cpassword" placeholder="Enter new password" required>
          <button class="btn" name="submit" id="submit">Change</button>
      </form>
    </div>
</body>
</html>