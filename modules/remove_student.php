<!DOCTYPE html>
<html>
<head>
    <title>Remove Student</title>
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
            background-color: #e60000;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #b30000;
        }
    </style>
</head>
<body>
    <h2>Remove Student</h2>

    <form method="POST" action="remove_student_process.php">
        <label for="student_id">REG NUMBER:</label>
        <input type="text" name="student_id" required><br><br>

        <input type="submit" value="Remove Student">
    </form>
    <form action="logout.php" method="post">
    <button type="submit">Logout</button>
</form>
</body>
</html>
