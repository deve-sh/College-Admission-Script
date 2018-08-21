<?
session_start();
$_SESSION['logh'];
$_SESSION['userr'];
$_SESSION['userid'];
$_SESSION['pageid'];
include("inc/config.php");
$appid=$_GET['appid'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Approve</title>
	<? include "inc/style.php"; ?>
</head>
<body>
<main align='center'>
<?
if($_SESSION['userid']==0||$_SESSION['logh']==false||$_SESSION['userr']==""){
  header("refresh:0;url=login.php");
  exit();
}
else{
$userid=$_SESSION['userid'];
$check=mysqli_query($db,"SELECT * FROM colusers WHERE id='$userid'");
$user=mysqli_fetch_assoc($check);
if($user['isadmin']==1){
if($appid==""){
	header("refresh:0;url=index.php");
	exit();
}
else{
  $ret=mysqli_query($db,"SELECT * FROM applications WHERE appid='$appid'");
  if(mysqli_num_rows($ret)==1){
  	$app=mysqli_fetch_assoc($ret);
    if($app['approved']==1||$app['declined']==2){
      echo "Already Approved/Declined!";
    }
    else{
  	$update=mysqli_query($db,"UPDATE applications SET approved=1 WHERE appid='$appid'");
  	if($update){
  		echo "<br><br>Application Approved Successfully!";
  		if($_SESSION['pageid']==1){
  			$_SESSION['pageid']=0;
  			header("refresh:1;url=all.php");
  			exit();
  		}
  		else{
  			$_SESSION['pageid']=0;
  			header("refresh:1;url=pending.php");
  			exit();
  		}
  	}
  	else{
  		echo "<br><br>The application could not be approved! Kindly try again!";
  		if($_SESSION['pageid']==1){
  			$_SESSION['pageid']=0;
  			header("refresh:1;url=all.php");
  			exit();
  		}
  		else{
  			$_SESSION['pageid']=0;
  			header("refresh:1;url=pending.php");
  			exit();
  		}
  	}
  }
  }
  else{
  	echo "<br><br>There is some problem with the application id! Kindly try again!";
  }
}
if($_SESSION['pageid']==1){
	echo "<br><br><button><a href='all.php'>BACK</a></button>";
}
else{
	echo "<br><br><button><a href='pending.php'>BACK</a></button>";
}
echo " &nbsp&nbsp<button><a href='admincp.php'>ADMIN CP</a></button>";
}
else{
  header("refresh:0;url=profile.php");
  exit();
}
}
?>
</main>
</body>
</html>