<?
session_start();
$_SESSION['logh'];
$_SESSION['userr'];
$_SESSION['userid'];
include("inc/config.php");
$appid=$_GET['appid'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>VIEW APPLICATION</title>
	<? include("inc/style.php"); ?>
	<style type="text/css">
		tr{
			background: #ffffff;
		}
	</style>
</head>
<body>
<main style="margin-top: -14px;">
<?
if($appid==""){
	header("refresh:0;url=");
	exit();
}
else{
  $ret=mysqli_query($db,"SELECT * FROM applications WHERE appid='$appid'");
  if(mysqli_num_rows($ret)==0){
  	echo "No such application found! <br><br>";
  }
  else{
  	$app=mysqli_fetch_assoc($ret);
?>
<hr>
<div align="center">
<span style="font-family: Cambria; font-size: 40px; font-weight: bold;">XYZ UNIVERSITY</span><br>
(Deemed University)<br>
</div>
<hr>
<div class="right">
	<img src=<? echo $app['imgurl']; ?> width='100' height='100' />
	<br><br>
	<img src=<? echo $app['sign']; ?> width='100' height='40'/>
	<Br><br>
	<button onclick="printpage()" id='printed'>PRINT</button>
	<br><br>
</div>
<div class="left">
	<h2><u>Course</u> : <?echo $app['course']; ?></h2>
	<b>Name</b> : <? echo $app['name']; ?>
	<br><br>
	<b>Application ID </b> : <B><? echo $app['appid']; ?> </B>
	<br><br>
	<b>DOB</b> : <? echo $app['dob']; ?>
	<br><br>
	<b>Gender</b> : <? echo $app['gender']; ?>
	<br><br>
	<b>Father's Name </b>: <?echo $app['father']; ?>
	<br><br>
	<b>Mother's Name </b>: <? echo $app['mother']; ?>
	<br><br>
	<b>Email </b>: <?echo $app['email']; ?>
	<Br><Br>
	<b>Address</b> : <? echo $app['address']; ?>
	<br><br>
	<b>State </b>: <? echo $app['state']; ?>
	<br><br>
	<b>Pin Code</b> : <? echo $app['pincode']; ?>
	<br><br>
	<b>Caste </b>: <? echo $app['caste']; ?>
	<br><br>
	<b>Reservation </b>: <? echo $app['quota']; ?>
	<Br><br>
	<b>Status </b>: 
	<?
	if($app['approved']==0){
		echo "Pending";
	}
	elseif($app['approved']==1){
		echo "<span class='approved'>Approved</span>";
	}
	else{
		echo "<span class='declined'>Declined</span>";
	}
	?>
</div>
<div class='general'>
	<br>
	<br>
	<Br>
	<br>
	<h2>Educational Details</h2>
	<table width='100%' cellspacing="0px" cellpadding="10px" style='border: 1px solid #000000;'>
		<tr>
			<th id='th'>Examination</th>
			<th id='th'>Board</th>
			<th id='th'>Passing Year</th>
			<th id='th'>Percentage</th>
			<th id='th'>No of Attempts</th>
			<th id='th'>Stream</th>
		</tr>
        <tr>
        	<td>Class 10</td>
        	<td><? echo $app['tenboard']; ?></td>
        	<td><? echo $app['tenyear']; ?></td>
        	<td><? echo $app['tenpercent']."%"; ?></td>
        	<td><? echo $app['tenattempts']; ?></td>
        	<td><? echo "-" ; ?></td>
        </tr>
        <tr>
        	<td>Class 12</td>
        	<td><? echo $app['twelveboard']; ?></td>
        	<td><? echo $app['twelveyear']; ?></td>
        	<td><? echo $app['twelvepercent']."%"; ?></td>
        	<td><? echo $app['twelveattempts']; ?></td>
        	<td><? echo $app['twelvestream'] ; ?></td>
        </tr>
    </table>
    <br><br>
    <?
    if($app['approved']==1){
    	echo "Congrats on being selected to <b>Acchi university</b>, we are glad to provide you admission to the reknowned and deemed univerty. <Br><Br>
    	Keep in mind you will have to submit all the necessary documents in order to confirm your admission to the university/one of the propective colleges.
    	<bR><br>
    	Thank You! See you at the college!";
    }
    ?>
</div>

<?
  }
}
?>
</main>
<script type="text/javascript" src='appscript.js'></script>
</body>
</html>
