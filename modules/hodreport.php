<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .column {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
        }

        h2 {
            margin-bottom: 10px;
        }

        button {
            margin: 5px;
            padding: 12px 24px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>REPORT</h1>

    <form>
        <div class="column">
            <h2>Leave requests</h2>
            <button type="submit" name="session" value="leave_requests">Medical Leave Requests</button>
            <button type="submit" name="session" value="leave_requests">Duty Leave Requests</button>
        </div>

        <div class="column">
            <h2>View Attendance</h2>
            <a href="hod_attendence_view.php">
                <button type="button" name="year" value="1">1st Year</button>
            </a>
            <button type="submit" name="year" value="2">2nd Year</button>
            <button type="submit" name="year" value="3">3rd Year</button>
            <button type="submit" name="year" value="4">4th Year</button>
        </div>
    </form>
</body>
</html>


