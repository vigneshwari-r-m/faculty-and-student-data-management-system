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
?>
<?php
//if approve button of fdp is clicked

if(isset($_POST['approve-fdp'])) {
    $id = $_POST['id'];

    $query = "UPDATE fdp SET hod_approval='Approved' WHERE id= '$id'";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    // check if the query was successful and redirect to the previous page
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        // successful update, redirect to previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // error occurred, show an error message
        echo "Error: Unable to approve the FDP.";
    }
}

?>