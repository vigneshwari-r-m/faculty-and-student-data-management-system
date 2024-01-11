<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>

<?php
require_once "controller.php";
$title = "";
$start_date = "";
$end_date = "";
$days = "";
$program_type = "";
$venue = "";
$year="";
$financial_support = "";
$proof = "";
$hod_approval = "Pending Approval";
$hod_remarks = "NIL";
$admin_approval = "Pending Approval";
$admin_remarks = "NIL";
$errors = array();

// set maximum file size to 2 MB
$max_file_size = 2 * 1024 * 1024;

if (isset($_POST['fdp-submit'])) {


    // escape form data and retrieve user ID and name
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $days = mysqli_real_escape_string($con, $_POST['days']);
    $program_type = mysqli_real_escape_string($con, $_POST['program_type']);
    $venue = mysqli_real_escape_string($con, $_POST['venue']);
    $financial_support = mysqli_real_escape_string($con, $_POST['financial_support']);
    
    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];

    // create directory path
    $directory_path = "../uploads/$department/$name/$program_type/";

    // create directories if they don't exist
if (!file_exists("../uploads/$department")) {
    if (!mkdir("../uploads/$department")) {
        $errors['proof'] = "Failed to create directory: uploads/$department";
    }
    chmod("/uploads/$department", 755);
}
if (!file_exists("../uploads/$department/$name")) {
    if (!mkdir("../uploads/$department/$name")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name";
    }
    chmod("../uploads/$department/$name", 755);
}
if (!file_exists("../uploads/$department/$name/$program_type")) {
    if (!mkdir("../uploads/$department/$name/$program_type")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name/$program_type";
    }
    chmod("../uploads/$department/$name/$program_type", 755);
}


