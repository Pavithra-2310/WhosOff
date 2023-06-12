<!DOCTYPE html>
<html>
<head>
    <title>Duty Leave Approval</title>
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
    </style>
</head>
<body>
    <?php
   
    include 'config1.php';

    // Check if the duty leave ID is provided in the query string
    if(isset($_GET['duty_leave_id'])) {
        $dutyLeaveId = $_GET['duty_leave_id'];

        // Fetch duty leave details from the database based on duty leave ID
        $sql = "SELECT * FROM duty_leave WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dutyLeaveId]);
        $dutyLeave = $stmt->fetch();

        // Fetch student details from the database based on Register Number
        $sql = "SELECT * FROM student WHERE RegNo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dutyLeave['RegNo']]);
        $student = $stmt->fetch();

        // Fetch duty leave dates from the database based on duty leave ID
        $sql = "SELECT * FROM duty_leave_dates WHERE duty_leave_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dutyLeaveId]);
        $dutyLeaveDates = $stmt->fetchAll();

        // Handle the faculty actions (approve/reject/update dates)
        if(isset($_POST['action'])) {
            $action = $_POST['action'];

            if($action === 'approve') {
                // Update the duty leave status as approved
                $sql = "UPDATE duty_leave SET status = 'approved' WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$dutyLeaveId]);

                echo "Duty leave approved.";
            } elseif($action === 'reject') {
                // Update the duty leave status as rejected
                $sql = "UPDATE duty_leave SET status = 'rejected' WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$dutyLeaveId]);

                echo "Duty leave rejected.";
            } elseif($action === 'update_dates') {
                // TODO: Update the duty leave dates based on faculty modifications
                // You can add the necessary code here

                echo "Dates updated.";
            }
        }
    } else {
        echo "Duty leave ID not provided.";
    }
    ?>

    <h2>Student Details</h2>
    <?php if(isset($student)): ?>
        <p><strong>Register Number:</strong> <?php echo $student['RegNo']; ?></p>
        <p><strong>Name:</strong> <?php echo $student['Name']; ?></p>
        <p><strong>Department:</strong> <?php echo $student['Department']; ?></p>
 	<p><strong>Email:</strong> <?php echo $student['EmailId']; ?></p>
        
    <?php endif; ?>

    <h2>Duty Leave Details</h2>
    <?php if(isset($dutyLeave)): ?>
        <p><strong>Reason:</strong> <?php echo $dutyLeave['Reason']; ?></p>
        <p><strong>Start Date:</strong> <?php echo $dutyLeave['StartDate']; ?></p>
        <p><strong>End Date:</strong> <?php echo $dutyLeave['EndDate']; ?></p>
        <p><strong>Duty Leave Dates:</strong></p>
        <?php if(count($dutyLeaveDates)): ?>
            <ul>
            <?php foreach($dutyLeaveDates as $date): ?>
                <li><?php echo $date['date']; ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>

    <div class="button-container">
        <form method="POST" style="display: inline;">
            <button type="submit" name="action" value="approve" class="green-button">Send to HOD</button>
        </form>
        <form method="POST" style="display: inline;">
            <button type="submit" name="action" value="reject" class="red-button">Reject</button>
        </form>
    </div>
</body>
</html>

