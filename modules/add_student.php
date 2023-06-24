<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }

        input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 200px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Add Student</h2>

    <form method="POST" action="add_student_process.php">
        <label for="sid">SID:</label>
        <input type="text" name="sid" required><br><br>

        <label for="FName">First Name:</label>
        <input type="text" name="FName" required><br><br>

        <label for="LName">Last Name:</label>
        <input type="text" name="LName" required><br><br>

        <label for="AdmnNo">Admission Number:</label>
        <input type="text" name="AdmnNo" required><br><br>

        <label for="Gender">Gender:</label>
        <input type="text" name="Gender" required><br><br>

        <label for="DOB">Date of Birth:</label>
        <input type="text" name="DOB" required><br><br>

        <label for="PhoneNo">Phone Number:</label>
        <input type="text" name="PhoneNo" required><br><br>

        <label for="ParentNo">Parent's Number:</label>
        <input type="text" name="ParentNo" required><br><br>

        <label for="EmailId">Email ID:</label>
        <input type="text" name="EmailId" required><br><br>

        <label for="RegNo">Registration Number:</label>
        <input type="text" name="RegNo" required><br><br>

        <label for="AyId">Academic Year ID:</label>
        <input type="text" name="AyId" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Add Student">
    </form>
</body>
<form action="logout.php" method="post">
    <button type="submit">Logout</button>
</form>
</html>

