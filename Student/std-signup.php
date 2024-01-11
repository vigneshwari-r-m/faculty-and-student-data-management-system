<?php require_once "controller.php"; 
$qualification = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup | Student </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/cc-style.css">
    <link rel="icon" href="../Assets/Images/favicon-32x32.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">

    <script src="js/validate.js"></script>
   
    <!-- <script>
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
    </script> -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-md-3 form">
            <form action="std-signup.php" method="POST" autocomplete="">
                    <h2 class="text-center">Signup</h2>
                    <p class="text-center">It's quick and easy.</p>
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
                    
                    <div class="form-row">
                        <div class="form-group col-md-6 text-left">
                            <input class="form-control" id="student_id" type="text" name="student_id" placeholder="Register Number" required value="<?php echo $student_id ?>">
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <input class="form-control" id="student_name" type="text" name="student_name" onBlur="if (!(/^[a-zA-Z ]*$/.test(this.value))) { document.getElementById('nameError').innerHTML = 'Oops! Doesnt look like a Name'; } else { document.getElementById('nameError').innerHTML = ''; }" placeholder="Name" required value="<?php echo $student_name ?>">
                            <span id="nameError" class="error" style="color: Red; font-size:12px;"></span>
                        </div>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 text-left">
                            <select class="form-control" id="degree" name="degree" required value="<?php echo $degree ?>">
                            <option value="" hidden>Select Degree Type</option>
                            <option value="ug">Under Graduate</option>
                            <option value="pg">Post Graduate</option>
                            <option value="phd">Ph. D</option>
                            
                            </select>
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <select class="form-control" id="course" name="course" required value="<?php echo $course ?>">
                                <option value="">Select Course</option>
                            </select>
                        </div>
                        
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6 text-left">
                        <input class="form-control" id="email" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                        <span id="email-error" class="error" style="color: Red; font-size:12px;"></span>
                    </div>
                        <div class="form-group col-md-6 text-left">
                        <input class="form-control" id="mobileNumber" type="text" name="contact" placeholder="Mobile Number" onBlur="if (!(/^\d{10}$/.test(this.value))) { document.getElementById('mobileNumberError').innerHTML = 'Oops! Invalid mobile number'; } else { document.getElementById('mobileNumberError').innerHTML = ''; }" required value="<?php echo $contact ?>">
                        <span id="mobileNumberError" class="error" style="color: Red; font-size:12px;"></span>
                    </div>
                    
                    
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6 text-left">
                            
                            <input class="form-control" id="batch" type="text" name="batch" placeholder="Batch Ex: 2020-2024" required value="<?php echo $batch ?>">
                            <span id="datepicker-error" style="display:none; color:Red; font-size:12px;"></span>
                        
                        </div>
                        <div class="form-group col-md-6 text-left">
                        <input class="form-control" id="datepick" type="text" name="dob" placeholder="Date of Birth" required value="<?php echo $dob ?>">
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
                        <input class="form-control button" type="submit" name="std-signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="std-login.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
    <script>
        //Course Selection

        var degreeDropdown = document.getElementById("degree");
        var courseDropdown = document.getElementById("course");

        degreeDropdown.addEventListener("change", function() {
        courseDropdown.innerHTML = "";
        var degree = this.value;
        if (degree === "ug") {
            var options = [
            "Select UG Course",
            "B.E. Automobile Engineering", 
            "B.E. Mechanical Engineering",
            "B.E. Civil Engineering",
            "B.E. Electronics and Communication Engineering",
            "B.E. Electrical and Electronics Engineering",
            "B.E. Computer Science & Engineering",
            "B.E. Artificial Intelligence and Machine Learning",
            "B.E. Cyber Security",
            "B.Tech Information Technology",
            "B.Tech Artificial Intelligence & Data Science"
            ];
        } else if (degree === "pg") {
            var options = [
            "Select PG Course",
            "CAD/CAM",
            "Computer Science and Engineering",
            "Communication Systems",
            "Structural Engineering",
            "Embedded System Technologies",
            "Master of Computer Applications"
            ];
        } else if(degree === "phd"){
            var options = [
            "Select Ph.D Course",
            "Mechanical Engineering",
            "Automobile Engineering",
            "Electronics & Communication Engineering",
            "Electrical & Electronics Engineering",
            "Computer Science Engineering",
            "Civil Engineering",
            "Physics",
            "Information Technology"
            ];
        }

        for (var i = 0; i < options.length; i++) {
            var option = document.createElement("option");
            option.value = options[i];
            option.text = options[i];
            courseDropdown.appendChild(option);
        }
        });


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