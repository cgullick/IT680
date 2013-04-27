<?php


   include 'dbconnect.php';
   // $sql=("SELECT Schedule_ID, concat(u.First_Name, ' ' , u.Last_Name) as first_last, Emp_Start_Time AS start_time, Emp_End_Time as end_time FROM schedule s
   //    join employee u on u.Emp_ID = s.Emp_ID");
   $sql=("SELECT t1.Availability_id, concat(t1.First_Name, ' ' , t1.Last_Name) as first_last, 
               concat(work_date,' ', t1.start_time) AS start_time, concat(work_date,' ',t1.end_time) as end_time
               from 
               (SELECT u.First_Name, u.Last_Name,t.start_time, t.end_time, Availability_ID,
               (case when d.day = 'Monday' then (select makedate(2013, (week(curdate())+1) * 7))
               when d.day = 'Tuesday' then (select makedate(2013, (week(curdate())+1) * 7.05))
               when d.day = 'Wednesday' then (select makedate(2013, (week(curdate())+1) * 7.1))
               when d.day = 'Thursday' then (select makedate(2013, (week(curdate())+1) * 7.2))
               when d.day = 'Friday' then (select makedate(2013, (week(curdate())+1) * 7.25))
               else null end) as work_date
               FROM emp_availability ea
               join employee u on u.Emp_ID = ea.Emp_ID
               join time_availability ta on ta.time_availability_id = ea.time_availability_id 
               join day d on ta.day_id = d.day_id 
               join time t on t.time_id = ta.time_id 
               where ea.Emp_ID = '".$emp_id['emp_id']."'
               and is_avail = '1')t1;");
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

