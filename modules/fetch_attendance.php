<?php

include 'config1.php';
// Get the year and semesters from the query string
$year = $_GET['year'];
$semesters = explode(',', $_GET['semesters']);

// Fetch attendance data from the database based on year and semesters
// Modify the SQL query according to your database schema and table names
$query = "SELECT  CONCAT(student.FName,' ',student.LName) AS name, student.RegNo, student_relation.SemId, attendance.ispresent
          FROM student
          INNER JOIN attendance ON student.RegNo = attendance.RegNo
          INNER JOIN student_relation ON student.sid = student_relation.sid
          WHERE student_relation.SemId IN (".implode(',', array_fill(0, count($semesters), '?')).")
          ORDER BY student.RegNo";

$stmt = $conn->prepare($query);

$stmt->execute($semesters);

// Prepare an array to store the attendance data
$attendanceData = [];

// Fetch the attendance records and store them in the array
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $studentName = $row['name'];
    $regNo = $row['RegNo'];
    $semester = $row['SemId'];
    $isPresent = $row['ispresent'];

    // If the student record doesn't exist in the array, create a new entry
    if (!isset($attendanceData[$regNo])) {
        $attendanceData[$regNo] = [
            'name' => $studentName,
            'regNo' => $regNo,
            'attendance' => [],
        ];
    }

    // Store the attendance status for the corresponding semester
    $attendanceData[$regNo]['attendance'][$semester] = $isPresent;
}

// Set the response headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Output the JSON data
echo json_encode(array_values($attendanceData));
?>
