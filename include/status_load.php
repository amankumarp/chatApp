<?php
include('connection.php');
$q="SELECT * FROM users_status order by status_date DESC";
$r=mysqli_query($con,$q);
if($r){
    $row=mysqli_fetch_array($r);
    $timestamp=$row['status_date'];
    $arr=explode(" ",$timestamp);
    if($arr[0]=="20".date('y-m-d')){
        echo "<li class='dateTop'>Today</li>"; 
    }else{
     echo "<li class='dateTop'>$arr[0]</li>"; 
    }
    
    while($row){
        $timestamp=$row['status_date'];
        $date=explode(" ",$timestamp);
        $time=explode(":",$date[1]);
        $user_id=$row['sender_id'];
        $user="SELECT * FROM users Where user_id=$user_id";
        $run_user=mysqli_query($con,$user);
        $row_user=mysqli_fetch_array($run_user);
        $user_profile=$row_user['user_profile'];
        if($arr[0]!=$date[0]){
            echo "<li class='dateTop'>$date[0]</li>";
            $arr[0]=$date[0];
            if($date[0]=="20".date('y-m-d')){
                echo "<li class='dateTop'>Today</li>"; 
            }
        }
        if((int)$time[0]>12)
        {
            $time[0]=(int)$time[0]-12;
            $t=$time[0].":".$time[1].":".$time[2]."PM";
        }
        else{
            $t=$time[0].":".$time[1].":".$time[2]."AM";
        }
        echo "<li class='card'>
        <div class='card-header'>
        <div class='status-profile-img'><img src='$user_profile' class='rounded-circle img-fluid' height='50' width='50'/></div>
        <p>$row_user[user_name]</p>
        <span>$t</span>
        </div><div class='card-body'>
    ";
    if($row['status_img']){
        $status_img=$row['status_img'];
        echo "<div class='card-img'>
        <img class='img-fluid' src='$status_img' height='300'></div>";
    }
    echo "<div class='card-text'>$row[status_content]</div>";
   
$row=mysqli_fetch_array($r);
}
}

?>
