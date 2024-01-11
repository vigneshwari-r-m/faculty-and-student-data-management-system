<?php
require "connection.php";
$department_id = $_POST['department_id'];

// Query the database for the hod name
$query = "SELECT hod_name FROM hodlist WHERE department_id = '$department_id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

// Return the hod name as a response
echo $row['hod_name'];
?>