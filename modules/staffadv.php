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

        .section {
            margin-bottom: 20px;
        }

        .section-heading {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        .button-request {
            background-color: #4CAF50;
            color: white;
        }

        .button-approved {
            background-color: #2196F3;
            color: white;
        }

        .button-add {
            background-color: #FF9800;
            color: white;
        }

        .button-remove {
            background-color: #F44336;
            color: white;
        }

        .button-view {
            background-color: #9C27B0;
            color: white;
        }

        .button-sem {
            background-color: #673AB7;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Staff Advisors</h2>
        <p>Faculty's Name: [Faculty Name]</p>
        <p>Designation: [Designation]</p>

        <div class="section">
            <div class="section-heading">Section 1: Advisor Actions</div>
            <button class="button button-request">Request</button>
            <button class="button button-approved">Approved</button>
            <button class="button button-add">Add Student</button>
            <button class="button button-remove">Remove Student</button>
        </div>

        <div class="section">
            <div class="section-heading">Section 2: Current Sem Report</div>
            <button class="button button-view">View Student List</button>
            <button class="button button-view">View Attendance</button>
        </div>

        <div class="section">
            <div class="section-heading">Section 3: Semester Reports</div>
            <?php
            $semesters = array('Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7', 'Sem 8');
            foreach ($semesters as $semester) {
                echo '<button class="button button-sem">' . $semester . '</button>';
            }
            ?>
        </div>
    </div>
</body>
</html>
