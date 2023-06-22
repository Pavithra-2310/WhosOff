<!DOCTYPE html>
<html>
<head>
    <title>Staff Advisors Page</title>
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
    <h2>Staff Advisor's Page</h2>
    <?php
    include 'config1.php';

    session_start();
    $FacultyName = $_SESSION['FacultyName'];

    try {
        // Fetch the branch ID for the staff advisor
        $stmt = $conn->prepare("SELECT student_relation.Branchid FROM student_relation INNER JOIN student ON student.sid = student_relation.sid INNER JOIN staff_adv ON staff_adv.Branchid = student_relation.Branchid INNER JOIN faculty ON staff_adv.FacId = faculty.FacId WHERE faculty.FacultyName = :FacultyName");
        $stmt->bindParam(':FacultyName', $FacultyName, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retrieve the branch ID
        $branchIds = $result['Branchid'];

        // Perform further actions with the retrieved branch ID

    } catch (PDOException $e) {
        // Handle any errors that occurred during the database query
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
    ?>

    <p>Faculty's Name: <?php echo $FacultyName; ?></p>

    <p>Designation: Staff Advisor</p>

    <div class="sections-container">
        <div class="section">
            <button id="request-button" class="button button-request">Request</button>
            <button class="button button-approved">Approved</button>
            <button class="button button-add">Add Student</button>
            <button class="button button-remove">Remove Student</button>
        </div>

        <div class="section">
            <div class="section-heading"><center>Current Sem Report</center></div>
            <button class="button button-view">View Student List</button>
            <button class="button button-view">View Attendance</button>
        </div>

        <div class="section">
            <?php
            $semesters = array('Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7', 'Sem 8');
            foreach ($semesters as $semester) {
                echo '<button class="button button-sem">' . $semester . '</button>';
            }
            ?>
        </div>
    </div>
</div>
</body>

   <script>
        function handleRequestButtonClick() {
            // Create a space to display the request list
            var requestList = document.createElement("div");
            requestList.id = "request-list";

            // Make an AJAX request to fetch the list of students who applied for duty leave
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "dutyleavereqlist.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var students = JSON.parse(xhr.responseText);

                    var matchingStudents = students.RegNos.filter(function (RegNo, index) {
                        return students.BranchIds[index] === <?php echo json_encode($branchIds); ?>;
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
        function handleStudentButtonClick(RegNo,id) {
            // Redirect to the duty leave approval page with the selected student's RegNo
           window.location.href = "dutyleave_approval.php?RegNo=" + encodeURIComponent(RegNo) + "&id=" + encodeURIComponent(id);
        }

        document.addEventListener("DOMContentLoaded", function () {
            var requestButton = document.getElementById("request-button");
            requestButton.addEventListener("click", handleRequestButtonClick);
        });
    </script>

</html>
