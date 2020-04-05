<?php
include_once("./include/connection.php");
if (isset($_GET["user_name"]) and isset($_SESSION['user_email'])) {
global $con;
$user_email=$_SESSION["user_email"];
$get_sender_user="SELECT user_name from users where user_email='$user_email'";
$run_sender_user=mysqli_query($con,$get_sender_user);
$result_sender_user=mysqli_fetch_array($run_sender_user);
$user_name=$result_sender_user["user_name"];
$get_username = $_GET["user_name"];
$get_user = "SELECT * FROM users where user_name='$get_username'";
$run_user = mysqli_query($con, $get_user);
$row_user = mysqli_fetch_array($run_user);
$username = $row_user["user_name"];
$user_profile_image = $row_user["user_profile"];
}
$total_messages = "SELECT * FROM users_chat where (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
$run_message = mysqli_query($con, $total_messages);
$total = mysqli_num_rows($run_message);
echo $total;
?>
                