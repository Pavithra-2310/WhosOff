<?php
include 'config1.php';
$updateFlag = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['sbt_top']) || isset($_POST['sbt_bottom'])) {
        if (isset($_GET['date']) && isset($_GET['course']) && isset($_GET['FacId']) && isset($_POST['hour'])) {
            $date = $_GET['date'];
            $course = $_GET['course'];
            $attendance = $_POST['attendance'];
            $FacId = $_GET['FacId'];
            $hour = $_POST['hour'];

            // Delete existing attendance records for the selected date and course
            $deleteQuery = "DELETE FROM attendance WHERE date = :date AND CourseId = :course";
            $stmtDelete = $conn->prepare($deleteQuery);
            $stmtDelete->bindParam(':date', $date, PDO::PARAM_STR);
            $stmtDelete->bindParam(':course', $course, PDO::PARAM_INT);
            $stmtDelete->execute();

            // Insert new attendance records
            $insertQuery = "INSERT INTO attendance (sid, date, CourseId, ispresent, hour, FacId) VALUES (:sid, :date, :course, :ispresent, :hour, :FacId)";
            $stmtInsert = $conn->prepare($insertQuery);
            $stmtInsert->bindParam(':sid', $sid, PDO::PARAM_INT);
            $stmtInsert->bindParam(':date', $date, PDO::PARAM_STR);
            $stmtInsert->bindParam(':course', $course, PDO::PARAM_INT);
            $stmtInsert->bindParam(':ispresent', $ispresent, PDO::PARAM_INT);
            $stmtInsert->bindParam(':hour', $hour, PDO::PARAM_INT);
            $stmtInsert->bindParam(':FacId', $FacId, PDO::PARAM_INT);

            try {
                $conn->beginTransaction();

                foreach ($attendance as $sid) {
                    $ispresent = 1;
                    $stmtInsert->execute();
                }

                $conn->commit();

                // Redirect to the same page after saving attendance
                header("Location: index.php?date=$date&course=$course");
                exit;
            } catch (PDOException $e) {
                $conn->rollback();
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Management System</title>
    <!-- Add your CSS and JS files here -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <h1 class="page-header">Take Attendance</h1>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12 col-lg-12">
                <form action="index.php" method="get" class="form-inline" id="subjectForm" data-toggle="validator">

<div class="form-group">
					<label for="select" class="control-label">course:</label>
					<?php

          $query_subject = "SELECT course.CourseCode, course.CourseId
                      FROM course
                      INNER JOIN faculty_subject ON faculty_subject.CourseId = course.CourseId
                      WHERE faculty_subject.FacId = {$_SESSION['FacId']}
                      ORDER BY course.CourseCode";


						$sub=$conn->query($query_subject);
						$rsub=$sub->fetchAll(PDO::FETCH_ASSOC);
						echo "<select name='course' class='form-control' required='required'>";
						for($i = 0; $i<count($rsub); $i++)
						{
							if ($_GET['course'] == $rsub[$i]['CourseId']) {
								echo"<option value='". $rsub[$i]['CourseId']."' selected='selected'>".$rsub[$i]['CourseCode']."</option>";
							}
							else {
								echo"<option value='". $rsub[$i]['CourseId']."'>".$rsub[$i]['CourseCode']."</option>";
							}
						}
						echo"</select>";
					?>
				</div>

				<div class="form-group" data-provide="datepicker">
					<label for="select" class="control-label">Date:</label>
					<input type="date" class="form-control" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>" required>
				</div>
                    <!-- Add an input field for hour -->
                    <input type="text" name="hour" placeholder="Enter Hour" required>

                    <button type="submit" class="btn btn-danger" style='border-radius:0%;' name="sbt_stn"><i class="glyphicon glyphicon-filter"></i> Load</button>
                </form>

                <?php if (isset($_GET['date']) && isset($_GET['course'])) : ?>

                    <?php
                    $todayTime = time();
                    $submittedDate = strtotime($_GET['date']);
                    if ($submittedDate <= $todayTime) :
                    ?>
                        <form action="index.php" method="post">

                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">RegNo</th>
                                        <th class="text-center">Student's Name</th>
                                        <th class="text-center"><input type="checkbox" class="chk-head" /> All Present</th>
                                    </tr>
                                </thead>

                                <?php
                                $date = $_GET['date'];
                                $course = $_GET['course'];
                                $query_attendance = "SELECT student.sid, CONCAT(student.FName, ' ', student.LName) AS FullName, student.RegNo, attendance.attid, attendance.ispresent
                                    FROM student
                                    INNER JOIN student_relation ON student.sid = student_relation.sid
                                    INNER JOIN course ON student_relation.Branchid = course.BranchId
                                    LEFT JOIN attendance ON student.sid = attendance.sid AND attendance.date = :date AND attendance.CourseId = :course
                                    WHERE course.CourseId = :course
                                    ORDER BY student.sid";
                                $stmt_attendance = $conn->prepare($query_attendance);
                                $stmt_attendance->bindParam(':date', $date, PDO::PARAM_STR);
                                $stmt_attendance->bindParam(':course', $course, PDO::PARAM_INT);
                                $stmt_attendance->execute();
                                $rstu = $stmt_attendance->fetchAll(PDO::FETCH_ASSOC);

                                if ($stmt_attendance->rowCount() > 0) {
                                    foreach ($rstu as $i => $stu) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $stu['RegNo']; ?></td>
                                            <td class="text-center"><?php echo $stu['FullName']; ?></td>
                                            <td class="text-center"><input type="checkbox" class="chk-box" name="attendance[]" value="<?php echo $stu['sid']; ?>" <?php if ($stu['ispresent'] == 1) echo 'checked'; ?> /></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="3" class="text-center">No students found for this course.</td></tr>';
                                }
                                ?>

                            </table>

                            <div class="margin-top-bottom-medium">
                                <button type="submit" class="btn btn-success btn-block" style='border-radius:0%;' name="sbt_bottom"><i class="glyphicon glyphicon-ok-sign"></i> Save Attendance</button>
                            </div>

                        </form>
                    <?php else : ?>
                        <div class="alert alert-danger text-center">You cannot take attendance for a future date.</div>
                    <?php endif; ?>

                <?php endif; ?>

            </div>
        </div>
    </div>
    <!-- Add your CSS and JS files here -->
<script>
  // JavaScript code for "All Present" checkbox behavior
  window.addEventListener('DOMContentLoaded', function() {
    var chkHead = document.querySelector('.chk-head');
    var chkBoxes = document.querySelectorAll('.chk-box');

    chkHead.addEventListener('change', function() {
      for (var i = 0; i < chkBoxes.length; i++) {
        chkBoxes[i].checked = this.checked;
      }
    });

    for (var i = 0; i < chkBoxes.length; i++) {
      chkBoxes[i].addEventListener('change', function() {
        var isAllChecked = true;
        for (var j = 0; j < chkBoxes.length; j++) {
          if (!chkBoxes[j].checked) {
            isAllChecked = false;
            break;
          }
        }
        chkHead.checked = isAllChecked;
      });
    }
  });
</script>


</body>
</html>
