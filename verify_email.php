<?php

session_start();
$con=mysqli_connect("localhost","root","","blood");
if(isset($_GET['token'])){
       $token=$_GET['token'];
       $verify_query="SELECT verified_token,verify_status FROM donor_details WHERE verified_token='$token' LIMIT 1";
       $verify_query_run=mysqli_query($con,$verify_query);

       if(mysqli_num_rows($verify_query_run)>0){
             $row= mysqli_fetch_array($verify_query_run);
             if($row['verify_status']=="0"){
                 $update_query="UPDATE donor_details SET verify_status='1' WHERE verified_token='$token' LIMIT 1";
                 $update_query_run=mysqli_query($con,$update_query);

                 if($update_query_run){
                    $_SESSION['status']="Your account has been verified Successfully..";
                    header("Location:login.php");
                    exit(0);
                 }
                 else{
                    $_SESSION['status']="Verification Failed";
                    header("Location:signin.php");
                    exit(0);
                 }
             }
             else{
                $_SESSION['status']="Email is already <strong>Verified</strong>.Please Login";
                header("Location:login.php");
             }
       }
       else{
        $_SESSION['status']="This token does not exist";
        header("Location:signin.php");
       }
}
else{
    $_SESSION['status']="Verification Failed";
    header("Location:signin.php");
}

?>