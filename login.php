<?php
session_start();

$_SESSION['username'] = $username;

$username = $_POST['username'];

$password = $_POST['password'];

if ($username&&$password)

{
$connect = mysql_connect("localhost","root","") or die("cannot connect!");
mysql_select_db("emp_management") or die("cannot find data base!");
$query = mysql_query ("SELECT * FROM userprofile u join password p on p.user_id = u.user_id WHERE    Username='".mysql_real_escape_string($username)."' AND     Password='".mysql_real_escape_string($password)."'");
$numrows = mysql_num_rows($query);

if ($numrows!=0)
{
while ($row = mysql_fetch_assoc($query))
{
    $dbusername = $row['username'];
    $dbpassword = $row['password'];
}
if ($username==$dbusername&&$password=$dbpassword)
{
    echo "Welcome $username";
}
else
    echo "Invalid Password";
}
else
die("Invalid User");
?>