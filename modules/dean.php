<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal Report</title>
    <style>
        /* CSS styles here */
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-top: 50px;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #666;
        }

        select,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .logout-container {
            text-align: center;
        }

        a.logout {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }

        a.logout:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <?php
    include 'config1.php';
    session_start();

    // Check if the user is authenticated as a dean
    if (!isset($_SESSION['islogin']) || $_SESSION['islogin'] !== "1" || !isset($_SESSION['d_name'])) {
        header("location: ../index.php");
        exit();
    }

    // Retrieve the dean's name from the session
    $d_name = $_SESSION['d_name'];

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dept = $_POST['dept'];
        $year = $_POST['year'];
        $view = $_POST['view'];

        // Check if the selected options meet the criteria
        if ($dept === 'IT' && $year === '3' && $view === 'attendance') {
            // Redirect to hod_attendance_view.php
            header("Location: hod_attendence_view.php");
            exit();
        } 
    }

    ?>

    <h1>Welcome, <?php echo $d_name; ?></h1>

    <div class="container">
        <form method="post">
            <label for="dept">Select Department:</label>
            <select name="dept" id="dept">
                <option value="IT">IT</option>
                <option value="ME">ME</option>
                <option value="CE">CE</option>
                <option value="EEE">EEE</option>
                <option value="EC">EC</option>
            </select>
            <br><br>
            <label for="year">Select Year:</label>
            <select name="year" id="year">
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>
            <br><br>
            <label for="view">View:</label>
            <select name="view" id="view">
                <option value="attendance">View Attendance</option>
            </select>
            <br><br>
            <input type="submit" name="submit" value="Generate Report">
        </form>

        <div class="logout-container">
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>

</body>
</html>

