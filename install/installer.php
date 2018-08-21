<?
session_start();
include '../inc/saltgenerator.php';
include 'installinc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Installing Script</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/smallscreen.css">
	<link rel="stylesheet" type="text/css" href="../css/ultrasmall.css">
  <style type="text/css">
    button a{
      color: #ffffff;
      text-decoration: none;
    }
  </style>
</head>
<body>
<main>
<?php
if($y=="1"||$z=="1"||$w!="0"){   
// IF THE SCRIPT IS ALREADY INSTALLED
  echo "<br><br>The script is already installed! Thanks! <bR><br>";
  echo "<a href='../index.php'>Go Home!</a>";
}
else
{

// DATABASE CONNECTION DETAILS

$host=$_POST['host'];
$username=$_POST['username'];
$password=$_POST['password'];

if(empty($password)){
  $password='';
}

$dbname=$_POST['dbname'];

//ADMIN DETAILS

$admin=$_POST['adusername'];
$pass1=$_POST['adpassword'];
$pass2=$_POST['password2'];
$email=$_POST['email'];
$isadmin=1;
$noapps=0;

//CODE FOR DATABASE TABLES
if(!empty($host) && !empty($username) && !empty($admin) && !empty($pass1) && !empty($email))
{
if(strlen($pass1)>=8 && strlen($pass2)>=8){

//ENCRYPTION OF PASSWORD WITH SALT

echo "<br><br>Starting Installation!";

$pass1=crypt($pass1,$salt);

$pass1=md5($pass1);   //EXTRA LAYER OF SECURITY

echo "<br><br>Encrypting Passwords...";

$db=mysqli_connect($host,$username,$password,$dbname) or die("Could not connect to database! Kindly recheck your input. <br><br><a href='index.php'>Go Back!</a>");

if($db){

echo "<br><br>Connected to database!";

# FIRST DELETING ANY OF THE TABLES THAT MAY HAVE BEEN CREATED DURING AN UNSUCCESSFUL INSTALLATION

$drop1=mysqli_query($db,"DROP TABLE IF EXISTS applications");

$drop2=mysqli_query($db,"DROP TABLE IF EXISTS courses");

$drop3=mysqli_query($db,"DROP TABLE IF EXISTS quotas");

$drop4=mysqli_query($db,"DROP TABLE if exists colusers CASCADE");

# TABLES DROPPED, NOW THE USER'S TURN

$table1="CREATE TABLE colusers(
id integer(11) primary key auto_increment,
username varchar(20) unique not null,
password varchar(255) not null,
salt varchar(255),
email varchar(100) UNIQUE not null,
isadmin boolean,
noapps integer(2)
)";

# COURSES AVAILABLE

$table2="CREATE TABLE courses(
 course text not null
)
";

# QUOTAS SUBJECTED

$table3="CREATE TABLE quotas(
 quota text not null
)";

# APPLICATION

$table4="CREATE TABLE applications(
userid integer(11) unique not null,
appid varchar(30) not null,
doap date not null,
course text not null,
name text not null,
dob date not null,
email varchar(120) unique not null,
imgurl varchar(255) unique not null,
sign varchar(255) unique not null,
gender text not null,
father text not null,
mother text not null,
religion text not null,
caste text not null,
address text not null,
state text not null,
pincode bigint not null,
tenmarks varchar(5) not null,
tentotal varchar(5) not null,
tenpercent text not null,
tenroll bigint not null,
tenyear integer(11) not null,
tenattempts integer(2) not null,
tenboard text not null,
twelvemarks varchar(5) not null,
twelvetotal varchar(5) not null,
twelvepercent varchar(5) not null,
twelveattempts integer(2) not null,
twelvestream text not null,
twelveroll bigint not null,
twelveyear integer(6) not null,
twelveboard text not null,
quota text not null,
payment integer(6),
approved boolean not null,
foreign key(userid) references colusers(id)
);";

$table5="INSERT INTO colusers(username,password,salt,email,isadmin,noapps) VALUES('$admin','$pass1','$salt','$email','$isadmin','$noapps')";

//INSTALLATION COMFIRMATION VARIABLES

$confirm1;
$confirm2;
$confirm3;
$confirm4;
$confirm5;

//INSTALLATION BEGINS HERE!

$check1=mysqli_query($db,"SELECT 1 FROM colusers");
if(!$check1){
  $confirm1=mysqli_query($db,$table1);
  if($confirm1){
  	echo "<br><br>Created Table For Users";
  }
}

$check2=mysqli_query($db,"SELECT 1 FROM courses");
if(!$check2){
   $confirm2=mysqli_query($db,$table2);
    if($confirm2){
  	  echo "<br><br>Created Table For Courses";
    }
}

$check3=mysqli_query($db,"SELECT 1 FROM quotas");
if(!$check3){
	$confirm3=mysqli_query($db,$table3);
  if($confirm3){
  	echo "<br><br>Created Table For Quotas";
  }
}

$check4=mysqli_query($db,"SELECT 1 FROM applications");
if(!$check4){
	$confirm4=mysqli_query($db,$table4);
  if($confirm4){
  	echo "<br><br>Created Table For Applications";
  }
}

$confirm5=mysqli_query($db,$table5);

if($confirm5){
	echo "<br><br>Insterted Information About the Admin!";
}

//IF EVERYTHING IS GOOD, THEN WRITE DETAILS OF INSTALLATION ONTO THE FILES
if($confirm1 && $confirm2 && $confirm3 && $confirm4 && $confirm5){
//INTERNAL FILE

$file1=fopen("confirm.txt","r+");
fwrite($file1,"1");
fclose($file1);

//EXTERNAL FILE

$file2=fopen("../confirm1.txt","r+");
fwrite($file2,"1");
fclose($file2);

//DATABASE DETAILS FILE

$configfile=fopen("../inc/config.php","w+");
fwrite($configfile,"<?
$"."ho='".$host."';\n"."
$"."us='".$username."';\n"."
$"."pa='".$password."';\n"."
$"."dn='".$dbname."';\n"."
$"."db="."mysqli_connect($"."ho".",$"."us".",$"."pa".","."$"."dn"."".") or die("."'Could not connect to the database.'".");
\n
include "."'"."inc/saltgenerator.php"."'".";
?>
");
fclose($configfile);
fclose($fileone);
fclose($filetwo);
fclose($filethree);
echo "<br><br>";
echo "<button><a href='../index.php'>CHECK OUT YOUR NEW SCRIPT</a></button>";
}
else{
	echo "<br><br>All parts of the script could not be installed properly. Kindly try again later!";
}

}
#IF PASSWORD ISN'T RIGHT
}

else{
	echo "The passwords seem to have a problem.
	<BR>
	<br>
	<button><a href='index.php'>Back</a></button>";
}
}
else{
  echo "<br><br>Kindly enter the info again!";
  echo "<button><a href='index.php'>Back</a></button>";
}
}
?>
</main>
</body>
</html>
