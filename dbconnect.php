<?php

session_start();

$connect = mysql_connect("64.254.188.188","it680","it680") or die ("Couldn't connect!");
mysql_select_db("emp_management") or die("Couldn't find database.");

while ($row = mysql_fetch_assoc($query))
{
	$dbusername = $row['username'];
	$First_Name = $row['First_Name'];
	$Last_name = $row['Last_Name'];
	
	//$dbpassword = $row['password'];
}

?>