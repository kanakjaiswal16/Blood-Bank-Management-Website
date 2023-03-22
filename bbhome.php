<?php
session_start();

if(!isset($_SESSION['emailbb'])){
    header("Location:bblogin.php");
}
?>

<?php
$con=mysqli_connect("localhost","root","","blood");


if(isset($_POST['donate'])){
    $email=$_SESSION['emailbb'];
    // $mail=$_SESSION['email'];
$sql="select name from bloodbanklogin where email='$email'";
$sql_result=mysqli_query($con,$sql);
$fetch_sql=mysqli_fetch_array($sql_result);
$name=$fetch_sql['name'];
    $donor="update donorbooking set status='Donated' where nameofbloodbank='$name'";
    $donor_result=mysqli_query($con,$donor);

$group="select bloodgroup from donorbooking where nameofbloodbank='$name'";
$group_result=mysqli_query($con,$group);
$fetch_group=mysqli_fetch_array($group_result);
$bg=$fetch_group['bloodgroup'];
// echo $bg;

$packet="update packets set packets=packets+1 where bloodgroup='$bg'";
$packet_result=mysqli_query($con,$packet);
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="bbhome.css">
</head>
<body>

<div id="navbar">

<ul>
    <li class="item"><a href="bloodbankfront.php">Home</a></li>
</ul>

</div>
    <!-- <h1 class="h-primary center">NOTIFICATIONS</h1> -->

        <table class="content-table">
            <thead>
                <tr>
                    <th>Donor Name</th>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

            <?php
           

$con=mysqli_connect("localhost","root","","blood");
$email=$_SESSION['emailbb'];
$sql="select name from bloodbanklogin where email='$email'";
$sql_result=mysqli_query($con,$sql);
$fetch_sql=mysqli_fetch_array($sql_result);
$name=$fetch_sql['name'];

$query="select * from donorbooking where nameofbloodbank='$name'";
$result=mysqli_query($con,$query);

$num=mysqli_num_rows($result);
// echo $num;

while($fetch=mysqli_fetch_array($result)){
    // echo $fetch['nameofbloodbank']."<br>";
    $dname=$fetch['nameofdonor'];
    $demail=$fetch['email'];
    $dbg=$fetch['bloodgroup'];
    $slot=$fetch['slot'];
    $date=$fetch['date'];
    
?> 
                <tr>
                    <td><?php echo $fetch['nameofdonor'] ?></td>
                    <td><?php echo $fetch['date'] ?></td>
                    <td><?php echo $fetch['slot'] ?></td>
                    <td>
                    <form action="" method="post">
                    <div>
                    <button class="btn" value="click" name="donate" id="donate">Donated</button>
                </div>
</form>
                    </td>
                </tr>
                
                <?php
  }
  ?>  
            </tbody>
        </table>
</body>
</html>

