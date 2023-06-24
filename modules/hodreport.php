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
    </style>
</head>
<body>
    <div class="container">
        <h2>HOD Page</h2>
 

        <div class="sections-container">
            <div class="section">
                <button id="duty-leave-button" class="button">Duty Leave Requests</button>
            </div>

            <div class="section">
                <div class="section-heading"><center>View Attendance</center></div>
                <button class="button">1st Year</button>
                <button class="button">2nd Year</button>
                <button class="button">3rd Year</button>
                <button class="button">4th Year</button>
            </div>
        </div>
    </div>

    <script>
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
</body>
</html>
