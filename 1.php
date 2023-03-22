<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Section</title>
    <link rel="stylesheet" href="1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div id="navbar">

        <ul>
            <li class="item"><a href="home.php">Home</a></li>
            <li class="item"><a href="donorbooking.php">Donate Blood</a></li>
            <!-- <li class="item"><a href="#bloodbank-section">Blood Bank Login</a></li> -->
            <li class="item"><a href="contactus.php">Contact Us</a></li>
        </ul>
        <div id="logo">
            <img src="logodonor.jpeg" alt="BloodDonation.com">
        </div>
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                <?php
                // session_start();
                $con=mysqli_connect("localhost","root","","blood");
                $mail=$_SESSION['email'];
                $sql="select name from donor_details where email='$mail'";
                $sql_result=mysqli_query($con,$sql);
                $fetch=mysqli_fetch_array($sql_result);
                echo $fetch['name'];

                ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="changed.php">Change Password</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logoutd.php">Logout</a>
                </div>
              </li>

    </div>

    <section id="home">
        

        <table class="content-table">
            <thead>
                <tr>
                    <th>Blood Bank Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
             
            <?php


$email=$_SESSION['email'];
$con=mysqli_connect("localhost","root","","blood");

$query="select * from donorbooking where email='$email'";
$result=mysqli_query($con,$query);

$num=mysqli_num_rows($result);
// echo $num;

while($fetch=mysqli_fetch_array($result)){
    // echo $fetch['nameofbloodbank']."<br>";
    $name=$fetch['nameofbloodbank'];
    $query2="select * from bloodbanklogin where name='$name'";
    $result2=mysqli_query($con,$query2);
    $fetch2=mysqli_fetch_array($result2);
  

?> 
                <tr>
                    <td><?php echo $fetch['nameofbloodbank'] ?></td>
                    <td><?php echo $fetch2['address'] ?></td>
                    <td><?php  echo $fetch2['city'] ?></td>
                    <td><?php echo $fetch['date'] ?></td>
                    <td><?php echo $fetch['slot'] ?></td>
                    <div class="status">
                    <td><?php echo $fetch['status'] ?></td>
                    </div>
                </tr>
     <?php
  }
  ?>  
            </tbody>

    </section>

    
</body>

</html>

