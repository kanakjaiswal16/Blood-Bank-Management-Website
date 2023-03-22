<?php
session_start();
 if(isset($_SESSION['status']))
 {
?>
<div class="success">
    <h5><?=$_SESSION['status'];?></h5>
</div>
<?php
unset($_SESSION['status']);
 }
?>