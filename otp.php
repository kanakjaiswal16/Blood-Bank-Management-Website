<?php
$con=mysqli_connect('localhost','root','','blood');
$email=$_POST['email']; 
$res=mysqli_query($con,"select * from donor_details where email='$email'";)
$count=mysqli_num_rows($res);
if($count>0){
echo "yes";
}
else{
echo "no";
}

?>


