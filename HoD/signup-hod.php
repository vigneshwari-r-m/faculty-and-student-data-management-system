<?php require_once "controller.php"; 

if (isset($_POST['department'])) {
    $department_id = $_POST['department'];
  
    // Retrieve the hod name from the database
    $sql = "SELECT h.hod_name
            FROM hodlist h
            WHERE h.department_id = $department_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $hod_name = $row['hod_name'];
  } else {
    $hod_name = '';
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup | HOD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/cc-style.css">
    <link rel="icon" href="../Assets/Images/favicon-32x32.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">

    <script src="js/validate.js"></script>
   <script>
    $(document).ready(function() {
    // When the department dropdown changes, update the hod name input
    $('#department').change(function() {
        var department_id = $(this).val();
        $.ajax({
            url: 'get-hod-name.php',
            type: 'POST',
            data: { department_id: department_id },
            success: function(response) {
                $('#faculty').val(response);
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
                <form action="signup-hod.php" method="POST" autocomplete="">
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
                    <?php
                    $department_query = "SELECT * FROM department ORDER BY department_name ASC";

                    $department_result = mysqli_query($con, $department_query);
                    
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input class="form-control" id="userid" type="text" name="userid" placeholder="Staff ID" required value="<?php echo $userid ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <input class="form-control" id="qualification" type="text" name="qualification" placeholder="Qulaification" required value="<?php echo $qualification ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <select class="form-control" id="department" name="department_id" required value="<?php echo $department ?>">
                            <option value="">Select Department</option>
                            <?php
                            $query = "SELECT * FROM department";
                            $result = mysqli_query($con, $query);

                            while($row = mysqli_fetch_array($result)) {
                                // Check if the current department is the selected department
                                $selected = ($row['department_id'] == $department) ? 'selected' : '';

                                echo '<option value="'.$row["department_id"].'" '.$selected.'>'.$row["department_name"].'</option>';
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <input class="form-control" id="faculty" placeholder="Name" name="name" required value="<?php echo $hod_name ?>" readonly>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <select class="form-control" id="designation" type="text" name="designation" required value="<?php echo $designation ?>">
                                <option selected="selected">Select Designation</option>
                                <option>Assistant Professor</option>
                                <option>Associate Professor</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <input class="form-control" id="email" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                            <span id="email-error" class="error" style="color: Red; font-size:12px;"></span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                            <div class="form-group col-md-6">
                        
                                <input class="form-control" id="datepicker" type="text" name="dob" placeholder="Date of Birth" required value="<?php echo $dob ?>">
                                <span id="datepicker-error" style="display:none; color:Red; font-size:12px;"></span>
                            
                            </div>

                        <div class="form-group col-md-6">
                            <input class="form-control" id="datepick" type="text" name="doj" placeholder="Date of Join" required value="<?php echo $doj ?>">
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input class="form-control" id="cpassword" type="password" name="cpassword" placeholder="Confirm password" required>
                    </div>
                    </div>
                    
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="hod-signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="hod-login.php">Login here</a></div>
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
                $('#datepicker-error').text('Oops! You Did not Joined Yet it seems').show();
            } else {
                $('#datepicker-error').hide();
            }
            }
        });
        });
        
    </script>
</body>
</html>