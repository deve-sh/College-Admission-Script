<?
session_start();
include 'inc/config.php';
$_SESSION['logh'];
$_SESSION['userr'];
$_SESSION['userid'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN CP</title>
	<? include "inc/style.php"; ?>
</head>
<body>
<main>
	<?
      if($_SESSION['logh']==false||$_SESSION['userr']==""||$_SESSION['userid']==0){
        echo "<br>You are not logged in!";
        header("refresh:1;url=login.php");
        exit();
      }
      else{
      	$userid=$_SESSION['userid'];

        $query=mysqli_query($db,"SELECT * FROM colusers WHERE id='$userid'");

        $user=mysqli_fetch_assoc($query);

        if($user['isadmin']==0){
        	echo "You are not authorised to access the Admin CP!";
        	header("refresh:1;url=profile.php");
        	exit();
        }
        else{
        	echo "<div align='center'><h1><u>ADMIN CP</u></h1></div>";
        	echo "Welcome Admin!";
?>
<div align="center">
<ul>
	<li><a href='course.php'>Add A Course</a></li>
	<br>
	<li><a href='quota.php'>Add A Quota</a></li>
	<br>
	<li><a href="pending.php">All Pending Applications</a></li>
	<br>
	<li><a href='all.php'>All Applications</a></li>
	<br>
  <li><a href="index.php">Home</a></li>
  <br>
  <li><a href="usercp.php">User CP</a></li>
  <br>
	<li><a href='logout.php'>Logout</a></li>
</ul>
</div>
<?
        }
      }
	?>
</main>
</body>
</html>