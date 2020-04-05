<html lang="en">
<?php
session_start();
include("include/connection.php");
if (!isset($_SESSION['user_email'])) {
    header("Location:signin.php");
} else {
    ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>MyChat-Home</title>
        <!-- Latest compiled and minified CSS -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- jQuery library -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
        <script src="js/jquery.min.js"></script>

        <!-- Popper JS -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->

        <!-- Latest compiled JavaScript -->
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/status.css">
    </head>
    <body>
        <div class="container main-section">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
                    <div class="input-group-btn" style="margin-top:20px;">
                        <center><a href="include/find_friends.php"><button class="btn btn-default search-icon" name="search_user" type="submit">Add New User</button></a></center>
                    </div>
                    <?php
                        $user = $_SESSION['user_email'];
                        $get_user = "SELECT * FROM users WHERE user_email='$user'";
                        $run_user = mysqli_query($con, $get_user);
                        $row = mysqli_fetch_array($run_user);
                        $user_id = $row["user_id"];
                        $user_name = $row["user_name"];
                        $user_theme = $row["user_theme"];
                        $theme = "./theme/" . $user_theme;
                        ?><div class="user_title">Hello <?php echo $user_name; ?></div>

                    <div class="left-chat">
                        <ul id="frnd">
                            <?php include("include/get_users_data.php"); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12 right-slidebar">
                    <div class="row">
                        <?php
                            if (isset($_GET["user_name"])) {
                                global $con;
                                $get_username = $_GET["user_name"];
                                $get_user = "SELECT * FROM users where user_name='$get_username'";
                                $run_user = mysqli_query($con, $get_user);
                                $row_user = mysqli_fetch_array($run_user);
                                $username = $row_user["user_name"];
                                $user_profile_image = $row_user["user_profile"];
                            }
                            ?>
                        <div class="col-md-12 right-header">
                            <div class="right-header-img">
                                <!-- <img src="<?php //echo "$user_profile_image"; 
                                                    ?>"> -->

                            </div>
                            <div class="right-header-detail">
                                <p>STORY</p>
                                <!-- <p><?php //echo "$username"; 
                                            ?></p> -->
                                <!-- <span id="total"></span> -->
                                <form method="post" class="text-right">
                                    <a href="logout.php" name="logout" class="btn btn-outline-danger">Logout</a>
                                </form>
                                <!--  start new modify -->
                                <!-- <div class="dropdown text-right">
                                    <button class="btn dropdown-toggle" data-toggle="dropdown" id="show">
                                        <i class="fa fa-ellipsis-v fa-2x"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="show">
                                        <li class="dropdown-item"><a href="#">Home</a></li>
                                        <li class="dropdown-item"><a href="#">Settings</a></li>
                                        <li class="dropdown-item"><a href="#">Clear Chat</a></li>
                                    </ul>
                                </div> -->
                                <!-- end -->

                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat" style="background:url(<?php echo $theme; ?>);background-size:cover;">
                            <ul id="chat"></ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 right-chat-textbox">
                            <form method="post" class="form-group input-group" enctype="multipart/form-data">
                                <input autocomplete="off" type="text" name="msg_content" placeholder="Write your Story.......">
                                <div class="input-group-append">
                            <span  onclick="document.getElementById('status_img').click();" class="input-group-text" style="width:30px;text-align:center;"><i class="fa fa-file-upload"></i></span>
                            <input type="file" name="status_img" accept="jpeg" style="display:none;" id="status_img"/>
                            </div>
                                <button class="btn btn-outline-success" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    if (isset($_POST['submit'])) {
                        $msg = htmlentities($_POST["msg_content"]);
                        $img_name=htmlentities($_FILES['status_img']['name']);
                        if($img_name!=''){
                            $file=explode(".",$img_name);
                            $filename="status_img/".time().".".$file[1];
                            $sucUpload=move_uploaded_file($_FILES['status_img']['tmp_name'],$filename);
                            if(!$sucUpload){
                                echo "<script>alert('Error image is not uploaded' )</script>";
                            }
                        }
                        if ($msg == "" and $img_name=="") {
                            echo "<div class='alert alert-danger'>
                    <strong><center>Message is Too long.use only 100 charcters</center></strong></div>";
                        } else {
                            if($sucUpload or $msg != "" ){
                            $insert = "INSERT INTO users_status (sender_id,status_content,status_date,status_img) values($user_id,'$msg',NOW(),'$filename')";
                            $run_insert = mysqli_query($con, $insert);
                            }
                        }
                    }

                    ?>
    </body>
<?php } ?>
<script>
    $('#scrolling_to_bottom').animate({
        scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight
    }, 1000);
</script>
<script>
    total = document.getElementById("total");
    chat = document.getElementById("chat");
    frnd = document.getElementById("frnd");
    $(document).ready(function() {
        var height = $(window).height();
        $('.left-chat').css('height', (height - 112) + 'px');
        $('.right-header-contentChat').css('height', (height - 183) + 'px');
    });

    function reload(name){
       
       document.location='./home.php?user_name='+name;
   }
    function find_chat() {
        get_friend_data();
        http = new XMLHttpRequest();
        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                chat.innerHTML = http.responseText;
            }
        }
        http.open("POST", "./include/status_load.php", false);
        http.send();
    }

    function get_friend_data() {
        http = new XMLHttpRequest();
        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                frnd.innerHTML = http.responseText;
            }
        }
        http.open("POST", "./include/get_users_data.php", false);
        http.send();
    }
    x = setInterval(find_chat(), 1000);
</script>

</html>