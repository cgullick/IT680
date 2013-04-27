<?php
	
	session_start();

	include 'dbconnect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) 
    {
	    $connect = mysql_connect($dbhost,$dbuser,$dbpass) or die ("Couldn't connect!");
	    mysql_select_db("scheduling_database") or die("Couldn't find database.");

	    $query = mysql_query("SELECT e.username, p.password, e.rank 
	    					  FROM employee e join password p on p.emp_id = e.emp_id 
	    					  WHERE e.username='$username' and p.password='$password'");

	    $numrows = mysql_num_rows($query);

	    if ($numrows != 0) 
	    {
	    	//code to login
	    	while ($row = mysql_fetch_assoc($query))
	    	{
	    		$dbusername = $row['username'];
	    		$dbpassword = $row['password'];
	    		$dbrank = $row['rank'];
	    	
		    	if ($username == $dbusername && $password == $dbpassword && $dbrank == 'Administrator')
		    	{
		    		$redirect = './admin.php';
		    	}
	    		else if ($username == $dbusername && $password == $dbpassword && $dbrank == 'Manager')
		    	{
		    		$redirect = './manager.php';
		    	}
	    		else if ($username == $dbusername && $password == $dbpassword && $dbrank == 'Employee')
		    	{
		    		$redirect = './employeenews.php';
		    	}
		    	else 
		    	{
		    		echo "Incorrect password.";
		    	}

		    	$_SESSION['username'] = $dbusername;
		    	header("Location: " . $redirect);
	    	}
    	}
    	else 
    		die("User does not exist.");
    }
    else 
    	die("Please enter a username and a password.");
?>