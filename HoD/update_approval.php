<?php
require_once"connection.php";
require_once"controller.php";

// Get ID and type parameters from URL
$id = $_GET['id'];
$type = $_GET['type'];

//Get the name of the current user
$email = $_SESSION['email'];
$sql_name="SELECT name from hod where email='$email'";
$sql_query = mysqli_query($con,$sql_name);
$fetch = mysqli_fetch_assoc($sql_query);

$name = $fetch['name'];
// Update approval status in database
if ($type == "hod") {
  $sql = "UPDATE fdp SET hod_approval = CONCAT('Approved By ', '$name') WHERE id = $id";
} elseif ($type == "iqac") {
  $sql = "UPDATE fdp SET iqac_approval = CONCAT('Approved By ', '$name') WHERE id = $id";
}
$result = mysqli_query($con, $sql);

// Close database connection
mysqli_close($con);

// Redirect back to the page where the approval icon was clicked
header("Location: approved-data.php");
exit();
?>