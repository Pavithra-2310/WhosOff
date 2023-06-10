<?php

     include 'config1.php';
     if(isset($_POST['submit']))
     {


        $pass=$_POST['pass'];
	$rn=$_POST['RegNo'];


if( isset($rn) && isset($pass)){
 if(!empty($rn) && !empty($pass) ){

 $strn = $conn->prepare("SELECT sid, RegNo FROM student WHERE RegNo= ? AND password=?");
            $strn->execute(array($rn,$pass));
$result = $strn->fetchAll(PDO::FETCH_ASSOC);
              // print_r($result);
            if(count($result))
            {

            $sid = $result[0]['sid'];
						$RegNo = $result[0]['RegNo'];
						session_start();
            // Use $HTTP_SESSION_VARS with PHP 4.0.6 or less

                $_SESSION['islogin'] ="1";
								$_SESSION['sid'] = $sid;
								$_SESSION['RegNo'] = $RegNo;

							header("location:../modules/studreport.php");




}else
            {
               header("location:../index.php?invalid=y");
            }


}

else
          {
             header("location:../index.php?invalid=y");
          }
        }
      }

?>
