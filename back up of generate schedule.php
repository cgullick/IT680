$q1counter = mysql_query("SELECT rank_id from day");
while ($row1 = mysql_fetch_array($q1counter, MYSQL_BOTH)){
  //printf("rank_ID: %s", $row1["rank_id"]);
  
  $q2counter = mysql_query("SELECT time_id from time");
  while ($row2 = mysql_fetch_array($q2counter, MYSQL_BOTH)){
    //printf("time_ID: %s", $row2["time_id"]);
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
                  order by d.day_id, rand()) t1
                  where t1.work_date not in (select request_off_date from request_off where emp_id = t1.emp_id)");
    $rownum= mysql_fetch_row($insert_query);
    //echo $rownum[0]."     ".$rownum[1]."     ".$rownum[2]."     ".$rownum[3]."     ".$rownum[4]."     ".$rownum[5]."<br/>";
    $q3 = mysql_query("SELECT count(emp_id) from schedule 
                    where emp_id = '".$rownum[0]."' 
                    and work_date = '".$rownum[1]."' 
                    and emp_start_time = '".$rownum[2]."' 
                    and emp_end_time = '".$rownum[3]."'");

    //echo mysql_result($q3, 0)."<br/>";
    if (mysql_result($q3, 0) == 0){
      $q4 = mysql_query("SELECT count(schedule_id) from schedule where emp_id = '".$rownum[0]."' and week_num = '".$rownum[5]."'");
      if (mysql_result($q4, 0) < 20){
        echo $rownum[0]."     ".$rownum[1]."     ".$rownum[2]."     ".$rownum[3]."     ".$rownum[4]."     ".$rownum[5]." ";//."<br/>";
        echo mysql_result($q4,0)."<br/>";
      }
    }
  }
  mysql_free_result($q2counter);
}
mysql_free_result($q1counter);