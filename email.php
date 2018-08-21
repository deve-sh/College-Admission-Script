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
	<title><?echo ucfirst($_SESSION['userr'])." - Change Email"; ?></title>
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
	$email=$user['email'];
?>
<div align="center"><h2>CHANGE EMAIL</h2></div>
<form action="echanged.php" method="post">
<label>Email : </label><input type="text" name="email" value=<? echo $email; ?> maxlength="120" required/>
<br><br>
<button type="submit">CHANGE</button>
<br><br>
<button><a href='profile.php'>CANCEL</a></button>
</form>
<? 
}
?>
</main>
</body>
</html>