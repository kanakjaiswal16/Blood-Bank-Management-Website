<?php
session_start();
unset($_SESSION['emailbb']);
?>
<?php
session_destroy();
header("Location:bblogin.php")



?>