<?php
error_reporting(0);
session_start();
include_once("connection.php");
$useremail = $_SESSION['user_email'];
$user = "SELECT * FROM users where user_email='$useremail'";
$run_user = mysqli_query($con, $user);
$row_u = mysqli_fetch_array($run_user);
$arr = explode(",", $row_u['user_friends']);
for ($i = 0; $i < count($arr); $i++) {
    $u_query = "SELECT * FROM users where user_id=$arr[$i]";
    $run_query =  mysqli_query($con, $u_query);
    if ($run_query) {
        $row_user = mysqli_fetch_array($run_query);
        $u_name = $row_user['user_name'];
        $u_email = $row_user['user_email'];
        $u_profile = $row_user['user_profile'];
        $login = $row_user['log_in'];
        $total=calc_message($u_name);
        if($total==0){
            $total='';
        }
        echo "<li onclick=reload('".$u_name."')>
            <div class='chat-left-img'>
            <img src='$u_profile'/>
            <div class='badge badge-danger badge-pill'>$total</div>
            </div>
            <div class='chat-left-detail'>
            <p> $u_name </p>
            ";
        if ($login == "Online") {
            echo "<span><i class='fa fa-circle' aria-hidden='true'></i> Online</span>";
        } else {
            echo "<span><i class='fa fa-circle-o' aria-hidden='true'></i> Offline</span>";
        }
        echo "</div></li>";
    }
}
function calc_message($sender_name)
{
    global $con,$row_u;
    $receiver_name = $row_u['user_name'];
    $q="SELECT * FROM users_chat WHERE (sender_username='$sender_name' AND receiver_username='$receiver_name') AND msg_status='unread'";
    $run_query=mysqli_query($con,$q);
    if($run_query)
    return mysqli_num_rows($run_query);
    
}
