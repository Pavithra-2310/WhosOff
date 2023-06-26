


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

        .container {
            display: flex;
        }

        .container .left {
            width: 60%;
        }

        .container .right {
            width: 35%;
            position: fixed;
            top: 100px;
            right: 20px;
            margin-top: 20px; /* Added margin */
        }

        .container .right .file-upload {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container .right .file-upload label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }

        .container .right .file-upload input[type="file"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .container .right .file-upload input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .container .right .file-upload input[type="submit"]:hover {
            background-color: #45a049;
        }

        .container .left form {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container .left label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }

        .container .left input[type="text"],
        .container .left input[type="password"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 200px;
        }

        .container .left input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .container .left input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Add Student</h2>

    <div class="container">
        <div class="left">
            <form method="POST" action="">
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
        </div>

        <div class="right">
            <div class="file-upload">
                <form method="POST" action="" enctype="multipart/form-data">
                    <label for="excelFile">Upload Excel File:</label>
                    <input type="file" name="excelFile" accept=".xlsx, .xls"><br><br>
                    <input type="submit" value="Import Data">
                </form>
            </div>
        </div>
    </div>
</body>
</html>




