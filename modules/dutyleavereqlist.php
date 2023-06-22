<?php

include 'config1.php';

$students = []; // Initialize an empty array to store the RegNos
$dutyLeaveIds = []; // Initialize an empty array to store the duty_leave IDs
$branchIds = []; // Initialize an empty array to store the Branch IDs

try {
    // Fetch RegNo, duty_leave IDs, and Branch IDs from the duty_leave, student, and student_relation tables
    $stmt = $conn->prepare("SELECT duty_leave.RegNo, duty_leave.id, student_relation.Branchid FROM duty_leave
                            INNER JOIN student ON duty_leave.RegNo = student.RegNo
                            INNER JOIN student_relation ON student.sid = student_relation.sid");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Iterate over the result and store RegNos, duty_leave IDs, and Branch IDs in separate arrays
    foreach ($result as $row) {
        $students[] = $row['RegNo'];
        $dutyLeaveIds[] = $row['id'];
        $branchIds[] = $row['Branchid'];
    }
} catch (PDOException $e) {
    // Handle any errors that occurred during the database query
    echo "Error: " . $e->getMessage();
}

// Close the database connection or release any resources used

// Prepare the response array with separate RegNo, duty_leave ID, and Branch ID arrays
$response = [
    'RegNos' => $students,
    'DutyLeaveIds' => $dutyLeaveIds,
    'BranchIds' => $branchIds
];

// Return the response array as a JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
