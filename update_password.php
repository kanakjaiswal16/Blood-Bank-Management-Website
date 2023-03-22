<?php
session_start();
$con=mysqli_connect("localhost","root","","blood");

if(isset($_POST['submit'])){

  if(isset($_GET['token'])){
    echo "found";
    $rtoken=$_GET['token'];
  
  
    $newpassword=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    if($newpassword==$cpassword){
 $hash=password_hash($newpassword,PASSWORD_DEFAULT);

 $update="UPDATE donor_details set password='$hash' where verified_token='$rtoken'";
  $check=mysqli_query($con,$update);

  if($check){
    header("Location:login.php");
  $_SERVER['status']="Password updated successfully";
  exit(0);
  }
  else{
    header("Location:login.php");
    $_SERVER['status']="Password updation failed";
    exit(0);
  }


    }
    else{
        $_SERVER['status']="Password does not match";


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
    <title>Create new password</title>
    <link rel="stylesheet" href="update_password.css">
</head>
<body>
    <div class="container">
        <div class="heading">
            <h2>Reset Password</h2>
        </div>

        <?php
    
    if(isset($_SESSION['status']))
    {
   ?>
   <div class="log">
       <h5><?=$_SESSION['status'];?></h5>
   </div>
   <?php
   unset($_SESSION['status']);
    }
   ?>
      
      <form action="" method="post">
          <input type="password" name="password" id="password" placeholder="Enter new password" required>
          <input type="password" name="cpassword" id="cpassword" placeholder="Confirm password" required>
          <button class="btn" name="submit" id="submit">Reset</button>
      </form>
    </div>
</body>
</html>