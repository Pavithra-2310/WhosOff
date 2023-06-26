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
    if ($status == 1) {
        echo "<h2>Duty Leave Not Approved</h2>";
    } elseif ($status == 0) {
        echo "<h2>Approved by staff Advisor</h2>";
    }elseif ($status == 3) {
        echo "Approved by  HOD";
} elseif ($status == 4) {
        echo "<h2>Approved by  Principal</h2>";
	echo "<h2>Duty Leave Sanctioned</h2>"; 
} 


else if ($status==-1){
        echo "Application rejected";
    }
} else {
    echo "No duty leave data found.";
}
?>
