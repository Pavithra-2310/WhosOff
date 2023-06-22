<?php
include 'config1.php';
$students = []; // Initialize an empty array to store the RegNos
$dutyLeaveIds = []; // Initialize an empty array to store the duty_leave IDs
$branchIds = []; // Initialize an empty array to store the Branch IDs

try {
    // Fetch the list of students with approved duty leave
    $sql = "SELECT student.RegNo, duty_leave.id AS dutyLeaveId, student_relation.Branchid
            FROM student
            INNER JOIN student_relation ON student.sid = student_relation.sid
            INNER JOIN branch ON student_relation.Branchid = branch.Branchid
            INNER JOIN duty_leave ON student.RegNo = duty_leave.regNo
            WHERE duty_leave.status = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $students[] = $row['RegNo'];
        $dutyLeaveIds[] = $row['dutyLeaveId'];
        $branchIds[] = $row['Branchid'];
    }
} catch (PDOException $e) {
    // Handle any errors that occurred during the database query
    echo "Error: " . $e->getMessage();
}

$response = [
    'RegNos' => $students,
    'DutyLeaveIds' => $dutyLeaveIds,
    'BranchIds' => $branchIds
];

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
