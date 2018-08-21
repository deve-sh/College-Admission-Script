<?
session_start();
$_SESSION['userr'];
$_SESSION['logh'];
$_SESSION['userid'];
include("inc/config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><?echo ucfirst($_SESSION['userr'])." - Change Password"; ?></title>
	<? include("inc/style.php"); ?>
</head>
<body>
<main>
<?
if($_SESSION['logh']==false||$_SESSION['userid']==0){
	echo "Kindly Login first!";
	header("refresh:1;url=login.php");
	exit();
}
else{
	$userid=$_SESSION['userid'];
	$query=mysqli_query($db,"SELECT * FROM colusers WHERE id='$userid'");
	$user=mysqli_fetch_assoc($query);
	$password=$user['password'];
?>
<div align="center"><h2>CHANGE password</h2></div>
<form action="pchanged.php" method="post">
<label>New Password : </label><br><input type="password" name="password" maxlength="120" id='password' required/> &nbsp&nbsp<span onclick='show()'>Make Visible</span>
<br><br>
<button type="submit">CHANGE</button>
<br><br>
<button><a href='profile.php'>CANCEL</a></button>
</form>
<? 
}
?>
</main>
<script type='text/javascript' src='show.js'></script>
</body>
</html>