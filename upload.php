<?php
include("include/connection.php");
session_start();
if (!isset($_SESSION['user_email'])) {
    header("location:signin.php");
    exit();
} else {
    ?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
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
        <?php
            include("include/header.php");
            $user = $_SESSION["user_email"];
            $user_profile_q = "SELECT user_profile from users where user_email='$user'";
            $run_user_profile = mysqli_query($con, $user_profile_q);
            $res_user_profile = mysqli_fetch_array($run_user_profile);
            ?>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2>Change Your Profile</h2>
                    </div>
                    <div class="card-body">
                        <img src="<?php echo $res_user_profile['user_profile']; ?>" class="img-fluid" />
                    </div>
                    <div class="card-footer">
                        <form action="" method="post" class="form-group" enctype="multipart/form-data">
                            <input type="file" name="u_profile"  required /><br><br>
                            <input type="submit" class="btn btn-success" value="Upload" name="upload" />
                        </form>
                    </div>
                </div>
                <?php
                if(isset($_POST['upload'])){
                    $name=$_FILES['u_profile']['name'];
                    $name_arr=explode(".",$name);
                    $pro_name=time().".".$name_arr[1];
                    $dest_path="./img/".$pro_name;
                    if(move_uploaded_file($_FILES['u_profile']['tmp_name'],$dest_path)){
                        $update_profile="UPDATE users set user_profile='$dest_path' where user_email='$user'";
                        $run_update_profile=mysqli_query($con,$update_profile);
                        if($run_update_profile){
                            echo "<div class='alert alert-success'>Profile successfullly updated..<span class='close' data-dismiss='alert'>&times;</span></div>";
                            header("location:upload.php");
                        }
                    }
                }
                
                
                ?>
            </div>
        </div>
    </body>
    </html>
<?php } ?>