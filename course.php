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
	<title>Add Course</title>
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
        	echo "<div align='center'><h1>ADD A COURSE</h1></div>";
?>
<form action="" method='post'>
<label>Course Name</label> : <input type="text" name="course">
<br>
<br>
<button type="submit">ADD</button>
</form>
<?
$course=$_POST['course'];
//CHECK if the course already exists
if($course==""||$course==" "){

}
else{
$check=mysqli_query($db,"SELECT * FROM courses WHERE course='$course'");
if(mysqli_num_rows($check)>0){
  echo "<br><br>course Already exists! Please try something else!";
}
else{
  $insert=mysqli_query($db,"INSERT INTO courses VALUES('$course')");
  if($insert){
    echo "<br><br>Successfully Added Course!";
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