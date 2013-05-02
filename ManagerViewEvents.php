<?php
   
   session_start();

   include 'dbconnect.php';

   //$id1 = addslashes($_REQUEST['id']);

   $sql=("SELECT Schedule_ID, concat(u.First_Name, ' ' , u.Last_Name) as first_last, 
concat(work_date,' ', emp_start_time) AS start_time, concat(work_date,' ',emp_end_time) as end_time FROM schedule s
      join employee u on u.Emp_ID = s.Emp_ID where s.Emp_ID = '".$id."';");
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
   //echo $events;
   ob_start();
   echo json_encode($events);
   $var1 = ob_get_contents();
   ob_end_clean();
   header("Location: ./EditEmployee1.php?id=$id"); 
   
?>

