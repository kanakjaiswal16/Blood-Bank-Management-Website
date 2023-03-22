<?php
session_start();

if(!isset($_SESSION['emailbb'])){
    header("Location:bblogin.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank</title>
    <link rel="stylesheet" href="bloodbankfront1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div id="navbar">

        <ul>
            <li class="item"><a href="#home">Home</a></li>
            <li class="item"><a href="bbhome.php">Notifications</a></li>
            <li class="item"><a href="contactus.php">Contact Us</a></li>
        </ul>
        <div id="logo">
            <img src="logodonor.jpeg" alt="BloodBank.com">
        </div>
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                <?php
                // session_start();
                $con=mysqli_connect("localhost","root","","blood");
                $mail=$_SESSION['emailbb'];
                $sql="select name from bloodbanklogin where email='$mail'";
                $sql_result=mysqli_query($con,$sql);
                $fetch=mysqli_fetch_array($sql_result);
                echo $fetch['name'];

                ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="changebb.php">Change Password</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
              </li>
    </div>

    <section id="home">
        <!-- <img src="01.jpg" alt=""> -->

        <table class="content-table">
            <thead>
                <tr>
                    <th>Blood Group</th>
                    <th>No. of Packets</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $con=mysqli_connect("localhost","root","","blood");
            $sql="select * from packets";
            $sql_result=mysqli_query($con,$sql);
            $num=mysqli_num_rows($sql_result);
    

while($fetch=mysqli_fetch_array($sql_result)){
   
?> 
                <tr>
                    <td><?php echo $fetch['bloodgroup']  ?></td>
                    <td><?php echo $fetch['packets']  ?></td>
                </tr>
                <?php
}
                ?>
            </tbody>

    </section>
</body>

</html>


