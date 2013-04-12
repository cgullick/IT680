<?php

session_start();

$dbhost = '64.254.188.188';
$dbuser = 'it680';
$dbpass = 'it680';

$connection = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Couldn't connect to server.");  
$db = mysql_select_db('scheduling_database', $connection) or die ("Couldn't select database.");  
 
      $search=$_SESSION['username']; 

      $data = 'SELECT * FROM `user_profile` WHERE `username` = "'.$search.'"';
      $query = mysql_query($data) or die("Couldn't execute query. ". mysql_error()); 
      $data2 = mysql_fetch_array($query);


/* Start Update Profile Query */

$First_Name = $_POST['First_Name'];
$Last_Name = $_POST['Last_Name'];
$Email = $_POST['Email'];
$Phone_Number = $_POST['Phone_Number'];
$Address = $_POST['Address'];
$City = $_POST['City'];
$State = $_POST['State'];
$Zip = $_POST['Zip'];

if(isset($_POST['update'])) {

$UpdateQuery = "UPDATE user_profile 
                SET First_Name = '$_POST[fname]', Last_Name = '$_POST[lname]', Email = '$_POST[email]', Phone_Number = '$_POST[phonenumber]', Address = '$_POST[address]', City = '$_POST[city]', State = '$_POST[state]', Zip = '$_POST[zip]'
                WHERE User_ID='$_POST[hidden]' ";
mysql_query($UpdateQuery, $connection);

};

/* End Update Profile Query */

/****************************/

/************************/
/* Start Access Control */




/* End Access Control */


/********************************/




/* Start Employee List */

$employeelist = mysql_query('SELECT * FROM user_profile');

/* End Employee List */

/*********************/

/* Start Image Upload Store to Database */

//$name = $_FILES['file']['name'];
//$location = "profile_image/".$name;

//$imagequery = 'INSERT INTO user_profile SET picture = "profile_image/$name" WHERE username = "'.$search.'" ';
//$imagequery = mysql_query("INSERT INTO  `user_profile` (`picture`) VALUES (`$location`) ");
//$imagequery = "UPDATE user_profile SET picture = '".$location."' WHERE username = ".$_SESSION['Username'];



/* End Image Upload Store to Database */



















/* Start Time Clock Query */

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
  //$clockedin = "select null from time_clock where emp_id = (select emp_id from user_profile where username = "'.$search.'"') and clock_out_time is NULL"
  $clockedinquery= mysql_query("SELECT null from `time_clock` where emp_id = (SELECT emp_id from user_profile where username = '".$search."') 
                                and clock_out_time is NULL");
  $checkifclockedin = mysql_num_rows($clockedinquery);

  $displayClockintime = mysql_query("SELECT * from time_clock where emp_id= (SELECT emp_id from user_profile where username = '".$search."') 
                                     and Date = curdate() order by Clock_in_time desc limit 1");
  $clockintimedisplay = mysql_fetch_array($displayClockintime);

/* End Time Clock Query */
/**********************************/

?>
