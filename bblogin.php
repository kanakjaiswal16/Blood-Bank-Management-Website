<?php
session_start();
$con=mysqli_connect("localhost","root","","blood");
if(isset($_POST['submit'])){
    
    $email=$_POST['email'];
    $password=$_POST['password'];
    $_SESSION['emailbb']=$email;

    $login_query="SELECT * from bloodbanklogin where email='$email' limit 1";
    $login_query_run=mysqli_query($con,$login_query);



    if(mysqli_num_rows($login_query_run)>0){
        $row=mysqli_fetch_assoc($login_query_run);
        $verify=password_verify($password,$row['password']);
        if($verify==1){
        
       
        header("Location:bloodbankfront.php");
        exit(0);
        }
        else{
            $_SESSION['status']="Invalid password";
            header("Location:bblogin.php");
            exit(0);
        }
    }
    else{
        $_SESSION['status']="Invalid Email";
        header("Location:bblogin.php");
        exit(0);
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <form action="" class="form" method="post">
            <h2>SIGN IN</h2>
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

<?php
    
    if(isset($_SESSION['status']))
    {
   ?>
   <div class="updated">
       <h5><?=$_SESSION['status'];?></h5>
   </div>
   <?php
   unset($_SESSION['status']);
    }
   ?>
            <input type="email" name="email" class="box" placeholder="Enter Email Address" required>
            <input type="password" name="password" class="box" placeholder="Enter password" required>
            <input type="submit" id="submit" name="submit"></input>
            <a href="forget_passwordbb.php">Forgot password</a>
            <a href="bloodbanklogin.php">REGISTER</a>
        </form>
        <div class="side">
            <img src="images.png" alt="error">
        </div>
    </div>
</body>
</html>