<?php
$con=mysqli_connect("localhost","root","","blood");

$query="SELECT * FROM donor_details";
$data=mysqli_query($con,$query);
$result=mysqli_fetch_assoc($data);


echo $result['name']."                                                             ".$result['email'];


?>