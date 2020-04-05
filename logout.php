<?php
session_start();
include("include/connection.php");
$user_email=$_SESSION['user_email'];
mysqli_query($con, "UPDATE users SET log_in='Offline' WHERE user_email='$user_email'");
session_destroy();
header("Location:signin.php");

?>