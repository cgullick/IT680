<?php


   include 'dbconnect.php';
   // $sql=("SELECT Schedule_ID, concat(u.First_Name, ' ' , u.Last_Name) as first_last, Emp_Start_Time AS start_time, Emp_End_Time as end_time FROM schedule s
   //    join user_profile u on u.Emp_ID = s.Emp_ID");
   $sql=("SELECT Schedule_ID, concat(u.First_Name, ' ' , u.Last_Name) as first_last, 
concat(work_date,' ', emp_start_time) AS start_time, concat(work_date,' ',emp_end_time) as end_time FROM schedule s
      join user_profile u on u.Emp_ID = s.Emp_ID;");
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



?>

