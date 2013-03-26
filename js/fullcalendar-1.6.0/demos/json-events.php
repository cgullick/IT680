<?php

	include "dbconnect.php";
  // require("../../../connect/config.php"); 

  // $link = mysql_connect("$server","$user","$password") or die(mysql_error());
  // mysql_select_db($db);
  $query = "SELECT emp_id,emp_start_time, emp_end_time FROM schedule";
  $result = mysql_query($query) or die(mysql_error());
  $arr = array();
  while($row = mysql_fetch_assoc($result)){
    $arr[] = $row; 
  }
  echo json_encode($arr); 

	// $year = date('Y');
	// $month = date('m');

	// echo json_encode(array(
	
	// 	array(
	// 		'id' => 111,
	// 		'title' => "Event1",
	// 		'start' => "$year-$month-10",
	// 		'url' => "http://yahoo.com/"
	// 	),
		
	// 	array(
	// 		'id' => 222,
	// 		'title' => "Event2",
	// 		'start' => "$year-$month-20",
	// 		'end' => "$year-$month-22",
	// 		'url' => "http://yahoo.com/"
	// 	)
	
	// ));

?>
