<?php

include 'config1.php';
session_start();

$regno = $_SESSION['RegNo'];

// Retrieve student information
$sql = "SELECT * FROM student WHERE student.RegNo = '{$regno}'";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    $student = $result->fetch(PDO::FETCH_ASSOC);

    // Display student profile details
  

    // Retrieve courses for the student's branch
    $studentId = $student['sid'];
    $courseQuery = "SELECT c.CourseCode, AVG(a.ispresent) AS AttendancePercentage FROM course c JOIN student_relation s ON c.BranchId = s.Branchid JOIN attendance a ON c.CourseId = a.CourseId WHERE s.SID = '{$studentId}' GROUP BY c.CourseCode";
    $courseResult = $conn->query($courseQuery);

    if ($courseResult->rowCount() > 0) {
        while ($course = $courseResult->fetch(PDO::FETCH_ASSOC)) {
            echo "<button>" . $course['CourseCode'] . " - Attendance: " . round($course['AttendancePercentage'] * 100, 2) . "%</button>";
        }
    } else {
        echo "No courses found for the student's branch.";
    }

    echo "</div>";
} else {
    echo "No student data found.";
}

?>
