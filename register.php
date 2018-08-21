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
<body style='background: #434343;'>
  <main align='center' style='background: #434343;'>
     <?
       if($_SESSION['logh']==false||$_SESSION['userr']==""||$_SESSION['userid']==0){
?>
<form action="registered.php" method="post" id='login'>
<h1><u>Register</u></h1>
<input type="text" required name="username" placeholder="Username">
<br><br>
<input type="Password" name="password1" id='password1' onkeyup='check1()' onkeydown='check()' placeholder='Password' required/>
<br><br>
<input type="password" name="password2" id='password2' onkeydown="check()" onkeyup="check()" placeholder="Confirm Password" required/>
<br>
<br>
<input type="email" name="email" placeholder="Email" required/>
<br>
<br>
<button type="submit" name="submit" id='submit'>SUBMIT</button></form>
<?
       }
       else{
         echo "<br><span style='color:#ffffff'>You are already logged in! Kindly logout first to register!<br></span>";
         header("refresh:1;url=profile.php");
         exit();
       }
     ?>
     <br>
     <button><a href='index.php'>Home</a></button>
  </main>
<script type="text/javascript">
var pass1=document.getElementById('password1');
var pass2=document.getElementById('password2');

function check1(){
   if(pass1.value.length>=8){
     pass1.style.border="1px solid #42b029";
   }
   else{
     pass1.style.border="1px solid #f22409";
   }
};
function check(){
   if(pass2.value==pass1.value && pass2.value.length>0){
    pass2.style.border="1px solid #42b029";
    document.getElementById('submit').style.display="block";
   }
   else{
    pass2.style.border="1px solid #f22409";
    document.getElementById('submit').style.display="none";
   }
};

console.log(check1);

console.log(check);
</script>
</body>
</html>