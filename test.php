<?php

session_start();

//include 'dbconnect.php';
//include 'get.php';

//connect to remote database
// mysql_connect("64.254.188.188","it680","it680") or die(mysql_error());
// mysql_select_db("emp_management") or die(mysql_error());

//localhost database
mysql_connect("localhost","root","root") or die(mysql_error());
mysql_select_db("databaseimage") or die(mysql_error());

//file properties
$file = $_FILES['image']['tmp_name'];

if(!isset($file))
{
	echo "Please select an image.";
}
else 
{
	$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	echo $image_name = addslashes($_FILES['image']['name']);
	$image_size = getimagesize($_FILES['image']['tmp_name']);

	if($image_size==FALSE)
	{
		echo "That's not an image.";
	}
	else
	{
		//$sessionusername = $_SESSION['username'];
		if (!$insert = mysql_query("INSERT INTO store SET Image='$image', Name='$image_name' /*WHERE Username = '$sessionusername'*/ "))
		{
			echo mysql_error();
		}
		else
		{
			$lastid = mysql_insert_id();
			//$lastid = $data2['User_ID']; //REVIEW***
			echo "Image uploaded.<p />Your image:<p /><img src=get.php?id=$lastid>"; //REVIEW***
			// header("Content-type: image/jpeg");
			// echo $image;
		}
	}
}

?>

<html>
	
	<p>Logged in as <a href="#" class="navbar-link"><?php echo $_SESSION['username']."<a href='logout.php'>  Log out</a>"; ?></a>
	<form action="test.php" method="POST" enctype="multipart/form-data">
		File: 
		<input type="file" name="image"><input type="submit" value="UploadThisImage">
	</form>

</html>