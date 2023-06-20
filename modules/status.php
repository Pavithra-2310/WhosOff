<?php
session_start();

// Include the database connection configuration file
include 'config1.php';

$regno = $_SESSION['RegNo'];

// Query to retrieve the duty leave status for the student
$sql = "SELECT status FROM duty_leave WHERE RegNo = '{$regno}'";

$result = $conn->query($sql);

// Check if there are any rows in the result
if ($result->rowCount() > 0) {
    // Fetch the first row
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // Get the status value
    $status = $row['status'];

    // Display the corresponding approval status
    if ($status == 0) {
        echo "<marquee><h2>Duty Leave Not Approved</h2></marquee>";
    } elseif ($status == 1) {
        echo "Approved";
    } else {
        echo "Status Unknown";
    }
} else {
    echo "No duty leave data found.";
}
?>
