<!DOCTYPE html>
<html>
<head>
    <title>HOD Page</title>
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

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>HOD Page</h2>
        <div class="sections-container">
            <div class="section">
                <button id="duty-leave-button" class="button">Duty Leave Requests</button>
                <button class="button button-approved">Approved</button>
            </div>
            <div class="section">
                <div class="section-heading">View Attendance</div>
                <button class="button" onclick="loadAttendance(1, [1, 2])">1st Year</button>
                <button class="button" onclick="loadAttendance(2, [3, 4])">2nd Year</button>
                <button class="button" onclick="loadAttendance(3, [5, 6])">3rd Year</button>
                <button class="button" onclick="loadAttendance(4, [7, 8])">4th Year</button>
            </div>
        </div>
        <div id="attendance-container"></div>
    </div>

    <script>
        function loadAttendance(year, semesters) {
            var attendanceContainer = document.getElementById("attendance-container");
            attendanceContainer.innerHTML = ""; // Clear previous content

            var table = document.createElement("table");

            // Create table headers
            var thead = document.createElement("thead");
            var headerRow = document.createElement("tr");
            var headers = ["Student Name", "Register Number"];
            semesters.forEach(function (semester) {
                headers.push("Semester " + semester + " Attendance (%)");
            });
            headers.forEach(function (header) {
                var th = document.createElement("th");
                th.textContent = header;
                headerRow.appendChild(th);
            });
            thead.appendChild(headerRow);
            table.appendChild(thead);

            // Fetch and populate attendance data from the server
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch_attendance.php?year=" + year + "&semesters=" + semesters.join(","), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var students = JSON.parse(xhr.responseText);

                    students.forEach(function (student) {
                        var row = document.createElement("tr");
                        var nameCell = document.createElement("td");
                        var regNoCell = document.createElement("td");
                        var attendanceCells = [];

                        nameCell.textContent = student.name;
                        regNoCell.textContent = student.regNo;

                        semesters.forEach(function (semester) {
                            var attendanceCell = document.createElement("td");
                            attendanceCell.textContent = student.attendance[semester] + "%";
                            attendanceCells.push(attendanceCell);
                        });

                        row.appendChild(nameCell);
                        row.appendChild(regNoCell);
                        attendanceCells.forEach(function (cell) {
                            row.appendChild(cell);
                        });

                        table.appendChild(row);
                    });

                    attendanceContainer.appendChild(table);
                }
            };
            xhr.send();
        }

        function handleDutyLeaveButtonClick() {
            // Create a space to display the request list
            var requestList = document.createElement("div");
            requestList.id = "request-list";

            // Make an AJAX request to fetch the list of students with approved duty leave
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "leave_details.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var students = JSON.parse(xhr.responseText);

                    var matchingStudents = students.RegNos.filter(function (RegNo, index) {
                        return students.BranchIds[index] === 1;
                    });

                    matchingStudents.forEach(function (RegNo, index) {
                        var studentButton = document.createElement("button");
                        studentButton.className = "button button-student";
                        studentButton.innerHTML = RegNo;
                        studentButton.onclick = function () {
                            handleStudentButtonClick(RegNo, students.DutyLeaveIds[index]);
                        };
                        requestList.appendChild(studentButton);
                    });

                    // Append the request list to the document body
                    document.body.appendChild(requestList);
                }
            };
            xhr.send();
        }

        function handleStudentButtonClick(regNo, dutyLeaveId) {
            // Redirect to the duty leave approval page with the selected student's regNo and dutyLeaveId
            window.location.href = "approval-hod.php?regNo=" + encodeURIComponent(regNo) + "&dutyLeaveId=" + encodeURIComponent(dutyLeaveId);
        }

        document.addEventListener("DOMContentLoaded", function () {
            var dutyLeaveButton = document.getElementById("duty-leave-button");
            dutyLeaveButton.addEventListener("click", handleDutyLeaveButtonClick);
        });
    </script>
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
