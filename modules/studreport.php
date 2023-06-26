<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f1f1f1;
   
}


        /* Header styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        /* Table styles */
        table {
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
        
        /* Attendance section styles */
        .attendance-section {
            margin-top: 20px;
            text-align: center;
            padding: 10px;
        }

        .attendance-section button {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #f0f0f0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .attendance-section button:hover {
            background-color: #e0e0e0;
        }

        /* Duty leave box styles */
        .duty-leave-box {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
            margin-top: 10px;
        }

        .duty-leave-button {
            margin-top: 10px;
            text-align: left;
        }

        .duty-leave-button form {
            display: inline-block;
        }

        .duty-leave-button input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .duty-leave-button input[type="submit"]:hover {
            background-color: #cc0000;
        }

        /* Navigation styles */
        nav {
            background-color: #333;
            color: #fff;
            text-align: right;
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
        }

        nav ul li a {
            display: block;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #555;
        }
        th:first-child {
    background-color: #1E90FF;
}
    
    </style>
</head>
<body>
    <h1><center>Student Profile</center></h1>

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
        echo "<table>";
        echo "<tr><th>Name</th><td>" . $student['FName'] . " " . $student['LName'] . "</td></tr>";
        echo "<tr><th>Admission No</th><td>" . $student['AdmnNo'] . "</td></tr>";
        echo "<tr><th>Gender</th><td>" . $student['Gender'] . "</td></tr>";
        echo "<tr><th>Date of Birth</th><td>" . $student['DOB'] . "</td></tr>";
        echo "<tr><th>Email</th><td>" . $student['EmailId'] . "</td></tr>";
        echo "<tr><th>Phone Number</th><td>" . $student['PhoneNo'] . "</td></tr>";
        echo "<tr><th>Register Number</th><td>" . $student['RegNo'] . "</td></tr>";
        echo "</table>";

        // Retrieve courses for the student's branch
        $studentId = $student['sid'];
        $courseQuery = "SELECT c.CourseCode, AVG(a.ispresent) AS AttendancePercentage FROM course c JOIN student_relation s ON c.BranchId = s.Branchid JOIN attendance a ON c.CourseId = a.CourseId WHERE s.SID = '{$studentId}' GROUP BY c.CourseCode";
        $courseResult = $conn->query($courseQuery);

        if ($courseResult->rowCount() > 0) {
            while ($course = $courseResult->fetch(PDO::FETCH_ASSOC)) {
                $attendancePercentage = round(($course['AttendancePercentage']) * 100, 2);
                echo "<div class='attendance-section'>";
            if($attendancePercentage >=75){
                echo "<button onclick='getAttendancePercentage(\"" . $course['CourseCode'] . "\")'>" . $course['CourseCode'] . " - Attendance: " . $attendancePercentage . "%</button>";

                  
            }
                

                // Check if attendance is less than 75%
               else  if ($attendancePercentage < 75) {
                    // Check duty leave status
                    $dutyLeaveQuery = "SELECT * FROM duty_leave INNER JOIN student ON student.RegNo = duty_leave.RegNo INNER JOIN student_relation ON student.sid = student_relation.sid INNER JOIN course ON course.BranchId = student_relation.Branchid WHERE student.RegNo = '{$regno}' AND course.CourseCode = '{$course['CourseCode']}'";
                    $dutyLeaveResult = $conn->query($dutyLeaveQuery);

                    if ($dutyLeaveResult->rowCount() > 0) {
                        $dutyLeave = $dutyLeaveResult->fetch(PDO::FETCH_ASSOC);
                        if ($dutyLeave['status'] == 4 ) {
                            
                            $noOfleaves = $dutyLeave['noOfleaves'];
                            
                            $attendancePercentage = 75;

                            // Print new attendance with course code
                            echo "<button onclick='getAttendancePercentage(\"" . $course['CourseCode'] . "\")'>" . $course['CourseCode'] . " - Attendance: 75 " .  "%</button>";
                        }
                        else
                        {
                            echo "<button onclick='getAttendancePercentage(\"" . $course['CourseCode'] . "\")'>" . $course['CourseCode'] . " - Attendance: " . $attendancePercentage . "%</button>";

                        }

                        if ($dutyLeave['status'] != 0) {
                            echo "<div class='duty-leave-box'>";
                            echo "<div class='duty-leave-button'>";
                            echo "<form action='status.php' method='POST'>";
                            echo "<input type='submit' value='View Status'/>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                        } else {
                            echo "<div class='duty-leave-box'>";
                            echo "<div class='duty-leave-button'>";
                            echo "<form action='dutyleave.php' method='POST'>";
                            echo "<input type='submit' value='Apply For Duty Leave'/>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='duty-leave-box'>";
                        echo "<div class='duty-leave-button'>";
                        echo "<form action='dutyleave.php' method='POST'>";
                        echo "<input type='submit' value='Apply For Duty Leave'/>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                    }
                }

                echo "</div>";
            }
        } else {
            echo "No courses found for the student's branch.";
        }
    } else {
        echo "No student data found.";
    }
    ?>
 
    
</body>
</html>
