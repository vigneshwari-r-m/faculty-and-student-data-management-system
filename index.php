<?php

if(isset($_POST['user-login'])){
    header('location: Faculty/login-user.php');
}
if(isset($_POST['hod-login'])){
    header('location: HoD/hod-login.php');
}
if(isset($_POST['std-login'])){
    header('location: Student/std-login.php');
}
if(isset($_POST['admin-login'])){
    header('location: IQAC-Admin/login-admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/cc-style.css">
    <link rel="icon" href="Assets/Images/favicon-32x32.png">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="index.php" method="POST" autocomplete="">
                    <h2 class="text-center">Want To Login</h2>
                    <p class="text-center">Choose Your Role</p>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="user-login" value="FACULTY">
                    </div>
                    <hr>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="hod-login" value="HOD">
                    </div>
                    <hr>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="std-login" value="STUDENT">
                    </div>
                    <hr>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="admin-login" value="ADMIN">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>