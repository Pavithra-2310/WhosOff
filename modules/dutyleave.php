<!DOCTYPE html>
<html>
<head>
    <title>Apply for Duty Leave</title>
    <style>
   body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f1f1f1;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    form {
        width: 400px;
        margin: 20px auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        border-radius: 6px;
    }

    label {
        display: block;
        margin-top: 10px;
        color: #333;
        font-weight: bold;
    }

    input[type="text"],
    textarea,
    input[type="file"],
    input[type="date"],
    input[type="time"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    input[type="text"]:focus,
    textarea:focus,
    input[type="file"]:focus,
    input[type="date"]:focus,
    input[type="time"]:focus {
        outline: none;
        border-color: #5b9bd5;
    }

    .date-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .date-container input[type="date"],
    .date-container input[type="time"] {
        flex: 1;
        margin-right: 10px;
    }

    .date-container .date-remove {
        background-color: #ff0000;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 5px 10px;
        cursor: pointer;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .error {
        color: red;
        margin-bottom: 10px;
    }

    .success {
        color: green;
        margin-bottom: 10px;
    }

    .profile-button {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
        text-decoration: none;
        font-size: 16px;
    }

    .profile-button:hover {
        background-color: #45a049;
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
    include 'config1.php';
    include 'nav.php';
    if(isset($_POST['submit'])){
        $RegNo = $_POST['RegNo'];
        $reason = $_POST['reason'];
        $requestLetter = $_POST['request_letter'];
        $dates = $_POST['dates'];
        $times = $_POST['times'];
        $uploadedFile = $_FILES['uploaded_file'];

        if($uploadedFile['error'] === 0){
            $uploadDir = 'uploads/';
            $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid('', true) . '.' . $fileExtension;

            if(move_uploaded_file($uploadedFile['tmp_name'], $uploadDir . $newFileName)){
                $success = "File uploaded successfully.";

                try {
                    // Store the duty leave entry in the database
                    $sql = "INSERT INTO duty_leave (RegNo, reason, request_letter, file_name) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$RegNo, $reason, $requestLetter, $newFileName]);
                    $dutyLeaveId = $conn->lastInsertId();

                    // Store the dates and times in the database
                    $sql = "INSERT INTO duty_leave_dates (duty_leave_id, date_time) VALUES (?, ?)";
                    $stmt = $conn->prepare($sql);
                    foreach($dates as $key => $date) {
                        $time = $times[$key];
                        $dateTime = $date . ' ' . $time;
                        $stmt->execute([$dutyLeaveId, $dateTime]);
                    }

                    $success .= "<br>Leave application submitted successfully.";
                } catch(PDOException $e) {
                    $error = "Error: " . $e->getMessage();
                }
            } else {
                $error = "Error uploading file.";
            }
        }

        if(empty($dates)){
            $error = "Please enter at least one date.";
        }
    }
    ?>

    <h2>Apply for Duty Leave</h2>
    <?php if(!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if(isset($_POST['submit']) && empty($error)): ?>
        <div class="success"><?php echo $success; ?></div>
        <a href="studreport.php" class="profile-button">Go back to your profile</a>
    <?php else: ?>
        <form method="POST" enctype="multipart/form-data">
            <label for="RegNo">Register Number:</label>
            <input type="text" id="RegNo" name="RegNo" required>

            <label for="reason">Reason:</label>
            <input type="text" id="reason" name="reason" required>

            <label for="request_letter">Request Letter:</label>
            <textarea id="request_letter" name="request_letter" required></textarea>

            <label for="dates">Dates:</label>
            <div id="date-container">
                <div class="date-container">
                    <input type="date" name="dates[]" required>
                    <input type="time" name="times[]" required>
                    <button type="button" class="date-remove" onclick="removeDateField(this)">Remove</button>
                </div>
            </div>
            <button type="button" onclick="addDateField()">Add Date</button>

            <label for="uploaded_file">Upload Required Documents:</label>
            <input type="file" id="uploaded_file" name="uploaded_file" required>

            <input type="submit" name="submit" value="Submit">
        </form>

        <script>
            function addDateField() {
                var dateContainer = document.getElementById('date-container');
                var newDateField = document.createElement('div');
                newDateField.className = 'date-container';
                newDateField.innerHTML = `
                    <input type="date" name="dates[]" required>
                    <input type="time" name="times[]" required>
                    <button type="button" class="date-remove" onclick="removeDateField(this)">Remove</button>
                `;
                dateContainer.appendChild(newDateField);
            }

            function removeDateField(button) {
                var dateContainer = document.getElementById('date-container');
                var dateField = button.parentNode;
                dateContainer.removeChild(dateField);
            }
        </script>


    <?php endif; ?>
    <?php 
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
  
        if($action === 'submit') {
            // Update the duty leave status as approved
            $sql = "UPDATE duty_leave SET status = '1' WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
  
            echo "Duty leave applied.";}}
            ?>
            
</body>
</html>