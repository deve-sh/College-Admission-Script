<?
session_start();
include("inc/config.php");
$_SESSION['logh'];
$_SESSION['userr'];
$_SESSION['userid'];
?>
<html>
<head>
	<title>Log In</title>
<? include("inc/style.php"); ?>
</head>
<body style='background: #434343;'>
<main align='center' style='background: #434343;'> 
<? 
if($_SESSION['logh']!=true||$_SESSION['userr']==""||$_SESSION['userid']==0){
?>
<form action="loggedin.php" method="post" align='center' id='login'>
	<h1>Login</h1>
	<input type="text" name="username" placeholder="Username or Email" required/>
	<br><br>
	<input type="password" name="password" placeholder='Password' required/>
	<br><br>
	<button type="submit">SUBMIT</button>
</form>
<br>
<Br>
<button><a href='index.php'>Home</a></button>
<?
}
else{
	echo "<span style='color:#ffffff'><br><br>You are already signed in!</span>";
	header("refresh:1;url=profile.php");
	exit();
}
?>
<Br>
</main>
</body>
</html>