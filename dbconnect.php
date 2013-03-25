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


  	if (isset($_POST['ClockIn'])){
  			$InsertQuery="INSERT INTO `emp_management`.`time_clock` (`Clock_in_Time`, `Date`, `Emp_ID`) VALUES (curtime(), curdate(), 
   			(select emp_id from user_profile where User_ID = '$_POST[hidden]'));";
  			mysql_query($InsertQuery, $connection);
  			header("Location: ./employee.php");
  			//echo "clocked in";
  			exit;
	};

	if (isset($_POST['ClockOut'])){
		$ClockoutUpdateQuery="Update time_clock SET Clock_out_Time = curtime() where Emp_id = (select emp_id from user_profile where User_ID = '$_POST[hidden]') and Date = curdate()";
		mysql_query($ClockoutUpdateQuery, $connection);
		header("Location: ./employee.php");
		exit;
	}

?>