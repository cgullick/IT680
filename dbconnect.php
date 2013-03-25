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
/* Start Time Clock Query */


/* End Time Clock Query */
/************************/
/* Start Access Control */

$rank = $data2['Rank'];
echo $rank;

if($rank == 'administrator') {
	$redirect = './admin.php';
}
else if($rank == 'manager') {
	$redirect = './manager.php';
}
else if($rank == 'employee') {
	$redirect = './employee.php';
}

header('Location: ' . $redirect);

/* End Access Control */

?>





















