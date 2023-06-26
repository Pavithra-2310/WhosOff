<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal Report</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }

    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }

    form {
        margin: 0 auto;
        max-width: 400px;
        padding: 30px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #333;
    }

    select, input[type="submit"] {
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 20px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    a.logout {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #666;
        text-decoration: none;
    }

    a.logout:hover {
        text-decoration: underline;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #f44336;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: block;
        margin: 20px auto 0;
    }

    button[type="submit"]:hover {
        background-color: #d32f2f;
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
    session_start();
    include 'nav.php';
    

    // Check if the user is authenticated as a principal
    if (!isset($_SESSION['islogin']) || $_SESSION['islogin'] !== "1" || !isset($_SESSION['p_name'])) {
        header("location: ../index.php");
        exit();
    }

    // Retrieve the principal's name from the session
    $p_name = $_SESSION['p_name'];

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dept = $_POST['dept'];
        $year = $_POST['year'];
        $view = $_POST['view'];

        if ($view === 'leave') {
            echo '<script>handleRequestButtonClick();</script>';
        }
    }
    ?>

    <h1>Welcome, <?php echo $p_name; ?></h1>

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
            <option value="leave">View Leave Requests</option>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Generate Report">
    </form>

   

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        function handleRequestButtonClick() {
            // Create a space to display the request list
            var requestList = document.createElement("div");
            requestList.id = "request-list";

            // Make an AJAX request to fetch the list of students who applied for duty leave
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "leavefinal.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);

                    if (Array.isArray(response.RegNos)) {
                        response.RegNos.forEach(function (RegNo, index) {
                            var studentButton = document.createElement("button");
                            studentButton.className = "button button-student";
                            studentButton.innerHTML = RegNo;
                            studentButton.onclick = function () {
                                handleStudentButtonClick(RegNo, response.DutyLeaveIds[index]);
                            };
                            requestList.appendChild(studentButton);
                        });

                        // Append the request list to the document body
                        document.body.appendChild(requestList);
                    } else {
                        console.error("Invalid response from leavefinal.php");
                    }
                }
            };
            xhr.send();
        }

        function handleStudentButtonClick(RegNo, dutyLeaveId) {
            // Redirect to the duty leave approval page with the selected student's TRV ID
            window.location.href = "approvallast.php?regNo=" + encodeURIComponent(RegNo) + "&dutyLeaveId=" + encodeURIComponent(dutyLeaveId);
        }
        function handleAttendanceClick(){
            window.location.href = 'hod_attendence_view.php';
        }

        // Get the form element
        var reportForm = document.querySelector('form');

        // Attach a submit event listener to the form
        reportForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            var view = document.getElementById('view').value;

            if (view === 'leave') {
                handleRequestButtonClick();
            }
            else if(view==='attendance'){
                handleAttendanceClick();
            }

            // Perform any other desired actions or form validation here

            // Submit the form
            reportForm.submit();
        });
    });
</script>

</body>
</html>
