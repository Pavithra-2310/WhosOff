<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRST YEAR</title>
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
    <h1>Report of 1st year</h1>
<?php
include 'config1.php';



    // Assuming the table name is 'student', adjust it if needed
    $query = "SELECT FName, LName, RegNo FROM student WHERE ayid = 1";
    $result = $conn->query($query);

    // Check if there are any rows returned
    if ($result->rowCount() > 0) {
        echo '<table>';
        echo '<tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Registration Number</th>
              </tr>';

        // Fetch the data and display it
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['FName'] . '</td>';
            echo '<td>' . $row['LName'] . '</td>';
            echo '<td>' . $row['RegNo'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No student data found.</p>';
    }

?>
<form action="logout.php" method="post">
    <button type="submit">Logout</button>
</form>
</body>
</html>
