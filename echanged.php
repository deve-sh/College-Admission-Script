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
$email=$_POST['email'];
$userid=$_SESSION['userid'];
if($_SESSION['logh']==false||$_SESSION['userid']==0||$email==""){
	header("refresh:0;url=index.php");
	exit();
}
else{
	$check=mysqli_query($db,"SELECT * FROM colusers WHERE email='$email'");
	if(mysqli_num_rows($check)>0){
		echo "The email is already registered! Kindly try something else!";
		echo "<br><br><button><a href='email.php'>BACK</a></button><br><br>";
		echo "<button><a href='profile.php'>CANCEL</a></button>";
	}
	else{
		$update=mysqli_query($db,"UPDATE colusers SET email='$email' WHERE id='$userid'");
		if($update){
			echo "<br><br>email successfully changed! Kindly Login Again!";
			$_SESSION['logh']=false;
			$_SESSION['userr']="";
			$_SESSION['userid']=0;
			header("refresh:1;url=login.php");
			exit();
		}
		else{
			echo "<br><br>There was some problem updating the email, kindly try again!";
			echo "<bR><br><button><a href='profile.php'>Profile</a></button>
			<br><br>
			<button><a href='email.php'>Back</a></button><br><br>";
		}
	}
}
?>
</main>
</body>
</html>