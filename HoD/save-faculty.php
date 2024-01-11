<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM hod WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: resetcode.php');
            }
        }else{
            header('Location: hod-otp.php');
        }
    }
}else{
    header('Location: hod-login.php');
}

require_once "connection.php";
require_once "controller.php";

if(isset($_POST['add-faculty'])){
    // Retrieve form data
    $facultyId = $_POST['faculty_id'];
    $name = $_POST['name'];
    $qualification = $_POST['qualification'];
    $designation = $_POST['designation'];
    $coordinator = $_POST['coordinator'];

    // Validate form data
    if (empty($facultyId) || empty($name) || empty($qualification) || empty($designation)) {
        $response = array('success' => false, 'message' => 'Please fill in all required fields.');
        echo json_encode($response);
        exit;
    }

    // Check for connection errors
    if ($con->connect_error) {
        $response = array('success' => false, 'message' => 'Database connection error: ' . $con->connect_error);
        echo json_encode($response);
        exit;
    }

    // Prepare and execute the SQL statement
    $stmt = $con->prepare("INSERT INTO Faculty (faculty_id, name, qualification, designation, coordinator) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $facultyId, $name, $qualification, $designation, $coordinator);

    if ($stmt->execute()) {
        $response = array('success' => true, 'message' => 'Faculty added successfully.');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'message' => 'Error adding faculty: ' . $con->error);
        echo json_encode($response);
    }

    // Close the statement and connection
    $stmt->close();
 
}

?>
