<?php require_once "controller.php"; 
$qualification = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup | Faculty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/cc-style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
    <link rel="icon" href="../Assets/Images/favicon-16x16.png">
    <script src="js/validate.js"></script>
   
    <script>
        $(document).ready(function(){
            $('#department').change(function(){
                var department_id = $(this).val();
                $.ajax({
                    url:"get_faculty.php",
                    method:"POST",
                    data:{department_id:department_id},
                    success:function(data){
                        $('#faculty').html(data);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-md-3 form">
            <form action="signup-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Sign Up</h2>
                    <p class="text-center">It's Quick and Easy.</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $department_query = "SELECT * FROM department ORDER BY department_name ASC";

                    $department_result = mysqli_query($con, $department_query);
                    
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-6 text-left">
                            <input class="form-control" id="userid" type="text" name="userid" placeholder="Staff ID" required value="<?php echo $userid ?>">
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <input class="form-control" id="qualification" type="text" name="qualification" placeholder="Qualification" required value="<?php echo $qualification ?>">
                    </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 text-left">
                            <select class="form-control" id="department" name="department_id" required value="<?php echo $department ?>">
                            <option value="" hidden>Select Department</option>
                            <?php
                                $query = "SELECT * FROM department";
                                $result = mysqli_query($con, $query);

                                while($row = mysqli_fetch_array($result))
                                {
                                    echo '<option value="'.$row["department_id"].'">'.$row["department_name"].'</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <select class="form-control" id="faculty" name="name" required value="<?php echo $name ?>">
                                <option value="">Select Faculty</option>
                            </select>
                        </div>
                        
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 text-left">
                                <select class="form-control" id="designation" type="text" name="designation" required value="<?php echo $designation ?>">
                                    <option selected="selected" hidden>Select Designation</option>
                                    <option>Assistant Professor</option>
                                    <option>Assistant Professor(SG)</option>
                                    <option>Assistant Professor(SS)</option>
                                    <option>Associate Professor</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 text-left">
                            <input class="form-control" id="email" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                            <span id="email-error" class="error" style="color: Red; font-size:12px;"></span>
                        </div>
                    
                    
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6 text-left">
                            
                            <input class="form-control" id="datepicker" type="text" name="dob" placeholder="Date of Birth" required value="<?php echo $dob ?>">
                            <span id="datepicker-error" style="display:none; color:Red; font-size:12px;"></span>
                        
                        </div>
                        <div class="form-group col-md-6 text-left">
                        <input class="form-control" id="datepick" type="text" name="doj" placeholder="Date of Join" required value="<?php echo $doj ?>">
                        <span id="datepick-error" style="display:none; color:Red; font-size:12px;"></span>
                    </div>
                    
                        </div>

                  <div class="form-row">
                  <div class="form-group col-md-6 text-left">
                        <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                        <div id="password-error" style="color: red; font-size:12px;"></div>
                    </div>
                  <div class="form-group col-md-6 text-left">

                        <input class="form-control" id="cpassword" type="password" name="cpassword" placeholder="Confirm password" required>
                    </div>
                        </div>

                    <div class="form-row">
                        <input class="form-control button" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="login-user.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
    <script>
        //Email Validation
        function validateEmailDomain(email) {
            var validDomains = ["mcet.in", "drmcet.ac.in"];
            var domain = email.split('@')[1];
            return validDomains.includes(domain);
        }

        var emailInput = document.getElementById("email");
        var emailError = document.getElementById("email-error");

        emailInput.addEventListener("blur", function() {
            var email = emailInput.value;
            if (!validateEmailDomain(email)) {
            emailError.innerHTML = "Oops! Invalid email domain.";
            emailInput.focus();
            } else {
            emailError.innerHTML = "";
            }
        });

        //Date of Birth Validation
        $(document).ready(function() {
        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            onSelect: function(selectedDate) {
            var currentDate = new Date();
            var selectedDate = new Date(selectedDate);
            var ageDiff = currentDate.getFullYear() - selectedDate.getFullYear();
            var monthDiff = currentDate.getMonth() - selectedDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < selectedDate.getDate())) {
                ageDiff--;
            }
            if (ageDiff < 21) {
                $('#datepicker-error').text('Oops! You are younger than 21').show();
            } else {
                $('#datepicker-error').hide();
            }
            }
        });
        });

        //Date of Join Validation
        $(document).ready(function() {
        $('#datepick').datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            maxDate: 0,
            onSelect: function(selectedDate) {
            var currentDate = new Date();
            var selectedDate = new Date(selectedDate);
            if (selectedDate > currentDate) {
                $('#datepick-error').text('Oops! You Did not Joined Yet it seems').show();
            } else {
                $('#datepick-error').hide();
            }
            }
        });
        });
        
        //validate password
        const passwordField = document.getElementById("password");
        const errorDiv = document.getElementById("password-error");

        passwordField.addEventListener("blur", () => {
        const password = passwordField.value;
        const error = validatePassword(password);
        if (error) {
            errorDiv.textContent = error;
        } else {
            errorDiv.textContent = "";
        }
        });
        function validatePassword(password) {
        const minLength = 8;
        const maxLength = 20;
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
        let error = null;

        if (password.length < minLength || password.length > maxLength) {
            error = `Password must be between ${minLength} and ${maxLength} characters long.`;
        } else if (!regex.test(password)) {
            error = "Password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character (@$!%*?&).";
        }

        return error;
        }
    </script>
</body>
</html>