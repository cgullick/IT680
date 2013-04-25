<?php

include 'dbconnect.php';

session_start();

//connect to remote database
// mysql_connect("64.254.188.188","it680","it680") or die(mysql_error());
// mysql_select_db("emp_management") or die(mysql_error());

//localhost database
// mysql_connect("localhost","root","root") or die(mysql_error());
// mysql_select_db("databaseimage") or die(mysql_error());

$id = addslashes($_REQUEST['id']);

$image = mysql_query(" SELECT * FROM store WHERE username='".$search."' ");
$image = mysql_fetch_assoc($image);
$image = $image['image'];

header("Content-type: image/jpeg");
echo $image;


?>