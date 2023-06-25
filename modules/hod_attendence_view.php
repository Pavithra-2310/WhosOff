<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THIRD YEAR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f1f1f1;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td:first-child {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Report of 3rd year</h1>
    <?php
include 'config1.php';

try {
    $conn = new PDO('mysql:host=' . $databaseHost . ';dbname=' . $databaseName . '', $databaseUsername, $databasePassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the list of course names
    $courseQuery = "SELECT DISTINCT CourseName FROM course";
    $courseResult = $conn->query($courseQuery);
    $courses = $courseResult->fetchAll(PDO::FETCH_COLUMN);

    // Generate the dynamic SQL query
    $query = "SELECT s.FName, s.LName, s.RegNo";
    foreach ($courses as $course) {
        $query .= ", IFNULL((SELECT sum(a.ispresent) FROM attendance a WHERE a.sid = s.sid AND a.CourseId IN (SELECT CourseId FROM course WHERE CourseName = '$course')) / (SELECT COUNT(*) FROM attendance a WHERE a.sid = s.sid AND a.CourseId IN (SELECT CourseId FROM course WHERE CourseName = '$course')) * 100, 'No classes taken') AS `$course`";
    }
    $query .= " FROM student s 
    INNER JOIN student_relation sr ON s.sid = sr.sid 
    WHERE sr.Branchid = 1";

    $result = $conn->query($query);

    // Check if there are any rows returned
    if ($result->rowCount() > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '<th>Registration Number</th>';
        foreach ($courses as $course) {
            echo "<th>$course</th>";
        }
        echo '</tr>';

        // Fetch the data and display it
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['FName'] . '</td>';
            echo '<td>' . $row['LName'] . '</td>';
            echo '<td>' . $row['RegNo'] . '</td>';
            foreach ($courses as $course) {
                echo '<td>' . $row[$course] . '</td>';
            }
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No student data found.</p>';
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
