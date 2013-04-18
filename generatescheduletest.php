<?php
include "dbconnect.php";


$q1counter = mysql_query("SELECT rank_id from day");
while ($row1 = mysql_fetch_array($q1counter, MYSQL_BOTH)){
  printf("rank_ID: %s", $row1["rank_id"]);
  
  $q2counter = mysql_query("SELECT time_id from time");
  while ($row2 = mysql_fetch_array($q2counter, MYSQL_BOTH)){
  	printf("time_id: %s", $row2["time_id"]); echo "<br/>";
  	$insert_query = mysql_query("select t1.emp_id,t1.work_date, t1.emp_start_time, t1.emp_end_time, t1.all_day, t1.week_num
                  from 
                  (SELECT ea.emp_id,t.start_time as emp_start_time, t.end_time as emp_end_time,
                   null as all_day, week(curdate())+1 as week_num,
                  (case when d.day = 'Monday' then (select makedate(2013, (week(curdate())+1) * 7))
                  when d.day = 'Tuesday' then (select makedate(2013, (week(curdate())+1) * 7.05))
                  when d.day = 'Wednesday' then (select makedate(2013, (week(curdate())+1) * 7.1))
                  when d.day = 'Thursday' then (select makedate(2013, (week(curdate())+1) * 7.2))
                  when d.day = 'Friday' then (select makedate(2013, (week(curdate())+1) * 7.25))
                  else null end) as work_date
                  from emp_availability ea join time_availability ta on ta.time_availability_id = ea.time_availability_id join
                  day d  on ta.day_id = d.day_id join time t on t.time_id = ta.time_id 
                  where ta.time_id = '".$row2['time_id']."' and d.rank_id = '".$row1['rank_id']."' and is_avail = '1' 
                  order by d.day_id) t1
                  where t1.work_date not in (select request_off_date from request_off where emp_id = t1.emp_id)");
	$colnum= mysql_fetch_row($insert_query);
    //echo $rownum[0]."     ".$rownum[1]."     ".$rownum[2]."     ".$rownum[3]."     ".$rownum[4]."     ".$rownum[5]."<br/>";
	$array = array();
	while ($row = mysql_fetch_assoc($insert_query)){
		$array[] = $row['emp_id'];
	}

	shuffle($array);
	//print_r(sizeof($array));
	$max = sizeof($array);
		// for ($i =0; $i < $max; $i++) {
		// 	printf($array[$i]);
		// 	echo "<br/>";
		// 	$q3 = mysql_query("SELECT count(emp_id) from schedule 
  //                   where work_date = '".$colnum[1]."' 
  //                   and emp_start_time = '".$colnum[2]."' 
  //                   and emp_end_time = '".$colnum[3]."'");
		// 	$test= mysql_fetch_row($q3);
		// 	echo $test[0];
		// }



  }
  mysql_free_result($q2counter);
}
mysql_free_result($q1counter);
?>