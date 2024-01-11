<?php
require_once "connection.php";

// Get ID and type parameters from URL
$id = $_GET['id'];
$type = $_GET['type'];

// Get remarks from POST data
$remarks = $_POST['hod_remarks'];

// Update remarks in database
if ($type == "hod") {
  $sql = "UPDATE fdp SET hod_remarks = '$remarks' WHERE id = $id";
} elseif ($type == "iqac") {
  $sql = "UPDATE fdp SET iqac_remarks = '$remarks' WHERE id = $id";
}
$result = mysqli_query($con, $sql);

// Close database connection
mysqli_close($con);

// Redirect back to the page where the remarks icon was clicked
header("Location: pending-approval.php");
exit();
?>