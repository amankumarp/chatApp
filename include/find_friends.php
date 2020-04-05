<html lang="en">
<?php
session_start();
include("find_friends_function.php");
if (!isset($_SESSION['user_email'])) {
    header("Location:signin.php");
}
else {

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyChat-Home</title>
    <!-- Latest compiled and minified CSS -->
       <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Popper JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->

    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
    <script src="../js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/find_friends.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">
            <?php
            $user=$_SESSION['user_email'];
            $get_user="SELECT * FROM users WHERE user_email='$user'";
            $run_user=mysqli_query($con,$get_user);
            $row=mysqli_fetch_array($run_user);
            $user_name=$row["user_name"];
            echo "<a href='../home.php?user_name=$user_name'>MyChat</a>";
            ?>
        </a>
        <ul class="navbar-nav">
            <li><a style="color:white;text-decoration:none;font-size:20px;" href="../account_settings.php">Setting</a></li>
    </nav><br>
<div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-4">
<form class="search_form" action="">
    <input type="text" name="search_query" placeholder="Search Friends" autocomplete="off" required>
    <button class="btn" type="submit" name="search_btn">Search</button>
</form>
</div>
<div class="col-sm-4">
</div>
</div><br><br>
<?php search_user();?>
</body>

</html>
<?php } ?>