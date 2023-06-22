<?php

include 'config1.php';

if(isset($_POST['submit'])) {
    $dname = $_POST['name'];
    $password = $_POST['pass'];

    if(!empty($dname) && !empty($password)) {
        $stmt = $conn->prepare("SELECT d_id, d_name FROM dean WHERE d_name = ? AND password = ?");
        $stmt->execute(array($dname, $password));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result) > 0) {
            $d_id = $result[0]['d_id'];
            $d_name = $result[0]['d_name'];
            session_start();
            $_SESSION['islogin'] = "1";
            $_SESSION['d_id'] = $d_id;
            $_SESSION['d_name'] = $d_name;
            header("location:../modules/dean.php");
        } else {
            header("location:../index.php?dean=y");
        }
    } else {
        header("location:../index.php?dean=y");
    }
}
?>
