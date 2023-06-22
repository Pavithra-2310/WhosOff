<?php

include 'config1.php';

if(isset($_POST['submit'])) {
    $hname = $_POST['name'];
    $password = $_POST['pass'];

    if(!empty($hname) && !empty($password)) {
        $stmt = $conn->prepare("SELECT p_id, p_name FROM principal_login WHERE p_name = ? AND password = ?");
        $stmt->execute(array($hname, $password));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result) > 0) {
            $p_id = $result[0]['p_id'];
            $p_name = $result[0]['p_name'];
            session_start();
            $_SESSION['islogin'] = "1";
            $_SESSION['p_id'] = $p_id;
            $_SESSION['p_name'] = $p_name;
            header("location:../modules/principalreport.php");
        } else {
            header("location:../index.php?principal=y");
        }
    } else {
        header("location:../index.php?principal=y");
    }
}
?>
