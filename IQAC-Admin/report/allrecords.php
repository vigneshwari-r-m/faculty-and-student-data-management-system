<?php
require('config.php');
$db = new db;
$result = $db->getRecords();

echo '<table class="table table-striped table-responsive">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Title</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Days</th>
            <th>Program Type</th>
            <th>Venue</th>
            <th>Financial Support</th>
            <th>Proof</th>
            <th>HOD Approval</th>
            <th>HOD Remarks</th>
            <th>Admin Approval</th>
            <th>Admin Remarks</th>
            <th>Submitted Time</th>
        </tr>';

while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['userid']."</td>
        <td>".$row['name']."</td>
        <td>".$row['department']."</td>
        <td>".$row['title']."</td>
        <td>".$row['start_date']."</td>
        <td>".$row['end_date']."</td>
        <td>".$row['days']."</td>
        <td>".$row['program_type']."</td>
        <td>".$row['venue']."</td>
        <td>".$row['financial_support']."</td>
        <td>".$row['proof']."</td>
        <td>".$row['hod_approval']."</td>
        <td>".$row['hod_remarks']."</td>
        <td>".$row['admin_approval']."</td>
        <td>".$row['admin_remarks']."</td>
        <td>".$row['submitted_time']."</td>
    </tr>";
}

echo '</table>';

$db->closeCon();
?>
