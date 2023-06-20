<?php

include 'config1.php';

$students = []; // Initialize an empty array to store the RegNos
$dutyLeaveIds = []; // Initialize an empty array to store the duty_leave IDs

try {
    // Fetch RegNo and duty_leave IDs from the duty_leave table
    $stmt = $conn->query("SELECT RegNo, id FROM duty_leave");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Iterate over the result and store RegNos and duty_leave IDs in separate arrays
    foreach ($result as $row) {
        $students[] = $row['RegNo'];
        $dutyLeaveIds[] = $row['id'];
    }
} catch (PDOException $e) {
    // Handle any errors that occurred during the database query
    echo "Error: " . $e->getMessage();
}

// Close the database connection or release any resources used

// Prepare the response array with separate RegNo and duty_leave ID arrays
$response = [
    'RegNos' => $students,
    'DutyLeaveIds' => $dutyLeaveIds
];

// Return the response array as a JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
