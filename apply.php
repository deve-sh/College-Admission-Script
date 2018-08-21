<?
session_start();
include("inc/config.php");
$_SESSION['logh'];
$_SESSION['userr'];
$_SESSION['userid'];
?>
<html>
<head>
<title>Apply</title>
<? include("inc/style.php"); ?>
</head>
<body>
<main align='center'>
	<h1><u>APPLY FOR A COURSE</u></h1>
    <?
    if($_SESSION['userr']!=""||$_SESSION['userid']!=0||$_SESSION['logh']!=false){
    	$userid=$_SESSION['userid'];
    	$check=mysqli_query($db,"SELECT * FROM applications WHERE userid='$userid'"); 
    	//CHECKING IF THE USER HAS ALREADY APPLIED FOR AN APPLICATION
    	if(mysqli_num_rows($check)>0){
    		echo "Sorry, you already have one application! A student is only allowed one application! <br><br>
    		<button><a href='profile.php'>Profile</a></button>";
    	}
    	else{
    		$date=date("Y-m-d"); //DATE

    		$rand=rand(1,200000000);

    		$randid="CSTE".$rand; //RANDOM APPLICATION NO

    		$info=mysqli_query($db,"SELECT * FROM colusers WHERE id='$userid'");

    		$retr=mysqli_fetch_assoc($info); //USER INFO RETRIEVED!

    		$email=$retr['email'];

    		$year=date("Y"); //CURRENT YEAR
?>
<form action="applied.php" method="post" align='left' enctype="multipart/form-data">
<div class='formleft'>
<input type="text" name="appid" value=<?echo $randid; ?> style='display: none;' required/>
<input type='date' value=<?echo $date;?> style='display:none;' name='doap' required/>
<br>
<br>
<label>Course : </label><select name='course' required>
<?
$courseselect=mysqli_query($db,"SELECT * FROM courses");
while ($course=mysqli_fetch_assoc($courseselect)) {
	echo "<option>".$course['course']."</option>";
}
?>
</select>
<br>
<br>
Name : <input type='text' name='name' maxlength="120" required/>
<br>
<br>
<label>DOB : </label><input type="date" name="dob" max=<? echo $date;?> required/>
<br>
<br>
Email : <input type="text" value=<? echo $email;?> id="email" name='email' required> &nbsp
<br>
<br>
<label>Gender : </label>
<select name='gender'>
	<option>Male</option>
	<option>Female</option>
	<option>Other</option>
</select>
<br>
<br>
Father's Name : <input type="text" name="father" placeholder="Enter Your Father's Name" required/>
<br>
<br>
Mother's Name : <input type="text" name="mother" placeholder="Enter your Mother's Name "required/>
<br>
<br>
Religion : <input type="text" name="religion" required/>
<br>
<br>
Caste : <input type="text" name="caste" required/>
<br>
<br>
Address with City: <br><textarea name='address' required/></textarea>
<br>
<br>
<input type="text" name="state" placeholder="State" required/>
<br>
<br>
<label>Pin Code : </label><input type="number" name="pincode">
<h3>Class 10 : </h3>
Marks Obtained : <input type="number" onkeyup="calculate()" onkeydown="calculate()" name="tenmarks" id="tenmarks" min='0' required/>
<br>
<br>
Total Marks : <input type="number" name="tentotal" onkeyup="calculate()" id="tentotal" onkeydown="calculate()"
min="100" required/>
<br>
<br>
(If you had a CGPA, kindly convert it using the calculator given <a href='cgpa.html' target="_blank">here</a>).
<br><br>
Percentage : <input type="text" name="tenpercent" id='tenpercent' required >
<br>
<br>
Roll No : <input type="number" name="tenroll" required>
<br>
<br>
Passing Year : <input type="number" name="tenyear" min="1990" max=<? echo $year; ?> required>
<br>
<br>
No of Attempts : <input type="number" name="tenattempts" min="1">
<br>
<br>
Board : <input type="text" name="tenboard" required/>
<h3>Class 12 : </h3>
Marks Obtained : <input type="number" name="twelvemarks" id='twelvemarks' onkeyup='calculate1()' onkeydown='calculate1()' required/>
<br>
<br>
Total Marks : <input type="number" name="twelvetotal" id='twelvetotal' onkeyup='calculate1()' onkeydown='calculate1()' required/>
<br>
<br>
Percentage : <input type="text" max="100" name="twelvepercent" id="twelvepercent"  required/>
<br>
<br>
No of Attempts : <input type="number" name="twelveattempts" min="1">
<br>
<br>
Stream : 
<select name='twelvestream' required>
	<option>Science</option>
	<option>Commerce</option>
	<option>Humanities</option>
</select>
<br>
<br>
Roll No : <input type="number" name="twelveroll" required>
<br>
<br>
Passing Year : <input type="number" name="twelveyear" min="1990" max=<? echo $year; ?> required>
<br>
<br>
Board : <input type="text" name="twelveboard" required/>
<br>
<br>
<hr>
</div>
<br>
<br>
Quota : <select name='quota'>
	<?
	$quotaquery=mysqli_query($db,"SELECT * FROM quotas");
	//QUERY FOR QUOTAS
    while($quota=mysqli_fetch_assoc($quotaquery)){
    	echo "<option>".$quota['quota']."</option>";
    }
	?>
</select>
<br>
<br>
Upload Photo (Passport Size - Max 50KB) :<br><br> <input type="file" name="image" required/>
<br>
<br>
Upload Signature (Max 30KB) : <br><br><input type="file" name="sign" required/>
<br><br>
<button type="submit">PAY & APPLY</button>
<br>
<br>
<button><a href='profile.php'>CANCEL</a></button>
</form>
<?
    	}
	}
	else{
		echo "<br>Kindly Login first!";
		header("refresh:1;url=login.php");
		exit();
	}
?>
</main>
<script type="text/javascript" src='scripts.js'></script>
</body>
</html>