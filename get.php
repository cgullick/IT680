<?php

session_start();

//include 'dbconnect.php';

//localhost database
mysql_connect("localhost","root","root") or die(mysql_error());
mysql_select_db("databaseimage") or die(mysql_error());

ob_start();

$id = addslashes($_REQUEST['id']);

//$image = 'SELECT * FROM `user_profile` WHERE `username` = "'.$search.'"';
$image = 'SELECT * FROM `store` WHERE `id` = $id ';
$image = mysql_query($image);
$image = mysql_fetch_row($image);
$image = $image['image'];

ob_end_clean();

header("Content-type: image/jpeg");
echo base64_decode($image);
//print_r($image);

?>