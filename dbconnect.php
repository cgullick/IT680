<?php

session_start();

$dbhost = '64.254.188.188';
$dbuser = 'it680';
$dbpass = 'it680';

$connection = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Couldn't connect to server.");  
$db = mysql_select_db('emp_management', $connection) or die ("Couldn't select database.");  
 
      $search=$_SESSION['username']; 

      $data = 'SELECT * FROM `user_profile`WHERE `username` = "'.$search.'"';
      $query = mysql_query($data) or die("Couldn't execute query. ". mysql_error()); 
      $data2 = mysql_fetch_array($query);

?>