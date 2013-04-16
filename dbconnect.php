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

// $First_Name = $_POST['First_Name'];
// $Last_Name = $_POST['Last_Name'];
// $Email = $_POST['Email'];
// $Phone_Number = $_POST['Phone_Number'];
// $Address = $_POST['Address'];
// $City = $_POST['City'];
// $State = $_POST['State'];
// $Zip = $_POST['Zip'];

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];

if(isset($_POST['UpdateProfileButton'])) {
$UpdateQuery = "UPDATE user_profile
                SET First_Name = '$fname', Last_Name = '$lname', Email = '$email', Phone_Number = '$phonenumber', Address = '$address', City = '$city', State = '$state', Zip = '$zip'
                WHERE username = '".$search."' ";
mysql_query($UpdateQuery, $connection);
header("Location: ./editprofile.php");

};

$requestoffdate = $_POST['requestoffdate'];
$requestoffreason = $_POST['requestoffreason'];

if (isset($_POST['RequestOffButton'])) {
  $RequestOff = " INSERT INTO request_off (Emp_ID, Request_Off_Date, Reason) 
                  VALUES ('$emp_id[emp_id]','$requestoffdate','$requestoffreason') ";
  mysql_query($RequestOff, $connection);
  header("Location: ./requesttimeoff.php");
}


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

/* Start Availability Update */

$emp_id = mysql_fetch_assoc(mysql_query("SELECT emp_id FROM user_profile WHERE username = '". $search ."'"));

$UpdateAvailabilityQuery = mysql_query(" SELECT is_avail FROM emp_availability WHERE emp_id = '".$emp_id['emp_id']."' ORDER BY time_availability_id ");

// Query to get max availability_id for specific employee

if (isset($_POST['UpdateAvailabilityButton'])) {
  for ($i = 1; $i < 46; $i++) {
    if (isset($_POST['UpdateAvailabilityButton']) && $_POST['UpdateAvailability'.$i] == 'true' ) {
      $UpdateAvailabilityQuery = " UPDATE emp_availability
                                   SET is_avail = '1'
                                   WHERE time_availability_id = '". $i . "' and emp_id = (select emp_id from user_profile where username = '". $search ."') ";
      mysql_query($UpdateAvailabilityQuery, $connection);
      header("Location: ./availability.php");                       
    } else {
          $UpdateAvailabilityQueryUnchecked = " UPDATE emp_availability
                                   SET is_avail = '0'
                                   WHERE time_availability_id = '". $i . "' and emp_id = (select emp_id from user_profile where username = '". $search ."') ";
      mysql_query($UpdateAvailabilityQueryUnchecked, $connection); 
      header("Location: ./availability.php");
    }
  }
}

/* End Availability Update */

/* Start Time Clock Query */

  	if (isset($_POST['ClockIn'])) {
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

/* Start Request Off Query */

$requestoffdate = $_POST['requestoffdate'];
$requestoffreason = $_POST['requestoffreason'];

if (isset($_POST['RequestOffButton'])) {
  $RequestOff = " INSERT INTO request_off (Emp_ID, Request_Off_Date, Reason) 
                  VALUES ('$emp_id[emp_id]','$requestoffdate','$requestoffreason') ";
  mysql_query($RequestOff, $connection);
  header("Location: ./requesttimeoff.php");
}

/* End Request Off Query */

?>
