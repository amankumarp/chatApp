<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create New Account</title>
    <link rel="stylesheet" href="css/signup.css">
           <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Popper JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->

    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div class="signup-form">
        <form action=""  method="post">
<div class="form-header">
    <h2>Sign Up</h2>
    <p>Fill out this form and start chating with your friends.</p>
</div>
<div class="form-group">
    <label>Username</label>
    <input type="text" name="user_name" placeholder="Example: Aman" class="form-control" autocomplete="off" required>
</div>
<label for="pass">Password</label>
<div class="form-group input-group input-group-sm">
    <input type="password" name="user_pass" placeholder="Password" class="form-control" id="pass" autocomplete="off" required>
    <div class="input-group-append" onclick="togglePass()">
        <span class="input-group-text" id="icon">
            <i class="fa fa-eye"></i>
                </span>
    </div> 
</div>

<div class="form-group">
    <label>Email Address</label>
    <input type="email" name="user_email" placeholder="someone@site.com" class="form-control" autocomplete="off" required>
</div>
<div class="form-group">
    <label>Country</label>
    <select name="user_country" class="form-control" required>
        <option value=''>Select a Country</option>
        <option>Nepal</option>
        <option>United States of America</option>
        <option>India</option>
        <option>UK</option>
        <option>Bangladesh</option>
        <option>France</option>
        <option>China</option>
    </select>
</div>
<div class="form-group">
    <label>Gender</label>
    <select name="user_gender" class="form-control" required>
        <option value=''>Select your gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Others">Others</option>
    </select>
</div>
<div class="form-group">
    <label class="checkbox-inline"><input type="checkbox" required>  I accept the <a href="#">Terms of Use</a>&amp;<a href="#">Privacy Policy</a></label>
</div>
<div class="form-group">
<button class="btn btn-primary btn-block btn-lg" name="sign_up" type="submit">Sign Up</button>
</div>
 <?php include("signup_user.php");?>
        </form>
        <div class="text-center small" style="color:#674288;">Already have an Account?<a href="signin.php">Signin Here</a></div>
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