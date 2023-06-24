<?php
// add_student_process.php

// Include the configuration file
require_once 'config1.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $sid = $_POST['sid'];
    $firstName = $_POST['FName'];
    $lastName = $_POST['LName'];
    $admissionNo = $_POST['AdmnNo'];
    $gender = $_POST['Gender'];
    $dob = $_POST['DOB'];
    $phoneNo = $_POST['PhoneNo'];
    $parentNo = $_POST['ParentNo'];
    $emailId = $_POST['EmailId'];
    $regNo = $_POST['RegNo'];
    $academicYearId = $_POST['AyId'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $sql = "INSERT INTO student (sid, FName, LName, AdmnNo, Gender, DOB, PhoneNo, ParentNo, EmailId, RegNo, AyId, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->execute([$sid, $firstName, $lastName, $admissionNo, $gender, $dob, $phoneNo, $parentNo, $emailId, $regNo, $academicYearId, $password]);

    // Check if the student was added successfully
    if ($stmt->rowCount() > 0) {
        // Student added successfully
        echo "Student added successfully.";
    } else {
        // Error occurred while adding student
        echo "Error: Unable to add student.";
    }
}

// Close the database connection
$conn = null;
?>

