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
	<title><?echo ucfirst($_SESSION['userr'])." - Change Username"; ?></title>
	<? include("inc/style.php"); ?>
</head>
<body>
<main>
<?
$username=$_POST['username'];
$userid=$_SESSION['userid'];
if($_SESSION['logh']==false||$_SESSION['userid']==0||$username==""){
	header("refresh:0;url=index.php");
	exit();
}
else{
	$check=mysqli_query($db,"SELECT * FROM colusers WHERE username='$username'");
	if(mysqli_num_rows($check)>0){
		echo "The username is already taken! Kindly try something else!";
		echo "<br><br><button><a href='username.php'>BACK</a></button><br><br>";
		echo "<button><a href='profile.php'>CANCEL</a></button>";
	}
	else{
		$update=mysqli_query($db,"UPDATE colusers SET username='$username' WHERE id='$userid'");
		if($update){
			echo "<br><br>Username successfully changed! Kindly Login Again!";
			$_SESSION['logh']=false;
			$_SESSION['userr']="";
			$_SESSION['userid']=0;
			header("refresh:1;url=login.php");
			exit();
		}
		else{
			echo "<br><br>There was some problem updating the username, kindly try again!";
			echo "<bR><br><button><a href='profile.php'>Profile</a></button>
			<br><br>
			<button><a href='username.php'>Back</a></button><br><br>";
		}
	}
}
?>
</main>
</body>
</html>