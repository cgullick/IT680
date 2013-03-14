<?php
	
	session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) 
    {
	    $connect = mysql_connect("64.254.188.188","it680","it680") or die ("Couldn't connect!");
	    mysql_select_db("emp_management") or die("Couldn't find database.");

	    $query = mysql_query("SELECT u.username, p.password FROM user_profile u join password p on p.user_id = u.user_id WHERE u.username='$username' and p.password='$password'");

	    $numrows = mysql_num_rows($query);

	    if ($numrows != 0) 
	    {
	    	//code to login
	    	while ($row = mysql_fetch_assoc($query))
	    	{
	    		$dbusername = $row['username'];
	    		$dbpassword = $row['password'];
	    	}
	    	if ($username == $dbusername && $password == $dbpassword)
	    	{
	    		//echo "Welcome! <a href='employee.php'Click</a> here to enter.";
	    		$_SESSION['username']=$dbusername;
	    		header("Location: ./employee.php");
	    	}
	    	else
	    		echo "Incorrect password.";
    	}
    	else 
    		die("User does not exist.");
    }
    else 
    	die("Please enter a username and a password.");
?>