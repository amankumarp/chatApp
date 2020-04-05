<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login to your account</title>
    <link rel="stylesheet" href="css/signin.css">
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
</head>
<body>
    <div class="signin-form">
        <form action=""  method="post">
<div class="form-header">
    <h2>Sign In</h2>
    <p>Login to MyChat</p>
</div>
<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" placeholder="someone@site.com" class="form-control" autocomplete="off" required>
</div>
<label for="pass">Password</label>
<div class="form-group input-group input-group-sm">
    
    <input type="password" name="pass" placeholder="Password" class="form-control" id="pass" autocomplete="off" required>
    <div class="input-group-append" onclick="togglePass()">
        <span class="input-group-text" id="icon">
            <i class="fa fa-eye"></i>
                </span>
    </div> 
</div>
<div class="small">Forget Password?<a href="forget_pass.php">Click Here</a></div><br>
<div class="form-group">
<button class="btn btn-primary btn-block btn-lg" name="sign_in" type="submit">Sign in</button>
</div>
<?php include("signin_user.php");?>
        </form>
        <div class="text-center small" style="color:#674288;">Don't have an Account?<a href="signup.php">Create one</a></div>
    </div>
    
</body>
<script>
    pass=document.getElementById("pass");
    icon=document.getElementById("icon");
    function togglePass(){
        if(pass.type=="password"){
            pass.type="text";
            icon.innerHTML="<i class='fa fa-eye-slash'></i>";
        }
        else{
            pass.type="password";
            icon.innerHTML="<i class='fa fa-eye'></i>";
        }
    }
    </script>
</html>