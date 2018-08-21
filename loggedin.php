<?
session_start();
include("inc/config.php");
$_SESSION['logh'];
$_SESSION['userr'];
$_SESSION['userid'];
?>
<html>
<head>
<title>Logging In...</title>
<? include("inc/style.php"); ?>
</head>
<body>
	<main>
		<?
		$username=$_POST['username'];
		$password=$_POST['password'];
	if($_SESSION['logh']!=true||$_SESSION['userr']==''||$_SESSION['userid']=0){
		if($username==""||$password==""||$username==" "||$password==" "){
			echo "Kindly go back and enter the password again!";
			echo "<br><br><a href='login.php'>Back!</a>";
		}
        else{
         $query1=mysqli_query($db,"SELECT * FROM colusers WHERE username='$username' OR email='$username'");
            if(mysqli_num_rows($query1)>0)
            {

            $user=mysqli_fetch_assoc($query1);

            $salt=$user['salt'];

            $password=crypt($password,$salt);

            $password=md5($password);

        	$check=mysqli_query($db,"SELECT * FROM colusers WHERE (username='$username' OR email='$username') AND password='$password'");
            
        	if(mysqli_num_rows($check)==0){ 

        	//IF USERNAME AND PASSWORD DON'T MATCH

        		echo "Sorry, no such user exists, or the username and password combination was wrong!
            <br>
            <br>
            <button><a href='login.php'>Try Again</a></button>"; 
        	}
        	else{
        		echo "You are successfully signed in!";
        		$_SESSION['logh']=true;
        		$user=mysqli_fetch_assoc($check);
        		$_SESSION['userr']=$user['username'];
        		$_SESSION['userid']=$user['id'];
        		header("refresh:1;url=profile.php");
        		exit();
        	}
          }
          else
          {
            echo "<br><br>There is no such user!
            <br><br><button><a href='login.php'>Try Again</a></button><br><br><button><a href='index.php'>Home</a></button>";
          }

        }
	}
	else{
       echo "<br>You are already signed in!";
       header("refresh:1;url=profile.php");
       exit(); 
    }
		?>
	</main>
</body>