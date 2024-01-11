<?php require_once "controller.php"; ?>
<?php 
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header('Location: home.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Faculty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/cc-style.css">
    <link rel="icon" href="../Assets/Images/favicon-32x32.png">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Login with your Email and Password.</p>
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
                        <div class="position-relative">
                            <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                            <i class="far fa-eye toggle-password" id="toggleIcon" onclick="togglePasswordField()"></i>
                        </div>
                    </div>

                    <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center">Not yet a member? <a href="signup-user.php">Sign Up now</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
<script>
function togglePasswordField() {
    var passwordInput = document.getElementById("password");
    var toggleIcon = document.getElementById("toggleIcon");
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

</script>
<script src="https://kit.fontawesome.com/85d9b987b8.js" crossorigin="anonymous"></script>
</html>