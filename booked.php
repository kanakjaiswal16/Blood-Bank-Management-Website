<?php
session_start();

$email=$_SESSION['email'];
$con=mysqli_connect("localhost","root","","blood");

$query="select * from donorbooking where email='$email'";
$result=mysqli_query($con,$query);

$num=mysqli_num_rows($result);
// echo $num;

while($fetch=mysqli_fetch_array($result)){
    echo $fetch['nameofbloodbank']."<br>";
}








?>