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
$password=$_POST['password'];
$userid=$_SESSION['userid'];
if($_SESSION['logh']==false||$_SESSION['userid']==0||$password==""){
	header("refresh:0;url=index.php");
	exit();
}
else{
	$password=crypt($password,$salt); //ENCRYPTION OF PASSWORD
    $password=md5($password);
	$check=mysqli_query($db,"SELECT * FROM colusers WHERE password='$password' AND id='$userid'");
	if(mysqli_num_rows($check)>0){
		echo "The password is already being used! Kindly try something else!";
		echo "<br><br><button><a href='password.php'>BACK</a></button><br><br>";
		echo "<button><a href='profile.php'>CANCEL</a></button>";
	}
	else{
		$update=mysqli_query($db,"UPDATE colusers SET password='$password',salt='$salt' WHERE id='$userid'");
		if($update){
			echo "<br><br>Password successfully changed! Kindly Login Again!";
			$_SESSION['logh']=false;
			$_SESSION['userr']="";
			$_SESSION['userid']=0;
			header("refresh:1;url=login.php");
			exit();
		}
		else{
			echo "<br><br>There was some problem updating the password, kindly try again!";
			echo "<bR><br><button><a href='profile.php'>Profile</a></button>
			<br><br>
			<button><a href='password.php'>Back</a></button><br><br>";
		}
	}
}
?>
</main>
</body>
</html>