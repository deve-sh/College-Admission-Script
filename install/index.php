<?php
session_start();
include '../inc/saltgenerator.php';
include 'installinc.php';
?>
<html>
<head>
	<title>INSTALL THE COLLEGE APPROVAL SYSTEM!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/smallscreen.css" media="screen and (max-width: 1000px)">
	<link rel="stylesheet" type="text/css" href="../css/ultrasmall.css" media="screen and (max-width:600px)">
</head>
<body onload="onload()">
	<main>
<?
	if($y=="1"||$z=="1"||$w!="0"){
        echo "<br><br>The script is already installed! Thanks! <bR><br>";
        echo "<a href='../index.php'>Go to the dashboard</a>";
	}
	else{
      echo "Welcome to the college admission script installation process!";
      echo "<br><br>";
?>
<div align="center">
<form action="installer.php" method="post" id='login'>
<input type="text" name="host" placeholder="Host" required/><br>
<br>
<input type="text" name="username" placeholder="Username" required/><br>
<br>
<input type="password" name="password" placeholder="Password" /><br>
<br>
<input type="text" name="dbname" placeholder="Database Name" required/><br>
<br>
<br>
<label>ADMIN DETAILS</label>
<br>
<br>
<input type="text" name="adusername" placeholder="Username" required/>
<br>
<br>
<input type="password" onkeyup="check1()" onkeydown="check1()" name="adpassword" placeholder="Password" id='password1' required/>
<br>
<br>
<input type="password" name="password2" placeholder="Confirm Password" id='password2' onkeydown="check()" onkeyup="check()" required/>
<br>
<br>
<input type="email" name="email" placeholder="Email" required/>
<br>
<br>
<button type="submit" name="submit" id='submit'>SUBMIT</button>
</form>
</div>
</main>
<?
	}
	fclose($fileone);
	fclose($filetwo);
	fclose($filethree);
	?>
<script type="text/javascript" src='scripts.js'></script>
</body>
</html>
