<?php require_once "controller.php"; ?>
<?php 
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header('Location: hod-dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | HOD </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/cc-style.css">
    <link rel="icon" href="../Assets/Images/favicon-32x32.png">
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form" >
                <form action="hod-login.php" method="POST" autocomplete="">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Login with your email and password.</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="forgotpassword.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="h-login" value="Login">
                    </div>
                    <div class="link login-link text-center">Not yet a member? <a href="signup-hod.php">Signup now</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>