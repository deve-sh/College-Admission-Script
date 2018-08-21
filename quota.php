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
	<title>Add Quota</title>
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
        	echo "You are not authorised to access this page!";
        	header("refresh:1;url=profile.php");
        	exit();
        }
        else{
        	echo "<div align='center'><h1>ADD A QUOTA</h1></div>";
?>
<form action="" method='post'>
<label>Quota Name</label> : <input type="text" name="quota">
<br>
<br>
<button type="submit">ADD</button>
</form>
<?
$quota=$_POST['quota'];
//CHECK if the quota already exists
if($quota==""||$quota==" "){

}
else{
$check=mysqli_query($db,"SELECT * FROM quotas WHERE quota='$quota'");
if(mysqli_num_rows($check)>0){
  echo "<br><br>Quota Already exists! Please try something else!";
}
else{
  $insert=mysqli_query($db,"INSERT INTO quotas VALUES('$quota')");
  if($insert){
    echo "<br><br>Successfully Added!";
  }
  else{
    echo "<br><br>Could not be added! Try Again Please!";
  }
}
?>
<?
}
}
}
?>
<br><br>
<button><a href='admincp.php'>Back</a></button>
</main>
</body>
</html>