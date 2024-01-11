<?php
require('config.php');
$db = new db;

$department = $_POST['department'];
$approval = $_POST['approval'];
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];

$result1 = $db->getFilteredRecords($department, $approval, $fromDate, $toDate);

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

while ($row1 = mysqli_fetch_array($result1)) {
    echo "<tr>
        <td>".$row1['id']."</td>
        <td>".$row1['userid']."</td>
        <td>".$row1['name']."</td>
        <td>".$row1['department']."</td>
        <td>".$row1['title']."</td>
        <td>".$row1['start_date']."</td>
        <td>".$row1['end_date']."</td>
        <td>".$row1['days']."</td>
        <td>".$row1['program_type']."</td>
        <td>".$row1['venue']."</td>
        <td>".$row1['financial_support']."</td>
        <td>".$row1['proof']."</td>
        <td>".$row1['hod_approval']."</td>
        <td>".$row1['hod_remarks']."</td>
        <td>".$row1['admin_approval']."</td>
        <td>".$row1['admin_remarks']."</td>
        <td>".$row1['submitted_time']."</td>
    </tr>";
}

echo '</table>';

$db->closeCon();
?>
