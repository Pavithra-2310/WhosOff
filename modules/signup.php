<!DOCTYPE html>
<html>
<head>
	<title>sign up</title>
	<style>nav {
            background-color: #333;
            color: #fff;
            float:right;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            
        }

        nav ul li a {
            display: block;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
        }

        nav ul li a:hover {
            background-color: #555;
        }</style>
</head>
<body>
<form action="post">
<center>
<table border="2" >
<tr>
<td colspan="3">
<?php 
include 'nav.php';
include 'config1.php';
	if(isset($_GET['msg']))
		echo "<center><h3>".$_GET['msg']."</h3></center>";
	elseif(isset($_GET['msg1']))
		echo "<center><h3>".$_GET['msg1']."</h3></center>";	
	else
		echo "<center><h3>Sign Up Here!!! </h3></center>";
?> </td></tr>
<tr><td><b>UserName</b></td><td colspan="2"><input type="name" name="name" ></td>
</tr>
<tr> </tr>
<tr><td><b>PassWord</b></td><td colspan="2"><input type="password" name="pass" ></td>
</tr>
<tr><td colspan="3">Renter PassWord</td></tr>
<tr><td><b>RePassWord</b></td><td colspan="2"><input type="password" name="repass" ></td>
</tr>

<tr><td>Enter subject</td><td colspan="2"><select name="subject">
	<option value="aad">AAD</option>
	<option value="micro">Microprocessors</option>
	<option value="in">INTERNETWORKING WITH TCP/IP</option>

<tr><td><input type="submit" name="submit" value="SUBMIT"></td><td ></td><td ><input type="reset" name="reset"></td></tr>

</table>
</center>
</form>

<?php
try{

	
	if(isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['repass']) && isset($_POST['course']))
	{
		
		$u=$_POST['uname'];
		$p=$_POST['pwd'];
		$rp=$_POST['repass'];
		$sub=$_POST['course'];

		if($p === $rp)
		{
			$sql="insert into teachers  (
			name VARCHAR(6) NOT NULL, 
		   	password VARCHAR(30) NOT NULL,
		   	subject VARCHAR(20) NOT NULL,
	
			) values ($u, $p, $sub)";
		$query=$dbhandler->query($sql);
		}
		else{
				header("location:index.php?msg=PASSWORD NOT MATCH");	
		}

	}
}
catch(PDOException $e){
		echo $e->getMessage();
		die();
}

?>

</body>
</html>