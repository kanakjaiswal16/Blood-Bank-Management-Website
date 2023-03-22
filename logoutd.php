<?php
session_start();
unset($_SESSION['email']);
?>
<?php
session_destroy();
header("Location:login.php")



?>