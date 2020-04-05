<?php
session_start();
include("include/connection.php");
?>
<html lang="en">

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php include("./include/header.php");?>
    <div class="container">
    <div class="row">
        <?php
        for ($i=1;$i<=8;$i++){
            echo " <div class='col-md-3'><div class='card'>
            <div class='card-body'>
                <img src='./theme/theme$i.jpg' class='img-fluid'/>
            </div>
            <div class='card-footer'>
                <form action='' method='post'>
                <button class='btn btn-success' name='theme' value='theme$i.jpg' type='submit'>Set theme</button>
                </form>
            </div>
        </div></div> ";

        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-4">
        <div class="card">
            <div class="card-header text-center">
                <h2> Upload Your Theme</h2>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="user_theme" required><br><br>
                <button class="btn btn-success" type="submit" name="upload">Set</button>
    </form>
    </div>
        </div>
    </div> 
    </div>
</div>
<?php
if(isset($_POST['theme'])){
   $theme=$_POST['theme'];
   $user=$_SESSION['user_email'];
   $update_theme="UPDATE users set user_theme='$theme' where user_email='$user'";
   $run_theme=mysqli_query($con,$update_theme);
   if($run_theme){
       echo "<script>alert('theme is Successfully Changed');</script>";
   }
   else{
       echo "<script> alert('Error : theme is not changed')</script>";
   }
}
else if(isset($_POST['upload'])){
   $file= $_FILES['user_theme']['name'];
    $arr=explode(".",$file);
    $filename=time().".".$arr[1];
    if(move_uploaded_file($_FILES['user_theme']['tmp_name'],"./theme/".$filename)){
        $user_theme_q="UPDATE users set user_theme='$filename' where user_email='$user'";
        $run_theme=mysqli_query($con,$user_theme_q);
        if($run_theme){
            echo "<script>alert('successfully uploaded your theme')</script>";
        }
        else{
            echo "<script>alert('Error :Not uploaded your theme')</script>";
        }
    }
}
?>
</body>
</html>