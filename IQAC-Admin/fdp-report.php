<?php
require_once "connection.php";

// Retrieve data from the database
$sql = "SELECT id, name, department, title, program_type, start_date, end_date, days, proof,financial_support FROM fdp WHERE hod_approval = 'Approved' AND admin_approval = 'Approved'";
$result = $con->query($sql);

// Set the filename and file type
$filename = 'fdp_' . date('Y-m-d_H-i-s') . '.xls';

// Set the appropriate headers for an Excel file
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Create a file pointer connected to the output stream
$fp = fopen('php://output', 'w');

// Define the column headers and their background colors
$headers = array(
    'ID' => 'C5E1A5',
    'Name' => 'C5E1A5',
    'Department' => 'C5E1A5',
    'Title' => 'C5E1A5',
    'Program Type' => 'C5E1A5',
    'Start Date' => 'C5E1A5',
    'End Date' => 'C5E1A5',
    'Days' => 'C5E1A5',
    'Proof Attachment' => 'C5E1A5',
    'Financial Support' => 'C5E1A5'
);

// Write the column headers to the Excel file
foreach ($headers as $header => $color) {
    fwrite($fp, "$header\t");
}
fwrite($fp, "\n");

// Write the data rows to the Excel file
while ($row_data = $result->fetch_assoc()) {
    foreach ($row_data as $cell) {
        fwrite($fp, "$cell\t");
    }
    fwrite($fp, "\n");
}

// Close the file pointer
fclose($fp);

// Exit the script
exit;
?>
