<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <style>
        /* Add some basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f1f1f1;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        table th {
            background-color: #f0f0f0;
        }

        .attendance-section {
            margin-top: 20px;
            text-align: center;
        }

        .attendance-section button {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .duty-leave-button {
            display: block;
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Student Profile</h1>

    <?php

   include 'config1.php';
   session_start();

$regno = $_SESSION['RegNo'];
    // Query to retrieve student data
    $sql = "SELECT * FROM student WHERE student.RegNo = '{$regno}'";

    $result = $conn->query($sql);

    // Check if there are any rows in the result
    if ($result->rowCount() > 0) {

        // Fetch the first row (assuming there's only one student)
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
    } else {
        echo "No student data found.";
    }


    ?>

    <div class="attendance-section">
        <h2>Attendance Percentage</h2>
        <button>Course 1</button>
        <button>Course 2</button>
        <button>Course 3</button>
        <button>Course 4</button>
        <button>Course 5</button>
        <button>Course 6</button>
    </div>

    <div class="duty-leave-button">
        <form action="dutyleave.php" method="POST">
       <input type="submit" value="Apply For Duty Leave"/>
     </form>
    </div>

</body>
</html>
