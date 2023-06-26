<!DOCTYPE html>
<html>
<head>
    <title>Duty Leave Approval - Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        p {
            margin: 5px 0;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .green-button {
            background-color: green;
            color: white;
        }

        .red-button {
            background-color: red;
            color: white;
        }

        .button-container {
            position: fixed;
            bottom: 20px;
            left: 20px;
        }

        .button-container button {
            margin-right: 10px;
        }
        nav {
            background-color: #333;
            color: #fff;
            float:right;
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
        }

        nav ul li a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

   
    <?php
    include 'config1.php' ;
    include 'nav.php';

    if (isset($_GET['regNo']) && isset($_GET['dutyLeaveId'])) {
        
        $RegNo = $_GET['regNo'];
        $dutyLeaveId = $_GET['dutyLeaveId'];

        // Fetch student details from the database based on Register Number
        $sql = "SELECT student.*, branch.BranchName
                FROM student
                INNER JOIN student_relation ON student.sid = student_relation.sid
                INNER JOIN branch ON student_relation.Branchid = branch.Branchid
                WHERE student.RegNo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$RegNo]);
        $student = $stmt->fetch();

        if ($student) {
            echo "<h2>Student Details</h2>";
            echo "<p><strong>Register Number:</strong> " . $student['RegNo'] . "</p>";
            echo "<p><strong>Name:</strong> " . $student['FName'] . "</p>";
            echo "<p><strong>Department:</strong> " . $student['BranchName'] . "</p>";
            echo "<p><strong>Email:</strong> " . $student['EmailId'] . "</p>";
        } else {
            echo "Student not found.";
        }

        // Fetch duty leave details from the database based on duty_leave ID
        $sql = "SELECT * FROM duty_leave WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dutyLeaveId]);
        $dutyLeave = $stmt->fetch();

        if ($dutyLeave) {
            echo "<h2>Duty Leave Details</h2>";
            echo "<p><strong>Reason:</strong> " . $dutyLeave['reason'] . "</p>";
            echo "<p><strong>Request Letter:</strong></p>";
            echo "<p><a href='uploads/" . $dutyLeave['file_name'] . "' target='_blank'>View Letter</a></p>";
            echo "<hr>";
        } else {
            echo "Duty leave not found.";
        }

        // Fetch duty leave dates from the database based on duty_leave ID
        $sql = "SELECT * FROM duty_leave_dates WHERE duty_leave_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dutyLeaveId]);
        $dutyLeaveDates = $stmt->fetchAll();

        echo "<h2>Duty Leave Dates</h2>";
        if (count($dutyLeaveDates) > 0) {
            echo "<ul>";
            foreach ($dutyLeaveDates as $date) {
                echo "<li>" . $date['date_time'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No duty leave dates available.</p>";
        }

        echo "<div class='button-container'>";
        if ($dutyLeave['status'] === 3) {
            
            echo "<form method='POST' style='display: inline-block;'>";
            echo "<input type='hidden' name='dutyLeaveId' value='$dutyLeaveId'>";
            echo "<input type='hidden' name='action' value='approve'>";
            echo "<button class='green-button' type='submit'>Approve</button>";
            echo "</form>";
            echo "<form method='POST' style='display: inline-block;'>";
            echo "<input type='hidden' name='dutyLeaveId' value='$dutyLeaveId'>";
            echo "<input type='hidden' name='action' value='reject'>";
            echo "<button class='red-button' type='submit'>Reject</button>";
            echo "</form>";
        } 
        echo "</div>";
    }

    // Handle the principal actions (approve/reject/update dates)
    if (isset($_POST['action'])) {
        $dutyLeaveId = $_POST['dutyLeaveId'];
        $action = $_POST['action'];

        if ($action === 'approve') {
            // Calculate the count of duty leave dates
            $dateCount = count($dutyLeaveDates);
        
            // Update the duty leave status and noOfLeaves
            $sql = "UPDATE duty_leave SET status = '4', noOfLeaves = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$dateCount, $dutyLeaveId]);
        
            echo "Duty leave approved.";
        }
         elseif ($action === 'reject') {
            // Update the duty leave status as rejected
            $sql = "UPDATE duty_leave SET status = '-1' WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$dutyLeaveId]);

            echo "Duty leave rejected.";
        } elseif ($action === 'update_dates') {
            // TODO: Update the duty leave dates based on principal modifications
            // You can add the necessary code here

            echo "Dates updated.";
        }
    }
    ?>
    
</body>

</html>
