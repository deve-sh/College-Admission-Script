<?
session_start();
$_SESSION['userr'];
$_SESSION['logh'];
$_SESSION['userid'];
include("inc/config.php");
?>
<html>
<head>
	<title><? echo ucfirst($_SESSION['userr'])." - Profile"; ?></title>
	<? include("inc/style.php"); ?>
</head>
<body>
<main>
<?
if($_SESSION['userr']==""||$_SESSION['logh']==false||$_SESSION['userid']==0){
  echo "<br>You are not logged in!";
  header("refresh:1;url=login.php");
  exit();
}
else{
  $userid=$_SESSION['userid'];

  $username=$_SESSION['userr'];

  $ret=mysqli_query($db,"SELECT * FROM colusers WHERE username='$username'");

  $user=mysqli_fetch_assoc($ret);
  echo "<div align='center'><h1>USER PROFILE</h1></div>";
  echo "Username : <b>".$_SESSION['userr']."</b>"; 
  echo"<br><br>
  <hr>";
if($user['isadmin']!=1){
  echo "<br><br>";
  echo "<div style='border-radius: 3px; border: 1p solid #efefef; background: #efefef; padding: 20px; overflow: scroll;'><u>Applications</u> : <br><br>";

  $app=mysqli_query($db,"SELECT * FROM applications WHERE userid='$userid'");

  if(mysqli_num_rows($app)==0 || $user['noapps']==0){
  	echo "<div align='center'>No applications to any courses yet!</div><br><br>";
  	echo "<a href='apply.php'>Apply for one now!</a></div>";
  }
  else{
  	$apps=mysqli_fetch_assoc($app);
    echo "<table width='100%' cellspacing='0' cellpadding='10px'>
    <tr width='100%'>
    <th>APP ID.</th>
    <th>Course</th>
    <th width='30%'>Date of App.</th>
    <th>View</th>
    <th>Status</th>
    </tr>";
    echo "<tr>
     <td>".$apps['appid']."</td>
     <td>".$apps['course']."</td>
     <td>".$apps['doap']."</td>
     <td><a href='application.php?appid=".$apps['appid']."' target='_blank'>View</a></td>
     <td>";
     if($apps['approved']==1){ echo "<span class='approved'>Approved!</span>";}elseif($apps['approved']==2){
      echo "<span class='declined'>Declined</span>";
    }else
    {
      echo "Pending"; 
  } 
     echo"</td>
     </tr>";
    echo "</table>";
    echo "</div>";
  }
}
echo "<div align='center'>";
  if($user['isadmin']==1){
    echo "<br><br><ul><li><a href='admincp.php'>Admin CP</a></li></ul>";
  }
  echo "<ul>
  <br><li><a href='username.php'>Change Username</a></li>
  <br><br>";
  echo "<li><a href='email.php'>Change Email</a></li>
  <br><br>";
  echo "<li><a href='password.php'>Change Password</a></li>
  <br><br>";
  echo "<li><a href='logout.php'>Logout</a></li>
  </ul></div>";
}
?>
</main>
</body>
</html>