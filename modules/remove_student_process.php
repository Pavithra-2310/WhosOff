<?php
// Assuming you have a database connection established in config1.php
require_once 'config1.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the student ID from the form
    $student_id = $_POST["student_id"];

    // Prepare and execute the SQL query to remove the student
    $sql = "DELETE FROM student WHERE RegNo = :student_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':student_id', $student_id);
    $stmt->execute();

    // Check if the student was removed successfully
    if ($stmt->rowCount() > 0) {
        echo "Student with registration number $student_id has been removed.";
    } else {
        echo "No student found with registration number $student_id.";
    }
}
?>


