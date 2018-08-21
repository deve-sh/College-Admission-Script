<?
session_start();
include("inc/config.php");
$_SESSION['logh'];
$_SESSION['userr'];
$_SESSION['userid'];
?>
<html>
<head>
<title>Register</title>
<? include("inc/style.php"); ?>
</head>
<body>
	<main>
     <?
       if($_SESSION['logh']==false||$_SESSION['userr']==""||$_SESSION['userid']==0){

       	//REGISTRATION VARIABLES
        
           $username=$_POST['username'];
           $pass1=$_POST['password1'];
           $pass2=$_POST['password2'];
           $email=$_POST['email'];
           $isadmin=0;
           $noapps=0;

        //VERIFICATIONS NOW
           if(strlen($pass1)>=8 && strlen($pass2)>=8 && $pass1==$pass2){ //If passwords are the same and of equal length!

                 $pass1=crypt($pass1,$salt); //ENCRYPTION
                 
                 $pass1=md5($pass1);  //EXTRA LAYER OF PROTECTION

                 $check=mysqli_query($db,"SELECT * FROM colusers WHERE username='$username' OR email='$email'");
                 
                 if(mysqli_num_rows($check)>0){
                  // IF USER ALREADY EXISTS
                 	echo "User already exists! Try Again or Login!";
                 	echo "<br><br><button><a href='register.php'>Back</a></button>";
           	        echo "<br><br><button><a href='login.php'>Login</a></button>";
           	        echo "<br><br><button><a href='index.php'>Home</a></button>";
                 }
                 else{
                 	$insert="INSERT INTO colusers(username,password,salt,email,isadmin,noapps) VALUES('$username','$pass1','$salt','$email','$isadmin','$noapps')";

                 	//INSERTION QUERY
                    
                    $insertion=mysqli_query($db,$insert); //INSERTION INTO DB

                    if($insertion){
                       echo "<br>User successfully registered!";
                       $_SESSION['logh']=true;
                       $_SESSION['userr']=$username;

                      $update=mysqli_query($db,"SELECT * FROM colusers WHERE username='$username'");
                      
                      $newuser=mysqli_fetch_assoc($update);
                      
                      $_SESSION['userid']=$newuser['id'];
                      header("refresh:1;url=profile.php");
                      exit();
                    }
                    else{
                    	echo "<br>There was some error with the database! Try again later!";
                    	echo "<br><br><button><a href='register.php'>Back</a></button>";
                    	echo "<br><Br><button><a href='index.php'>Home</a></button>";
                    }
                 }
           }
           else{
           	echo "Your passwords seem to have a problem. Kindly try again!";
           	echo "<br><br><button><a href='register.php'>Back</a></button>";
           	echo "<br><Br><button><a href='index.php'>Home</a></button>";
           }
       }
       else{
        echo "<br>You are already logged in! Kindly logout first to register!<br>";
        header("refresh:1;url=profile.php");
        exit();          
       }
       ?>
   </main>
</body>
</html>