<?php
    session_start();
    session_destroy();
    header("location: /StudentAttendanceMgSystem/index.php");
    exit();
?>
