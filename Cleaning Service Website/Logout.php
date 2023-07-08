<?php 
session_start();
session_unset();
echo "<script>location.assign('LoginCustomer.php'); </script>";
 ?>