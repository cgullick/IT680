<?php

	// include 'dbconnect.php';
	// $getEventsSQL = $db->query("SELECT Schedule_ID, Emp_ID, Emp_Start_Time AS start_time, Emp_End_Time as end_time FROM schedule");
	// $events = array();
	// while ($row = $getEventsSQL->fetch()) {
	//     $start = $row['start_time'];
	//     $title = $row['Emp_ID'];
	//     $end = $row['end_time'];
	//     $eventsArray['id'] =  $row['Schedule_ID'];
	//     $eventsArray['title'] = $title;
	//     $eventsArray['start'] = $start;
	//     $eventsArray['end'] = $end;
	//     $eventsArray['url'] = "#";
	//     //$eventsArray['allDay'] = false;
	//     $events[] = $eventsArray;
	// }


	// echo json_encode($events);

   include 'dbconnect.php';
   $sql=("SELECT Schedule_ID, concat(u.First_Name, ' ' , u.Last_Name) as first_last, Emp_Start_Time AS start_time, Emp_End_Time as end_time FROM schedule s
      join user_profile u on u.Emp_ID = s.Emp_ID");
   $check = mysql_query($sql) or die(mysql_error());
   $var = 'false';

   $events = array();
   while ($row = mysql_fetch_assoc($check)) {
   $eventArray['title'] = $row['first_last'];   
   //$eventArray['description'] = $row['first_last'];
   $eventArray['start'] = $row['start_time'];
   $eventArray['end'] = $row['end_time'];   
   $eventArray['allDay'] = false;
   $events[] = $eventArray;
   }
   //echo  $events;
   echo json_encode($events);


   //$year = date('2013'); 
   //$month = date('03');

   // echo json_encode(array( 

   //    array( 
   //       'id' => 1, 
   //       'title' => "Event1", 
   //       'start' => "$year-$month-31 08:00:00", 
   //       'url' => "http://yahoo.com/",
   //       //'allDay' =>false; 
   //    ), 

   //    array( 
   //       'id' => 2, 
   //       'title' => "Event2", 
   //       'start' => "2013-03-31 08:00:00", 
   //       'end' => "2013-03-31 12:00:00", 
   //       'url' => "http://yahoo.com/",
   //       //'allDay'=>false; 
   //    ) 

   // ));


?>
