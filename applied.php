<?
session_start();
include "inc/config.php";
$_SESSION['logh'];
$_SESSION['userr'];
$_SESSION['userid'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Applying for the course!</title>
    <? include "inc/style.php"; ?>
</head>
<body>
<?
if($_SESSION['logh']==false||$_SESSION['userr']==""||$_SESSION['userid']==0){
	echo "Kindly login first!";
	header("refresh:1;url=login.php");
	exit();
}
else{
	$userid=$_SESSION['userid'];

	$query=mysqli_query($db,"SELECT * FROM colusers WHERE id='$userid'");

	$user=mysqli_fetch_assoc($query);

	if($user['isadmin']==1){
		echo "Come on Man! Can't you see! You are the admin!";
		header("refresh:1;url=admincp.php");
	}
	else{
		$userid=$_SESSION['userid'];
		$randid=$_POST['appid'];
		$appid="COL12S".$randid; //APP ID
        $doap=$_POST['doap']; //DATE OF APP
        $course=$_POST['course']; //COURSE
        //NOW BIODATA
        $name=$_POST['name'];
        $dob=$_POST['dob'];
        $email=$_POST['email'];
        $gender=$_POST['gender'];
        $father=$_POST['father'];
        $mother=$_POST['mother'];
        $religion=$_POST['religion'];
        $caste=$_POST['caste'];
        //FULL ADDRESS
        $address=$_POST['address'];
        $state=$_POST['state'];
        $pincode=$_POST['pincode'];
        //CLASS 10 DETAILS
        $tenmarks=$_POST['tenmarks'];
        $tentotal=$_POST['tentotal'];
        $tenpercent=$_POST['tenpercent'];
        $tenroll=$_POST['tenroll'];
        $tenyear=$_POST['tenyear'];
        $tenattempts=$_POST['tenattempts'];
        $tenboard=$_POST['tenboard'];
        //CLASS 12 DETAILS
        $twelvemarks=$_POST['twelvemarks'];
        $twelvetotal=$_POST['twelvetotal'];
        $twelvepercent=$_POST['twelvepercent'];
        $twelveattempts=$_POST['twelveattempts'];
        $twelvestream=$_POST['twelvestream'];
        $twelveroll=$_POST['twelveroll'];
        $twelveyear=$_POST['twelveyear'];
        $twelveboard=$_POST['twelveboard'];
        //QUOTA AND PAYMENT
        $quota=$_POST['quota'];
        $payment=1000;
        $approved=0;
        //PHOTO AND SIGNATURE
$target_dir = "uploads/";

$target_file = basename($_FILES["image"]["name"]);

$target_filed = "uploads/".$target_file;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_filed,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_filed)) {
	$rand=rand(1,10000000000);
	$target_file = basename($_FILES["image"]["name"]);
	$ext=end(explode(".",$target_file));
	$filename=basename($target_file,".".$ext);
	$filename=$filename.$rand;
    $target_file=$filename.".".$ext;
    $target_filed= "uploads/".$target_file;
}
// Check file size
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_filed)) {
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
  }

//NOW THE SIGNATURE

  $target_file1=basename($_FILES['sign']['name']);
  $target_filed1="uploads/".$target_file1;
  $uploadOk1=1;
  $imageFileType1 = strtolower(pathinfo($target_filed1,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["sign"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk1 = 1;
    } else {
        echo "File is not an image.";
        $uploadOk1 = 0;
    }
}
// Check if file already exists
if (file_exists($target_filed)) {
	$rand1=rand(1,10000000006);
	$target_file1 = basename($_FILES["sign"]["name"]);
	$extension=end(explode(".",$target_file1));
	$filename1=basename($target_file1,".".$extension);
	$filename1=$filename1.$rand1;
    $target_file1=$filename1.".".$extension;
    $target_filed1= "uploads/".$target_file1;
}
// Check file size
if ($_FILES["sign"]["size"] > 300000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
&& $imageFileType1 != "bmp" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk1 = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES["sign"]["tmp_name"], $target_filed1)) {
    } 
    else {
        echo "Sorry, there was an error uploading your file.";
    }
  }

//NOW FINAL EXECUTION
  if($uploadOk==1 && $uploadOk1==1){
    $applying="INSERT INTO applications VALUES(
    '$userid',
    '$appid',
    '$doap',
    '$course',
    '$name',
    '$dob',
    '$email',
    '$target_filed',
    '$target_filed1',
    '$gender',
    '$father',
    '$mother',
    '$religion',
    '$caste',
    '$address',
    '$state',
    '$pincode',
    '$tenmarks',
    '$tentotal',
    '$tenpercent',
    '$tenroll',
    '$tenyear',
    '$tenattempts',
    '$tenboard',
    '$twelvemarks',
    '$twelvetotal',
    '$twelvepercent',
    '$twelveattempts',
    '$twelvestream',
    '$twelveroll',
    '$twelveyear',
    '$twelveboard',
    '$quota',
    '$payment',
    '$approved')
    ";
    $application=mysqli_query($db,$applying);
    $application1=mysqli_query($db,"UPDATE colusers SET noapps=noapps+1 where id='$userid'");
    if($application && $application1){
    	echo "<br><br>Application Successfully submitted!";
    	header("refresh:1;url=profile.php");
    	exit();
    }
    else{
    	echo "<br><br>There was a problem, kindly try again!";

    	echo "<br><br><button><a href='apply.php'>BACK</a></button>";

    	echo "<br><br><button><a href='profile.php'>HOME</a></button>";
    }
  }
  else{
  	echo "<br><br>Sorry for the inconveniece caused, kindly try again!";
    echo "<br><br><button><a href='apply.php'>BACK</a></button>";
    echo "<br><br><button><a href='profile.php'>HOME</a></button>";
  }

  }
}

?>
</body>
</html>