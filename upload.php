<?php

session_start();

include 'dbconnect.php';

$id = addslashes($_REQUEST['id']);

$image = mysql_query("SELECT * FROM user_profile WHERE id=$id");
$image = mysql_fetch_assoc($image);
$image = $image['image'];

header("Content-type: image/jpeg");

echo $image;

// if ($_POST['SUBMIT'])
// {
// 	//get file attributes
//$tmp_name = $_FILES['file']['tmp_name'];

// 	if($name)
// 	{
// 		//start upload process
// 		if(move_uploaded_file($tmp_name, $location))
// 		{
// 			header("Location: ./employee.php");
// 		}

// 	}
// 	else
// 		die("Please select a file");

// }

/* WORKS */

// if(isset($name)) 
// {
// 	if(!empty($name)) 
// 	{

// 		if(move_uploaded_file($tmp_name, $location))
// 		{
// 		   	header("Location: ./employee.php");
// 		}
// 		else
// 		{
// 			echo 'There was an error';
// 		}

// 	} 
// 	else 
// 	{
// 		echo 'please choose a file';
// 	}
// }

?>