<?php include 'config1.php'; ?>


<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <h1 class="page-header">Reports</h1>  
    </div>
  </div>

  <div class="row text-center">
    <div class="col-md-12 col-lg-12">
      <form action="attendance.php" method="GET" class="form-inline" data-toggle="validator">
        <div class="form-group ">
          <label for="select" class="control-label">Subject:</label>
          <?php
            $suid = $_SESSION['FacId'];
            $query_subject = "SELECT course.CourseName, course.CourseId FROM course
              INNER JOIN faculty_subject ON faculty_subject.Courseid = course.CourseId
              WHERE faculty_subject.FacId = $suid
              ORDER BY course.CourseName";
            $sub = $conn->query($query_subject);
            $rsub = $sub->fetchAll(PDO::FETCH_ASSOC);
            $subnm = $rsub[0]['CourseName'];
            $subid = $rsub[0]['CourseId'];
            
            echo "<select name='course' class='form-control' required='required'>";
            foreach ($rsub as $row) {
              $selected = isset($_GET['course']) && $_GET['course'] == $row['CourseId'] ? 'selected' : '';
              echo "<option value='". $row['CourseId']."' $selected>".$row['CourseName']."</option>";
            }
            echo "</select><br>";
          ?>
        </div>
        
        <div class="form-group" data-provide="datepicker">
          <label for="select" class="control-label">From:</label>
          <input type="date" name="sdate" class="form-control" value="<?php echo isset($_GET['sdate']) ? $_GET['sdate'] : ''; ?>" required>
        </div>
        
        <div class="form-group" data-provide="datepicker">
          <label for="select" class="control-label">To:</label>
          <input type="date" name="edate" class="form-control" value="<?php echo isset($_GET['edate']) ? $_GET['edate'] : ''; ?>" required>
        </div>
        
        <input type="hidden" name="page" value="reports">
        <button type="submit" class="btn btn-danger" name="submit" style="border-radius:0%;"><i class="glyphicon glyphicon-filter"></i> Filter Student</button>
      </form>
    </div>  
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <p>&nbsp;</p>
      <div class="report-data">
        <?php
          if (isset($_GET['submit']) && !empty($_GET['sdate']) && !empty($_GET['edate']) && ($_GET['edate'] > $_GET['sdate'])) {
            $sdat = $_GET['sdate'];
            $edat = $_GET['edate'];
            $selsub = isset($_GET['course']) ? $_GET['course'] : '';

            $sdate = strtotime($sdat);
            $edate = strtotime($edat);

            if ($edate >= $sdate) {
              $query_student = "SELECT student.sid, CONCAT(student.FName, ' ', LName) AS FullName, student.RegNo
                FROM student
                INNER JOIN student_relation ON student.sid = student_relation.sid
                INNER JOIN course ON student_relation.Branchid = course.CourseId
                WHERE course.CourseId = {$selsub}
                ORDER BY student.sid";
              $stu = $conn->query($query_student);
              $rstu = $stu->fetchAll(PDO::FETCH_ASSOC);

              echo "<table class='table table-striped table-hover reports-table'>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>RegNo</th>";
              echo "<th>Student's Name</th>";
              for ($k = $sdate; $k <= $edate; $k = $k + 86400) {
                $thisDate = date('d-m-Y', $k);
                $weekday = date('l', $k);
                $normalized_weekday = strtolower($weekday);
                if ($normalized_weekday != 'saturday' && $normalized_weekday != 'sunday') {
                  echo "<th>".$thisDate."</th>";
                }
              }
              echo "<th>Present/Total</th>";
              echo "<th>Percentage</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";

              foreach ($rstu as $row) {
                $present = 0;
                $absent = 0;
                $totlec = 0;
                $perc = 0;

                echo "<tr>";
                echo "<td><h6>".$row['RegNo']."</h6></td>";
                echo "<td><h5>".$row['FullName']."</h5></td>";
                $dsid = $row['sid'];

                for ($j = $sdate; $j <= $edate; $j = $j + 86400) {
                  $weekday = date('l', $j);
                  $currentDate = date('Y-m-d', $j);
                  $normalized_weekday = strtolower($weekday);

                  if ($normalized_weekday != 'saturday' && $normalized_weekday != 'sunday') {
                    $sql = "SELECT sid, ispresent FROM attendance
                      WHERE sid = $dsid
                      AND id = $selsub
                      AND date = '$currentDate'
                      AND $suid = FacId";
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

                    if (!empty($result)) {
                      $totlec++;
                      if ($result[0]['ispresent'] == 1) {
                        $present++;
                        echo "<td><span class='text-success'>Present</span></td>";
                      } else {
                        echo "<td><span class='text-danger'>Absent</span></td>";
                        $absent++;
                      }
                    } else {
                      echo "<td><a href='index.php?course={$selsub}&date={$currentDate}'><button type='button' class='btn btn-success btn-sm' style='border-radius:0%'>Take Attendance</button></a></td>";
                    }
                  }
                }

                if ($totlec != 0) {
                  $perc = round(($present * 100) / $totlec, 2);
                } else {
                  $perc = 0;
                }

                echo "<td><strong>".$present."</strong> / ".$totlec."</td>";
                echo "<td>".$perc."&nbsp;%</td>";
                echo "</tr>";
              }

              echo "</tbody>";
              echo "</table>";
            } else {
              echo "<div class='alert alert-dismissible alert-danger'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Error!</strong> Please check the selected dates.
              </div>";
            }
          }
        ?>
      </div>
    </div>
  </div>
</div>
