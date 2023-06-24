<?php
// Assuming you have a database connection established
include 'config1.php';
// Get the year and semesters from the query string
$year = $_GET['year'];
$semesters = explode(',', $_GET['semesters']);

// Fetch attendance data from the database based on year and semesters
// Modify the SQL query according to your database schema and table names
$query = "SELECT  CONCAT(student.FName, ' ', student.LName) AS name, student.RegNo, student_relation.SemId, AVG(attendance.ispresent) AS attendance_percentage
          FROM student
          INNER JOIN attendance ON student.RegNo = attendance.RegNo
          INNER JOIN student_relation ON student.sid = student_relation.sid
          WHERE student_relation.SemId IN (:semesters)
          GROUP BY student.RegNo, student_relation.SemId";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':semesters', implode(',', $semesters));
$stmt->execute();

// Prepare an array to store the attendance data
$attendanceData = [];

// Fetch the attendance records and store them in the array
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $studentName = $row['name'];
    $regNo = $row['RegNo'];
    $semester = $row['SemId'];
    $attendancePercentage = $row['attendance_percentage'];

    // If the student record doesn't exist in the array, create a new entry
    if (!isset($attendanceData[$regNo])) {
        $attendanceData[$regNo] = [
            'name' => $studentName,
            'regNo' => $regNo,
            'attendance' => [],
        ];
    }

    // Store the attendance percentage for the corresponding semester
    $attendanceData[$regNo]['attendance'][$semester] = $attendancePercentage;
}

// Convert the attendance data array to JSON format
$attendanceJson = json_encode(array_values($attendanceData));

// Set the response headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Output the JSON data
echo $attendanceJson;
