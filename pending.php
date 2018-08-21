<?
session_start();
include 'inc/config.php';
$_SESSION['logh'];
$_SESSION['userr'];
$_SESSION['userid'];
$_SESSION['pageid']=2;
?>
<!DOCTYPE html>
<html>
<head>
	<title>All Pending Applications</title>
	<? include "inc/style.php"; ?>
</head>
<body>
<main align='center'>
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
        	echo "<div align='center'><h1>ALL PENDING APPLICATIONS</h1></div><br><br>";
          $apps=mysqli_query($db,"SELECT * FROM applications WHERE approved=0");
          if(mysqli_num_rows($apps)>0){
          echo "<table width='100%' cellpadding='10px'>
          <tr>
          <th>APPLICATION ID</th>
          <th>APPLICANT NAME</th>
          <th>VIEW APPLICATION</th>
          <th>APPROVE</th>
          <th>DECLINE</th>
          </tr>";
          while($app=mysqli_fetch_assoc($apps)){
            echo "<tr>
            <td>".$app['appid']."</td>".
            "<td>".$app['name']."</td>".
            "<td><a href='application.php?appid=".$app['appid']."' target='_blank'>View</a></td>".
            "<td>";
            if($app['approved']==0 && $app['approved']!=2 && $app['approved']!=1){
              echo "<a href='approve.php?appid=".$app['appid']."'>Approve</a>";
            }
            elseif($app['approved']==1){
              echo "Approved!";
            }
            echo "</td>";
            echo "<td>";
          if($app['approved']!=2 && $app['appoved']!=1 && $app['approved']==0){
             echo "<a href='decline.php?appid=".$app['appid']."'>Decline</a>";
            }
          elseif($app['approved']==2){
              echo "Declined!";
            }
            echo "</td></tr>";
          }
          echo "</table>";
        }
        else{
          echo "No pending applications. Relax huh! ";
        }
          echo "<br><br><button><a href='admincp.php'>Back</a></button>";
        }
        echo " &nbsp&nbsp<button><a href='profile.php'>Profile</a></button>";
      }
    ?>
  </main>
</body>
</html>