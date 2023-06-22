<?php

include 'config1.php';

if(isset($_POST['submit'])) {
    $hname = $_POST['name'];
    $password = $_POST['pass'];

    if(!empty($hname) && !empty($password)) {
        $stmt = $conn->prepare("SELECT h_id, h_name FROM hod WHERE h_name = ? AND password = ?");
        $stmt->execute(array($hname, $password));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result) > 0) {
            $h_id = $result[0]['h_id'];
            $h_name = $result[0]['h_name'];
            session_start();
            $_SESSION['islogin'] = "1";
            $_SESSION['h_id'] = $h_id;
            $_SESSION['h_name'] = $h_name;
            header("location:../modules/hodreport.php");
        } else {
            header("location:../index.php?hod=y");
        }
    } else {
        header("location:../index.php?hod=y");
    }
}
?>
