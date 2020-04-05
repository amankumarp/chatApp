<?php
$user_email = $_SESSION['user_email'];
include_once('connection.php');
function search_user()
{
    global $con, $user_email;
    if (isset($_GET['search_btn'])) {
        $search_query = htmlentities($_GET['search_query']);
        $get_user = "SELECT * FROM users WHERE user_name like '%$search_query%' or user_country like '%$search_query'";
    } else {
        $get_user = "SELECT * FROM users order by user_country,user_name DESC LIMIT 5";
    }
    $run_user = mysqli_query($con, $get_user);
    while ($row_user = mysqli_fetch_array($run_user)) {
        $user_id = $row_user['user_id'];
        $user_name = $row_user['user_name'];
        $user_profile = $row_user['user_profile'];
        $country = $row_user['user_country'];
        $gender = $row_user['user_gender'];
        if($user_email!=$row_user['user_email']){
        echo "
        <div class='card'>
        <img src='../$user_profile'>
        <h1>$user_name</h1>
        <p class='title'>$country</p>
        <p>$gender</p>
        <form method='post'>
        <input type='hidden' name='u_id' value=$user_id />
        <input type='hidden' name='u_name' value=$user_name />
        <p><button name='add'>Chat With $user_name</button></p>
        </form>
        </div><br><br>
        ";
        }
    if (isset($_POST['add'])) {
        $u_id=$_POST['u_id'];
        $u_name=$_POST['u_name'];
        $sel_query1 = "SELECT user_id,user_friends from users where user_email='$user_email'";
        $sel_query2="SELECT user_friends from users where user_id='$u_id'";
        $run_q1 = mysqli_query($con, $sel_query1);
        $run_q2 = mysqli_query($con, $sel_query2);
        $row1 = mysqli_fetch_array($run_q1);
        $row2 = mysqli_fetch_array($run_q2);
        if($row1['user_friends']!='')
        $user_fr1 = $row1['user_friends'] . "," . $u_id;
        else
        $user_fr1=$u_id;
        if($row2['user_friends']!='')
        $user_fr2= $row2['user_friends'] . "," . $row1['user_id'];
        else
        $user_fr2 =$row1['user_id'];
        $update_q1 = "UPDATE users set user_friends='$user_fr1' where user_email='$user_email'";
        $update_q2= "UPDATE users set user_friends='$user_fr2' where user_id=$u_id";

        if (mysqli_query($con, $update_q1)and mysqli_query($con,$update_q2)) {
            echo "<script>alert('Seccussfully Added your friend List');</script>";
        } else {
            echo "<script>alert('Error occuring.... ');</script>";
        }
        echo "<script>window.open('../home.php?user_name=$u_name','_self')</script>";
    break;
    }
}
}
