<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>if else</title>
    
</head>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    .container{
    background-color: rgb(190, 135, 135);
    margin: auto;
    padding:34px 
    }
</style>
<body>
    <div class="container">
        <h1>WELCOME</h1>
        <p>STATUS OF YOUR DONATION: </p>

    <?php
  $status='Y';
  if($status=='Y')
  echo "DONATED";
  else
  echo "PENDING";

  echo "<br>";

  $a=array('kanak','sugam','yash');
//   echo $a[1];
//   echo "<br>";
//   echo count($a);


// loops

$b=0;
while($b<count($a)){
    echo "<br> THE NAMES ARE: ";
    echo $a[$b];
    $b++;
    
}

function printn($number){
    echo "VALUE OF NUMBER IS:";
    echo $number;
}
echo "<br>";
printn(8);



    ?>

    </div>
    
    
</body>
</html>