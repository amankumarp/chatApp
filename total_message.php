<?php
session_start();
include_once("./include/connection.php");
if (isset($_GET["user_name"]) and isset($_SESSION['user_email'])) {
    $user_email = $_SESSION["user_email"];
    $get_sender_user = "SELECT user_name from users where user_email='$user_email'"; 
    $run_sender_user = mysqli_query($con, $get_sender_user);
    $result_sender_user = mysqli_fetch_array($run_sender_user);
    $user_name = $result_sender_user["user_name"];
    $get_username = $_GET["user_name"];
    $get_user = "SELECT * FROM users where user_name='$get_username'";
    $run_user = mysqli_query($con, $get_user);
    $row_user = mysqli_fetch_array($run_user);
    $username = $row_user["user_name"];
    $user_profile_image = $row_user["user_profile"];
    if ($_GET['find'] == 'total_messages') {
        $total_messages = "SELECT * FROM users_chat where (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
        $run_message = mysqli_query($con, $total_messages);
        $total = mysqli_num_rows($run_message);
        echo $total;
    } 
    else if ($_GET['find'] == 'chat') {
        $update_msg = mysqli_query($con, "UPDATE users_chat SET msg_status ='read' WHERE sender_username='$username' AND receiver_username='$user_name'");
        $sel_msg = "SELECT * FROM users_chat WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username') ORDER by 1 ASC";
        $run_msg = mysqli_query($con, $sel_msg);
        $row = mysqli_fetch_array($run_msg);
        $timestamp=$row['msg_date'];
        $arr=explode(" ",$timestamp);
        if($arr[0]=="20".date('y-m-d')){
            echo "<div class='dateTop'>Today</div>"; 
        }else{
         echo "<div class='dateTop'>$arr[0]</div>";   
        }
        while ($row) {
            $timestamp=$row['msg_date'];
            $date=explode(" ",$timestamp);
            $time=explode(":",$date[1]);
            $sender_username = $row['sender_username'];
            $receiver_username = $row['receiver_username'];
            $msg_date = $row['msg_date'];
            $msg_content = $row['msg_content'];
            $msg_img=$row['msg_img'];
            if($arr[0]!=$date[0]){
                if($date[0]=="20".date('y-m-d')){
                    echo "<div class='dateTop'>Today</div>"; 
                }
                else{
                echo "<div class='dateTop'>$date[0]</div>";
                
                }$arr[0]=$date[0];
            
            }
            if((int)$time[0]>12)
            {
                $time[0]=(int)$time[0]-12;
                $t=$time[0].":".$time[1].":".$time[2]."PM";
            }
            else{
                $t=$time[0].":".$time[1].":".$time[2]."AM";
            }
            if ($user_name == $sender_username and $username == $receiver_username) {
                echo "
    <li>
    <div class='rightside-right-chat'>
    <span> <b>$user_name</b> Says<small> $t </small></span><br>";
    if($msg_img!=''){
        echo "<img src='$msg_img' height='200' width='200' class='img-fluid'/>";
    }
    if($msg_content!='')
    echo "<p> $msg_content </p>
    </div>
    </li>
    ";
            }
            if ($user_name == $receiver_username and $username == $sender_username) {
                echo "
    <li>
    <div class='rightside-left-chat'>
    <span><b> $username</b> Says <small> $t</small></span><br>";
    if($msg_img!=''){
        echo "<img src='$msg_img' height='200' width='200' class='img-fluid'/>";
    }
    if($msg_content!='')
    echo "<p> $msg_content </p>
    </div>
    </li>
    ";
            }
            $row = mysqli_fetch_array($run_msg);
        }
    }
}
