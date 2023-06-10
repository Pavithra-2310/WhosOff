
<?php
    include 'config1.php';
    $FacId = $_SESSION['FacId'];
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <h1 class="page-header">Your Courses and Students</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Courses</h3>
                </div>
                <div class="panel-body">

                    <?php
                        $output = '';

                        $query_subject = "SELECT course.CourseCode, course.CourseId FROM course INNER JOIN faculty_subject ON faculty_subject.CourseId = course.CourseId WHERE faculty_subject.FacId = {$FacId}  ORDER BY course.CourseCode";
                        $sub = $conn->query($query_subject);
                        $rsub = $sub->fetchAll(PDO::FETCH_ASSOC);

                        $noOfSubject = count($rsub);

                        for ($i = 0; $i < $noOfSubject; $i++) {
                            $output .= $rsub[$i]['CourseCode'];
                            $output .= ',&nbsp;';
                        }
                        print $output;
                    ?>

                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Students</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Reg No</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $outputData = '';
                                $studentQuery = "SELECT DISTINCT student.RegNo, CONCAT(student.FName, ' ', student.LName) AS FullName
                                FROM student
                                INNER JOIN student_relation ON student.sid = student_relation.sid
                                INNER JOIN branch ON branch.Branchid = student_relation.Branchid
                                INNER JOIN course ON course.BranchId = branch.Branchid
                                INNER JOIN faculty_subject ON faculty_subject.CourseId = course.CourseId
                                WHERE faculty_subject.FacId = $FacId";

                $stmtStudent = $conn->prepare($studentQuery);
                $stmtStudent->execute();
                $resultStudent = $stmtStudent->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultStudent as $row) {
                    $outputData .= "<tr>";
                    $outputData .= "<td>" . $row['RegNo'] . "</td>";
                    $studname = $row['FullName'];
                    $outputData .= "<td>" . $studname . "</td>";
                    $outputData .= "</tr>";
                }

                print $outputData;

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
