<?
session_start();
$_SESSION['logh'];
$_SESSION['userr'];
$_SESSION['userid'];
?>
<html>
<head>
	<title>College Admission Portal</title>
	<? include("inc/style.php"); ?>
</head>
<body>
<div id='main'>
<br>
<div class="left" align="center">
	<!--PLACE YOUR LOGO HERE-->
	<img src='logo.png'>
</div>
<div class="right">
<?

//LET'S FIRST CONFIRM IF THE SCRIPT IS INSTALLED OR NOT!

    $x=fopen("install/confirm.txt","r+"); //CONFIRMATION FILE 1

	$y=fread($x,filesize("install/confirm.txt"));

	$u=fopen("confirm1.txt","r+");   //CONFIRMATION FILE 2

	$z=fread($u,filesize("confirm1.txt"));

    $b=fopen("inc/config.php","r+");  //CONFIG FILE

    $c=fread($b,filesize("inc/config.php"));

if($y=="1"||$z=="1"||$c!="0"){
if($_SESSION['logh']==true||$_SESSION['userr']!=""||$_SESSION['userid']!=0){
	echo "You are logged in!";
	header("refresh:1;url=profile.php");
	exit();
}
else{
?>
<div align="center">
<span class='links'><a href='login.php'>Login/Apply</a></span>
<br>
<br>
<br>
<br>
<span class='links'><a href="register.php">Register</a></span>
<br>
<br>
</div>
<?
}
}
else{
	echo "<div style='background: #f4f5f1; padding: 20px;'>";
	echo "<br><br>The script has not yet been installed!";
	echo "<br><br>Kindly install it first!";
	echo "</div>";
}

//NOW CLOSE ALL THE FILES BEING USED

fclose($x);
fclose($u);
fclose($b);
?>
</div>
</div>
<footer></footer>
<script type="text/javascript"></script>
</body>
</html>
