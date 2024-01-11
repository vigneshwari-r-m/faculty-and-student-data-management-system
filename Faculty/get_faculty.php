<?php
require "connection.php";

if(isset($_POST["department_id"]))
{
    $query = "SELECT * FROM faculty WHERE department_id = '".$_POST["department_id"]."' ORDER BY name ASC";
    $result = mysqli_query($con, $query);

    $output = '<option value="" hidden>Select Faculty</option>';
    while($row = mysqli_fetch_array($result))
    {
        $output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
    }
    echo $output;
}
?>