// move uploaded file to destination directory
$proof_path = $directory_path . basename($_FILES['proof']['name']);
if (!file_exists($directory_path)) {
    if (!mkdir($directory_path, 755, true)) {
        $errors['proof'] = "Failed to create directory: " . $directory_path;
    } else {
        chmod($directory_path, 755);
    }
}
 
    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $program_type . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO fdp(userid, name, department, title, start_date, end_date, days, program_type, venue, financial_support, proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                        VALUES ('$userid', '$name', '$department', '$title', '$start_date', '$end_date', '$days', '$program_type', '$venue', '$financial_support', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);
        if ($result) {
            $fdp_id = mysqli_insert_id($con);
            $academic_year = date("Y") . "-" . (date("Y") + 1);
            $update_academic_year = "UPDATE fdp SET academic_year = '$academic_year' WHERE id = '$fdp_id'";
            $result_academic_year = mysqli_query($con, $update_academic_year);
            if (!$result_academic_year) {
                $errors[] = "Failed to update academic year.";
            }
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: fdp-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added.";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to destination directory.";
    }
    
    // if there are errors, display them
if (!empty($errors)) {
    $error_string = implode("<br>", $errors);
    $_SESSION['message'] = "Error: " . $error_string;
    header("Location: fdp-add-new.php");
    exit(0);
}
    

}
if (isset($_POST['seminar-submit'])) {


    // escape form data and retrieve user ID and name
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $days = mysqli_real_escape_string($con, $_POST['days']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $program_type = mysqli_real_escape_string($con, $_POST['program_type']);
    $venue = mysqli_real_escape_string($con, $_POST['venue']);
    $financial_support = mysqli_real_escape_string($con, $_POST['financial_support']);
    
    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];

   // create directory path
   $directory_path = "../uploads/$department/$name/$program_type/";

   // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
    if (!mkdir("../uploads/$department")) {
        $errors['proof'] = "Failed to create directory: uploads/$department";
    }
    chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
    if (!mkdir("../uploads/$department/$name")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name";
    }
    chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$program_type")) {
    if (!mkdir("../uploads/$department/$name/$program_type")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name/$program_type";
    }
    chmod("../uploads/$department/$name/$program_type", 755);
    }


    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
    if (!mkdir($directory_path, 755, true)) {
        $errors['proof'] = "Failed to create directory: " . $directory_path;
    } else {
        chmod($directory_path, 755);
    }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $program_type . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO seminar(userid, name, department, title, start_date, end_date, days, program_type, venue, financial_support,year, proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                        VALUES ('$userid', '$name', '$department', '$title', '$start_date', '$end_date', '$days', '$program_type', '$venue','$year', '$financial_support', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);
        if ($result) {
            $seminar_id = mysqli_insert_id($con);
            $academic_year = date("Y") . "-" . (date("Y") + 1);
            $update_academic_year = "UPDATE seminar SET academic_year = '$academic_year' WHERE id = '$seminar_id'";
            $result_academic_year = mysqli_query($con, $update_academic_year);
            if (!$result_academic_year) {
                $errors[] = "Failed to update academic year.";
            }
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: seminar-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added.";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to destination directory.";
    }
    
    // if there are errors, display them
if (!empty($errors)) {
    $error_string = implode("<br>", $errors);
    $_SESSION['message'] = "Error: " . $error_string;
    header("Location: seminar-add-new.php");
    exit(0);
}
    

}
if (isset($_POST['pbm-submit'])) {


    // escape form data and retrieve user ID and name
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $fee_date = mysqli_real_escape_string($con, $_POST['fee_date']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $days = mysqli_real_escape_string($con, $_POST['days']);
    $program_name = mysqli_real_escape_string($con, $_POST['program_name']);
    $financial_support = mysqli_real_escape_string($con, $_POST['financial_support']);
    
    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $pbm_folder = "Professional Body Membership";
   // create directory path
   $directory_path = "../uploads/$department/$name/$pbm_folder/";

   // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
    if (!mkdir("../uploads/$department")) {
        $errors['proof'] = "Failed to create directory: uploads/$department";
    }
    chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
    if (!mkdir("../uploads/$department/$name")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name";
    }
    chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$pbm_folder")) {
    if (!mkdir("../uploads/$department/$name/$pbm_folder")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name/$pbm_folder";
    }
    chmod("../uploads/$department/$name/$pbm_folder", 755);
    }


    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
    if (!mkdir($directory_path, 755, true)) {
        $errors['proof'] = "Failed to create directory: " . $directory_path;
    } else {
        chmod($directory_path, 755);
    }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $pbm_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO pbm(userid, name, department, year, title, start_date, end_date, days, fee_date, program_name, financial_support, proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                VALUES ('$userid', '$name', '$department', '$year', '$title', '$start_date', '$end_date', '$days', '$fee_date', '$program_name', '$financial_support', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: pbm-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added.";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to destination directory.";
    }
    
    // if there are errors, display them
if (!empty($errors)) {
    $error_string = implode("<br>", $errors);
    $_SESSION['message'] = "Error: " . $error_string;
    header("Location: pbm-add-new.php");
    exit(0);
}
    

}

if (isset($_POST['resource-submit'])) {


    // escape form data and retrieve user ID and name
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $academic_year = mysqli_real_escape_string($con, $_POST['academic_year']);
    $member_role = mysqli_real_escape_string($con, $_POST['member_role']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $days = mysqli_real_escape_string($con, $_POST['days']);
    $venue = mysqli_real_escape_string($con, $_POST['venue']);
    $topic = mysqli_real_escape_string($con, $_POST['topic']);
    $financial_support = mysqli_real_escape_string($con, $_POST['financial_support']);
    
    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Resource Person";
   // create directory path
   $directory_path = "../uploads/$department/$name/$new_folder/";

   // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
    if (!mkdir("../uploads/$department")) {
        $errors['proof'] = "Failed to create directory: uploads/$department";
    }
    chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
    if (!mkdir("../uploads/$department/$name")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name";
    }
    chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
    if (!mkdir("../uploads/$department/$name/$new_folder")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
    }
    chmod("../uploads/$department/$name/$new_folder", 755);
    }


    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
    if (!mkdir($directory_path, 755, true)) {
        $errors['proof'] = "Failed to create directory: " . $directory_path;
    } else {
        chmod($directory_path, 755);
    }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO resource_person(userid, name, department, title, topic, academic_year, start_date, end_date, days, member_role, venue, financial_support, proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                VALUES ('$userid', '$name', '$department', '$title','$topic','$academic_year', '$start_date', '$end_date', '$days', '$member_role', '$venue', '$financial_support', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: resource-person-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added.";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to destination directory.";
    }
    
    // if there are errors, display them
if (!empty($errors)) {
    $error_string = implode("<br>", $errors);
    $_SESSION['message'] = "Error: " . $error_string;
    header("Location: resource-person-add-new.php");
    exit(0);
}
    

}

if (isset($_POST['oc-submit'])) {


    // escape form data and retrieve user ID and name
    $course_name = mysqli_real_escape_string($con, $_POST['course_name']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $course_date = mysqli_real_escape_string($con, $_POST['course_date']);
    $platform = mysqli_real_escape_string($con, $_POST['platform']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $recognition = mysqli_real_escape_string($con, $_POST['recognition']);
    $fdp_approved = mysqli_real_escape_string($con, $_POST['fdp_approved']);
    $financial_support = mysqli_real_escape_string($con, $_POST['financial_support']);
    
    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Online Course";
   // create directory path
   $directory_path = "../uploads/$department/$name/$new_folder/";

   // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
    if (!mkdir("../uploads/$department")) {
        $errors['proof'] = "Failed to create directory: uploads/$department";
    }
    chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
    if (!mkdir("../uploads/$department/$name")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name";
    }
    chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
    if (!mkdir("../uploads/$department/$name/$new_folder")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
    }
    chmod("../uploads/$department/$name/$new_folder", 755);
    }


    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
    if (!mkdir($directory_path, 755, true)) {
        $errors['proof'] = "Failed to create directory: " . $directory_path;
    } else {
        chmod($directory_path, 755);
    }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO online_course(userid, name, department, course_name, year, course_date, duration, platform, recognition, fdp_approved, financial_support, proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                VALUES ('$userid', '$name', '$department', '$course_name','$year','$course_date', '$duration', '$platform', '$recognition', '$fdp_approved', '$financial_support', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: online-course-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added.";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to destination directory.";
    }
    
    // if there are errors, display them
if (!empty($errors)) {
    $error_string = implode("<br>", $errors);
    $_SESSION['message'] = "Error: " . $error_string;
    header("Location: online-course-add-new.php");
    exit(0);
}
    

}

if (isset($_POST['event-submit'])) {


    // escape form data and retrieve user ID and name
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $coordinator_name = mysqli_real_escape_string($con, $_POST['coordinator_name']);
    $participants = mysqli_real_escape_string($con, $_POST['participants']);
    $sponsors = mysqli_real_escape_string($con, $_POST['sponsors']);
    $program_type = mysqli_real_escape_string($con, $_POST['program_type']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $feedback = mysqli_real_escape_string($con, $_POST['feedback']);
    $fund= mysqli_real_escape_string($con, $_POST['fund']);
    $venue=mysqli_real_escape_string($con, $_POST['venue']);
    $level=mysqli_real_escape_string($con, $_POST['level']);
    
    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Events Organized";
   // create directory path
   $directory_path = "../uploads/$department/$name/$new_folder/";

   // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
    if (!mkdir("../uploads/$department")) {
        $errors['proof'] = "Failed to create directory: uploads/$department";
    }
    chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
    if (!mkdir("../uploads/$department/$name")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name";
    }
    chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
    if (!mkdir("../uploads/$department/$name/$new_folder")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
    }
    chmod("../uploads/$department/$name/$new_folder", 755);
    }


    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
    if (!mkdir($directory_path, 755, true)) {
        $errors['proof'] = "Failed to create directory: " . $directory_path;
    } else {
        chmod($directory_path, 755);
    }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO event_organized(userid, name, department, title,coordinator_name,program_type,participants,start_date,end_date,venue,level,feedback,fund,sponsors , proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                VALUES ('$userid', '$name', '$department', '$title','$coordinator_name','$program_type','$participants', '$start_date', '$end_date', '$venue', '$level', '$feedback','$fund','$sponsors', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: event-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added.";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to destination directory.";
    }
    
    // if there are errors, display them
if (!empty($errors)) {
    $error_string = implode("<br>", $errors);
    $_SESSION['message'] = "Error: " . $error_string;
    header("Location: event-add-new.php");
    exit(0);
}
    

}

if (isset($_POST['awards-submit'])) {


    // escape form data and retrieve user ID and name
    $award_name = mysqli_real_escape_string($con, $_POST['award_name']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $agency = mysqli_real_escape_string($con, $_POST['agency']);
    $award_type = mysqli_real_escape_string($con, $_POST['award_type']);
    $received_date = mysqli_real_escape_string($con, $_POST['received_date']);
    
    
    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Awards & Recognition";
   // create directory path
   $directory_path = "../uploads/$department/$name/$new_folder/";

   // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
    if (!mkdir("../uploads/$department")) {
        $errors['proof'] = "Failed to create directory: uploads/$department";
    }
    chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
    if (!mkdir("../uploads/$department/$name")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name";
    }
    chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
    if (!mkdir("../uploads/$department/$name/$new_folder")) {
        $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
    }
    chmod("../uploads/$department/$name/$new_folder", 755);
    }


    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
    if (!mkdir($directory_path, 755, true)) {
        $errors['proof'] = "Failed to create directory: " . $directory_path;
    } else {
        chmod($directory_path, 755);
    }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO awards(userid, name, department, award_name, category, agency, received_date, award_type,  proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                VALUES ('$userid', '$name', '$department', '$award_name','$category','$agency', '$received_date', '$award_type',  '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: awards-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added.";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to destination directory.";
    }
    
    // if there are errors, display them
if (!empty($errors)) {
    $error_string = implode("<br>", $errors);
    $_SESSION['message'] = "Error: " . $error_string;
    header("Location: awards-add-new.php");
    exit(0);
}
    

}

if (isset($_POST['extension-submit'])) {

    // escape form data and retrieve user ID and name
    $activity_name = mysqli_real_escape_string($con, $_POST['activity_name']);
    $organizer = mysqli_real_escape_string($con, $_POST['organizer']);
    $scheme = mysqli_real_escape_string($con, $_POST['scheme']);
    $activity_date = mysqli_real_escape_string($con, $_POST['activity_date']);
    $venue = mysqli_real_escape_string($con, $_POST['venue']);
    $student_count = mysqli_real_escape_string($con, $_POST['student_count']);
    
    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Extension & Outreach";
    
    // create directory path
    $directory_path = "../uploads/$department/$name/$new_folder/";

    // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
        if (!mkdir("../uploads/$department")) {
            $errors['proof'] = "Failed to create directory: uploads/$department";
        }
        chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
        if (!mkdir("../uploads/$department/$name")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name";
        }
        chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
        if (!mkdir("../uploads/$department/$name/$new_folder")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
        }
        chmod("../uploads/$department/$name/$new_folder", 755);
    }

    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
        if (!mkdir($directory_path, 755, true)) {
            $errors['proof'] = "Failed to create directory: " . $directory_path;
        } else {
            chmod($directory_path, 755);
        }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO extension (userid, name, department, activity_name, organizer, scheme, activity_date, venue, student_count, proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                        VALUES ('$userid', '$name', '$department', '$activity_name', '$organizer', '$scheme', '$activity_date', '$venue', '$student_count', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: extension-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added.";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to the destination directory.";
    }
    
    // if there are errors, display them
    if (!empty($errors)) {
        $error_string = implode("<br>", $errors);
        $_SESSION['message'] = "Error: " . $error_string;
        header("Location: extension-add-new.php");
        exit(0);
    }
}

if (isset($_POST['exchange-submit'])) {

    // escape form data and retrieve user ID and name
    $activity_name = mysqli_real_escape_string($con, $_POST['activity_name']);
    $agency = mysqli_real_escape_string($con, $_POST['agency']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $mou = mysqli_real_escape_string($con, $_POST['mou']);
    $participant_name = mysqli_real_escape_string($con, $_POST['participant_name']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $days = mysqli_real_escape_string($con, $_POST['days']);
    $financial_support = mysqli_real_escape_string($con, $_POST['financial_support']);
    
    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Faculty  Exchange";
    
    // create directory path
    $directory_path = "../uploads/$department/$name/$new_folder/";

    // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
        if (!mkdir("../uploads/$department")) {
            $errors['proof'] = "Failed to create directory: uploads/$department";
        }
        chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
        if (!mkdir("../uploads/$department/$name")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name";
        }
        chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
        if (!mkdir("../uploads/$department/$name/$new_folder")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
        }
        chmod("../uploads/$department/$name/$new_folder", 755);
    }

    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
        if (!mkdir($directory_path, 755, true)) {
            $errors['proof'] = "Failed to create directory: " . $directory_path;
        } else {
            chmod($directory_path, 755);
        }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO exchange (userid, name, department, activity_name, agency, contact, type, mou, participant_name,financial_support, proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                        VALUES ('$userid', '$name', '$department', '$activity_name', '$agency', '$contact', '$type', '$mou', '$participant_name','$start_date','$end_date','$days','$financial_support', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: faculty-exchange-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added.";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to the destination directory.";
    }
    
    // if there are errors, display them
    if (!empty($errors)) {
        $error_string = implode("<br>", $errors);
        $_SESSION['message'] = "Error: " . $error_string;
        header("Location: faculty-exchange-add-new.php");
        exit(0);
    }
}

if (isset($_POST['conference-submit'])) {

    // escape form data and retrieve user ID and name
    $conference_title = mysqli_real_escape_string($con, $_POST['conference_title']);
    $paper_title = mysqli_real_escape_string($con, $_POST['paper_title']);
    $position = mysqli_real_escape_string($con, $_POST['position']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $level = mysqli_real_escape_string($con, $_POST['level']);
    $venue = mysqli_real_escape_string($con, $_POST['venue']);
    $organizer = mysqli_real_escape_string($con, $_POST['organizer']);
    $preceeding_title = mysqli_real_escape_string($con, $_POST['preceeding_title']);
    $pages = mysqli_real_escape_string($con, $_POST['pages']);
    $isbn = mysqli_real_escape_string($con, $_POST['isbn']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $institute = mysqli_real_escape_string($con, $_POST['institute']);
    $publisher_name = mysqli_real_escape_string($con, $_POST['publisher_name']);

    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $days = mysqli_real_escape_string($con, $_POST['days']);
    $financial_support = mysqli_real_escape_string($con, $_POST['financial_support']);
    
    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Conference";
    
    // create directory path
    $directory_path = "../uploads/$department/$name/$new_folder/";

    // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
        if (!mkdir("../uploads/$department")) {
            $errors['proof'] = "Failed to create directory: uploads/$department";
        }
        chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
        if (!mkdir("../uploads/$department/$name")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name";
        }
        chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
        if (!mkdir("../uploads/$department/$name/$new_folder")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
        }
        chmod("../uploads/$department/$name/$new_folder", 755);
    }

    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
        if (!mkdir($directory_path, 755, true)) {
            $errors['proof'] = "Failed to create directory: " . $directory_path;
        } else {
            chmod($directory_path, 755);
        }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO conference (userid, name, department, conference_title, paper_title, position, start_date,end_date,days,type,level,venue,organizer,preceeding_title,pages,isbn,year,institute,publisher_name,financial_support, proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                        VALUES ('$userid', '$name', '$department', '$conference_title', '$paper_title', '$position', '$start_date','$end_date','$days','$type','$level','$venue','$organizer','$preceeding_title','$pages','$isbn','$year','$institute','$publisher_name','$financial_support', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: conference-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added.";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to the destination directory.";
    }
    
    // if there are errors, display them
    if (!empty($errors)) {
        $error_string = implode("<br>", $errors);
        $_SESSION['message'] = "Error: " . $error_string;
        header("Location: conference-add-new.php");
        exit(0);
    }
}

if (isset($_POST['journal-submit'])) {

    // escape form data and retrieve user ID and name
    $author_name = mysqli_real_escape_string($con, $_POST['author_name']);
    $author_dept = mysqli_real_escape_string($con, $_POST['author_dept']);
    $author_position = mysqli_real_escape_string($con, $_POST['author_position']);
    $co_author_name = mysqli_real_escape_string($con, $_POST['co_author_name']);
    $co_author_dept = mysqli_real_escape_string($con, $_POST['co_author_dept']);
    $co_author_position = mysqli_real_escape_string($con, $_POST['co_author_position']);
    $paper_title = mysqli_real_escape_string($con, $_POST['paper_title']);
    $journal_name = mysqli_real_escape_string($con, $_POST['journal_name']);
    $volume = mysqli_real_escape_string($con, $_POST['volume']);
    $page_no = mysqli_real_escape_string($con, $_POST['page_no']);
    $year_of = mysqli_real_escape_string($con, $_POST['year_of']);
    $month_of = mysqli_real_escape_string($con, $_POST['month_of']);
    $issn = mysqli_real_escape_string($con, $_POST['preceeding-title']);
    $impact = mysqli_real_escape_string($con, $_POST['impact']);
    $program_type = mysqli_real_escape_string($con, $_POST['program_type']);
    $journal_rank = mysqli_real_escape_string($con, $_POST['journal_rank']);
    $link = mysqli_real_escape_string($con, $_POST['link']);
    $doi = mysqli_real_escape_string($con, $_POST['doi']);

    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Journal Publication";
    
    // create directory path
    $directory_path = "../uploads/$department/$name/$new_folder/";

    // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
        if (!mkdir("../uploads/$department")) {
            $errors['proof'] = "Failed to create directory: uploads/$department";
        }
        chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
        if (!mkdir("../uploads/$department/$name")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name";
        }
        chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
        if (!mkdir("../uploads/$department/$name/$new_folder")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
        }
        chmod("../uploads/$department/$name/$new_folder", 755);
    }

    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
        if (!mkdir($directory_path, 755, true)) {
            $errors['proof'] = "Failed to create directory: " . $directory_path;
        } else {
            chmod($directory_path, 755);
        }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO journal (userid, name, department, author_name,author_dept,author_position,co_author_name,co_author_dept,co_author_position, paper_title, journal_name, volume,page_no,year_of,month_of,issn,impact,program_type,journal_rank,link,doi, proof, hod_approval, hod_remarks, admin_approval, admin_remarks) 
                        VALUES ('$userid', '$name', '$department', '$author_name','$author_dept','$author_position','$co_author_name','$co_author_dept','$co_author_position', '$paper_title', '$journal_name', '$volume','$page_no','$year_of','$month_of','$issn','$impact','$program_type','$journal_rank','$link','$doi', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: journal-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to the destination directory.";
    }
    
    // if there are errors, display them
    if (!empty($errors)) {
        $error_string = implode("<br>", $errors);
        $_SESSION['message'] = "Error: " . $error_string;
        header("Location: journal-add-new.php");
        exit(0);
    }
}

if (isset($_POST['book-submit'])) {

    // escape form data and retrieve user ID and name

    $position = mysqli_real_escape_string($con, $_POST['position']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $publisher = mysqli_real_escape_string($con, $_POST['publisher']);
    $institute = mysqli_real_escape_string($con, $_POST['institute']);
    $page_no = mysqli_real_escape_string($con, $_POST['page_no']);
    $year_of = mysqli_real_escape_string($con, $_POST['year_of']);
    $month_of = mysqli_real_escape_string($con, $_POST['month_of']);
    $issn = mysqli_real_escape_string($con, $_POST['preceeding-title']);
    

    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Book Publication";
    
    // create directory path
    $directory_path = "../uploads/$department/$name/$new_folder/";

    // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
        if (!mkdir("../uploads/$department")) {
            $errors['proof'] = "Failed to create directory: uploads/$department";
        }
        chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
        if (!mkdir("../uploads/$department/$name")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name";
        }
        chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
        if (!mkdir("../uploads/$department/$name/$new_folder")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
        }
        chmod("../uploads/$department/$name/$new_folder", 755);
    }

    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
        if (!mkdir($directory_path, 755, true)) {
            $errors['proof'] = "Failed to create directory: " . $directory_path;
        } else {
            chmod($directory_path, 755);
        }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO book (userid, name, department, position,title,page_no,issn,publisher,year_of,month_of,institute,proof,hod_approval,hod_remarks,admin_approval,admin_remarks) 
                        VALUES ('$userid', '$name', '$department', '$position', '$title', '$page_no','$issn','$publisher','$year_of','$month_of','$institute', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: book-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to the destination directory.";
    }
    
    // if there are errors, display them
    if (!empty($errors)) {
        $error_string = implode("<br>", $errors);
        $_SESSION['message'] = "Error: " . $error_string;
        header("Location: book-add-new.php");
        exit(0);
    }
}

if (isset($_POST['patent-submit'])) {

    // escape form data and retrieve user ID and name

    $position = mysqli_real_escape_string($con, $_POST['position']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $app_number = mysqli_real_escape_string($con, $_POST['app_number']);
    $app_date = mysqli_real_escape_string($con, $_POST['app_date']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $type_date = mysqli_real_escape_string($con, $_POST['type_date']);
    $patent_body = mysqli_real_escape_string($con, $_POST['patent_body']);
    $financial_support = mysqli_real_escape_string($con, $_POST['financial_support']);
    

    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Patent";
    
    // create directory path
    $directory_path = "../uploads/$department/$name/$new_folder/";

    // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
        if (!mkdir("../uploads/$department")) {
            $errors['proof'] = "Failed to create directory: uploads/$department";
        }
        chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
        if (!mkdir("../uploads/$department/$name")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name";
        }
        chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
        if (!mkdir("../uploads/$department/$name/$new_folder")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
        }
        chmod("../uploads/$department/$name/$new_folder", 755);
    }

    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
        if (!mkdir($directory_path, 755, true)) {
            $errors['proof'] = "Failed to create directory: " . $directory_path;
        } else {
            chmod($directory_path, 755);
        }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO patent (userid, name, department, position,title,app_number,app_date,type,type_date,patent_body,financial_support,proof,hod_approval,hod_remarks,admin_approval,admin_remarks) 
                        VALUES ('$userid', '$name', '$department', '$position', '$title', '$app_number','$app_date','$type','$type_date','$patent_body','$financial_support', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: patent-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to the destination directory.";
    }
    
    // if there are errors, display them
    if (!empty($errors)) {
        $error_string = implode("<br>", $errors);
        $_SESSION['message'] = "Error: " . $error_string;
        header("Location: patent-add-new.php");
        exit(0);
    }
}

if (isset($_POST['consultancy-submit'])) {

    // escape form data and retrieve user ID and name

    $consultancy_pro = mysqli_real_escape_string($con, $_POST['consultancy_pro']);
    $consultancy_name = mysqli_real_escape_string($con, $_POST['consultancy_name']);
    $aagency_name = mysqli_real_escape_string($con, $_POST['aagency_name']);
    $trainees = mysqli_real_escape_string($con, $_POST['trainees']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $days = mysqli_real_escape_string($con, $_POST['days']);
    $revenue = mysqli_real_escape_string($con, $_POST['revenue']);

    $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];
    $new_folder = "Consultancy";
    
    // create directory path
    $directory_path = "../uploads/$department/$name/$new_folder/";

    // create directories if they don't exist
    if (!file_exists("../uploads/$department")) {
        if (!mkdir("../uploads/$department")) {
            $errors['proof'] = "Failed to create directory: uploads/$department";
        }
        chmod("../uploads/$department", 755);
    }
    if (!file_exists("../uploads/$department/$name")) {
        if (!mkdir("../uploads/$department/$name")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name";
        }
        chmod("../uploads/$department/$name", 755);
    }
    if (!file_exists("../uploads/$department/$name/$new_folder")) {
        if (!mkdir("../uploads/$department/$name/$new_folder")) {
            $errors['proof'] = "Failed to create directory: uploads/$department/$name/$new_folder";
        }
        chmod("../uploads/$department/$name/$new_folder", 755);
    }

    // move uploaded file to destination directory
    $proof_path = $directory_path . basename($_FILES['proof']['name']);
    if (!file_exists($directory_path)) {
        if (!mkdir($directory_path, 755, true)) {
            $errors['proof'] = "Failed to create directory: " . $directory_path;
        } else {
            chmod($directory_path, 755);
        }
    }

    if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
        // file uploaded successfully
        // generate unique URL
        $url = "http://localhost/Curricula/uploads/" . $department . "/" . $name . "/" . $new_folder . "/" . basename($proof_path);
        // save URL to database
        $insert_data = "INSERT INTO consultancy (userid, name, department, consultancy_pro,consultancy_name,aagency_name,trainees,start_date,end_date,days,revenue,proof,hod_approval,hod_remarks,admin_approval,admin_remarks) 
                        VALUES ('$userid', '$name', '$department', '$consultancy_pro', '$consultancy_name', '$aagency_name','$trainees','$start_date','$end_date','$days','$revenue', '$url', 'Pending Approval', 'NIL', 'Pending Approval', 'NIL')";
        $result = mysqli_query($con, $insert_data);

        if ($result) {
            $_SESSION['message'] = "Form Added Successfully";
            header("Location: consultancy-form.php");
            exit(0);
        } else {
            $errors[] = "Form not added";
        }
    } else {
        $errors['proof'] = "Failed to move uploaded file to the destination directory.";
    }
    
    // if there are errors, display them
    if (!empty($errors)) {
        $error_string = implode("<br>", $errors);
        $_SESSION['message'] = "Error: " . $error_string;
        header("Location: consultancy-add-new.php");
        exit(0);
    }
}

// check if form is submitted
if (isset($_POST['update'])) {
  

  // get form data
  $id = $_POST['id'];
  $title = $_POST['title'];
  $days = $_POST['days'];
  $program_type = $_POST['program_type'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $venue = $_POST['venue'];
  $financial_support = $_POST['financial_support'];
  $userid = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $department = $fetch_info['department'];

  // update record in database
  $sql = "UPDATE fdp SET title=?, days=?, program_type=?, start_date=?, end_date=?, venue=?, financial_support=? WHERE id=?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("sisssssi", $title, $days, $program_type, $start_date, $end_date, $venue, $financial_support, $id);
  $stmt->execute();

  // check if proof file is uploaded
  if ($_FILES['proof']['name']) {
    // delete old proof file
    $sql = "SELECT proof FROM fdp WHERE id=$id";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $old_proof = $row['proof'];
      if ($old_proof) {
        unlink("uploads/$department/$name/$program_type/$old_proof");
      }
    }

    // upload new proof file
   
    $proof_name = basename($_FILES['proof']['name']);
    $proof_type = strtolower(pathinfo($proof_name,PATHINFO_EXTENSION));
    if ($proof_type != "pdf") {
      $errors[] = "File must be a PDF.";
    } else {
      // create directory path
      $directory_path = "uploads/$department/$name/$program_type/";

      // create directories if they don't exist
      if (!file_exists("uploads/$department")) {
          mkdir("uploads/$department");
      }
      if (!file_exists("uploads/$department/$name")) {
          mkdir("uploads/$department/$name");
      }
      if (!file_exists("uploads/$department/$name/$program_type")) {
          mkdir("uploads/$department/$name/$program_type");
      }

      // move uploaded file to destination directory
      $proof_path = $directory_path . $proof_name;
      if (move_uploaded_file($_FILES['proof']['tmp_name'], $proof_path)) {
          // file uploaded successfully
          // generate unique URL
          $url = "http://localhost/ERP/uploads/" . $department . "/" . $name . "/" . $program_type . "/" . $proof_name;

          // update record in database with new proof file
          $sql = "UPDATE fdp SET proof=? WHERE id=?";
          $stmt = $con->prepare($sql);
          $stmt->bind_param("si", $proof_name, $id);
          $stmt->execute();
      } else {
          $errors[] = "Failed to upload file.";
      }
    }
  }
}



?>