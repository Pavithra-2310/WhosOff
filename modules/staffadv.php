<!DOCTYPE html>
<html>
<head>
    <title>Staff Advisors Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 20px;
        }

        .sections-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .section {
            margin-bottom: 20px;
            flex: 1 1 30%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .section-heading {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .button {
            display: block;
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
            background-color: #2196F3;
            color: white;
        }

        .button-sem {
            width: 200px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Staff Advisor's Page</h2>

        <?php
        include 'config1.php'; // Include your database connection file

        // Fetch faculty's name from the database
        try {
          session_start();
            $FacultyName = $_SESSION['FacultyName'];

            $stmt = $conn->query("SELECT FacultyName FROM faculty where faculty.FacultyName={$FacultyName}");
            $FacultyName = $stmt->fetchColumn();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        ?>

        <p>Faculty's Name: <?php echo $FacultyName; ?></p>
        <p>Designation: Staff Advisor</p>

        <div class="sections-container">
            <div class="section">
                <button class="button button-request">Request</button>
                <button class="button button-approved">Approved</button>
                <button class="button button-add">Add Student</button>
                <button class="button button-remove">Remove Student</button>
            </div>

            <div class="section">
                <div class="section-heading"><center> Current Sem Report</center></div>
                <button class="button button-view">View Student List</button>
                <button class="button button-view">View Attendance</button>
            </div>

            <div class="section">
                <?php
                $semesters = array('Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7', 'Sem 8');
                foreach ($semesters as $semester) {
                    echo '<button class="button button-sem">' . $semester . '</button>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
