<?php

session_start();

$dbhost = '64.254.188.188';
$dbuser = 'it680';
$dbpass = 'it680';

$connection = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Couldn't connect to server.");  
$db = mysql_select_db('scheduling_database', $connection) or die ("Couldn't select database.");  
 
      $search=$_SESSION['username']; 

      $data = 'SELECT * FROM `employee` WHERE `username` = "'.$search.'"';
      $query = mysql_query($data) or die("Couldn't execute query. ". mysql_error()); 
      $data2 = mysql_fetch_array($query);


/* Start Update Profile Query */

$username = $_POST['username'];
$password = $_POST['password'];
$rank = $_POST['rank'];
$techid = $_POST['techid'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];

if(isset($_POST['UpdateProfileButton'])) {
$UpdateQuery = "UPDATE employee
                SET First_Name = '$fname', Last_Name = '$lname', Email = '$email', Phone_Number = '$phonenumber', Address = '$address', City = '$city', State = '$state', Zip = '$zip'
                WHERE username = '".$search."' ";
mysql_query($UpdateQuery, $connection);
header("Location: ./editprofile.php");

};

$requestoffdate = $_POST['requestoffdate'];
$requestoffreason = $_POST['requestoffreason'];

if (isset($_POST['RequestOffButton'])) {
  $RequestOff = " INSERT INTO request_off (Emp_ID, Request_Off_Date, Reason) 
                  VALUES ('$emp_id[emp_id]','$requestoffdate','$requestoffreason') ";
  mysql_query($RequestOff, $connection);
  header("Location: ./requesttimeoff.php");
}


/* End Update Profile Query */

/****************************/

/************************/
/* Start Access Control */




/* End Access Control */


/********************************/




/* Start Employee List */

try {

  $sql = " SELECT * FROM employee WHERE rank = 'employee' ";
  $result = mysql_query($sql) or die(mysql_error());
  $list = mysql_fetch_assoc($result);

} catch(PDOException $e) {
  echo 'There was a problem';
}

if ($_POST['UpdateProfileButton']) {
  $name = $_FILES['myfile']['name'];
  $tmp_name = $_FILES['myfile']['tmp_name'];

  if ($name) {
    $location = "img/$name";
    move_uploaded_file($tmp_name, $location);

    $ImageQuery2 = mysql_query("UPDATE employee SET image_name='$name', image_location='$location' WHERE username= '".$search."' ");
    die("Your profile image has been uploaded!");
  } else
    die("Please select a file!");
}

/* End Image Upload Store to Database */

/* Start Availability Update */

$emp_id = mysql_fetch_assoc(mysql_query("SELECT emp_id FROM employee WHERE username = '". $search ."'"));

$First_Name = mysql_fetch_assoc(mysql_query("SELECT First_Name from employee where username = '".$search."'"));

$UpdateAvailabilityQuery = mysql_query(" SELECT is_avail FROM emp_availability WHERE emp_id = '".$emp_id['emp_id']."' ORDER BY time_availability_id ");

// Query to get max availability_id for specific employee

if (isset($_POST['UpdateAvailabilityButton'])) {
  for ($i = 1; $i < 46; $i++) {
    if (isset($_POST['UpdateAvailabilityButton']) && $_POST['UpdateAvailability'.$i] == 'true' ) {
      $UpdateAvailabilityQuery = " UPDATE emp_availability
                                   SET is_avail = '1'
                                   WHERE time_availability_id = '". $i . "' and emp_id = (select emp_id from employee where username = '". $search ."') ";
      mysql_query($UpdateAvailabilityQuery, $connection);
      header("Location: ./availability.php");                       
    } else {
          $UpdateAvailabilityQueryUnchecked = " UPDATE emp_availability
                                   SET is_avail = '0'
                                   WHERE time_availability_id = '". $i . "' and emp_id = (select emp_id from employee where username = '". $search ."') ";
      mysql_query($UpdateAvailabilityQueryUnchecked, $connection); 
      header("Location: ./availability.php");
    }
  }
}

/* End Availability Update */

/* Start Time Clock Query */

	if (isset($_POST['ClockIn'])) {
			$InsertQuery="INSERT INTO `time_clock` (`Clock_in_Time`, `Date`, `Emp_ID`) VALUES (curtime(), curdate(), 
 			(select emp_id from employee where Emp_ID = '$emp_id[emp_id]'));";
			mysql_query($InsertQuery, $connection);
			header("Location: ./timeclock.php");
			//echo "clocked in";
			exit;
  };
  	if (isset($_POST['ClockIn'])) {
  			$InsertQuery="INSERT INTO `time_clock` (`Clock_in_Time`, `Date`, `Emp_ID`) VALUES (curtime(), curdate(), 
   			(select emp_id from user_profile where User_ID = '$_POST[hidden]'));";
  			mysql_query($InsertQuery, $connection);
  			header("Location: ./timeclock.php");
  			//echo "clocked in";
  			exit;
	};

	if (isset($_POST['ClockOut'])){
		$ClockoutUpdateQuery="UPDATE time_clock SET Clock_out_Time = curtime() where Emp_id = '$emp_id[emp_id]' and Date = curdate()";
		mysql_query($ClockoutUpdateQuery, $connection);
		header("Location: ./timeclock.php");
		exit;
	}
  //$clockedin = "select null from time_clock where emp_id = (select emp_id from employee where username = "'.$search.'"') and clock_out_time is NULL"
  $clockedinquery= mysql_query("SELECT null from `time_clock` where emp_id = '$emp_id[emp_id]' and clock_out_time is NULL");
  $checkifclockedin = mysql_num_rows($clockedinquery);

  $displayClockintime = mysql_query("SELECT * from time_clock where emp_id = '$emp_id[emp_id]' and Date = curdate() order by Clock_in_time desc limit 1");
  $clockintimedisplay = mysql_fetch_array($displayClockintime);

/* End Time Clock Query */
/**********************************/

/* Start Request Off Query */

$requestoffdate = $_POST['requestoffdate'];
$requestoffreason = $_POST['requestoffreason'];

if (isset($_POST['RequestOffButton'])) {
  $RequestOff = " INSERT INTO request_off (Emp_ID, Request_Off_Date, Reason) 
                  VALUES ('$emp_id[emp_id]','$requestoffdate','$requestoffreason') ";
  mysql_query($RequestOff, $connection);
  header("Location: ./requesttimeoff.php");
}

/* End Request Off Query */


/* Start Report Query */

$ReportQuery = "SELECT up.tech_id as Tech_ID, up.First_Name, up.Last_Name, e.reference_code as Reference_Code, pr.pay_rate as Pay_Rate, COALESCE(t1.total_hours,0) as Total_Hours, COALESCE(round((pr.pay_rate * t1.pay_hours),2),0) as Total_Pay
                from employee up left join 
                (select emp_id, time(sum(SUBTIME(clock_out_time,clock_in_time))) as total_hours, (time_to_sec(sum(SUBTIME(clock_out_time,clock_in_time)))/3600.0) as pay_hours
                 from time_clock group by emp_id) t1 on t1.emp_id = up.emp_id
                join employee e on e.emp_id = up.emp_id
                join pay_rate pr on e.reference_code = pr.reference_code
                ORDER BY up.Last_Name";
$ReportQuery = mysql_query($ReportQuery) or die(mysql_error());

/* End Report Query */


/* Start TimeSheet Query */
$timesheetquery = mysql_query("SELECT Date , clock_in_time, clock_out_time, timediff(concat(date, ' ',clock_out_time), concat(date,' ',clock_in_time))as hours FROM time_clock where emp_id = '".$emp_id['emp_id']."'");
/* End TimeSheet Query */

/* Start Generate Schedule Query */
if (isset($_POST['GenerateSchedulebutton'])){
  $q1counter = mysql_query("SELECT rank_id from day");
      while ($row1 = mysql_fetch_array($q1counter, MYSQL_BOTH)){
        //printf("rank_ID: %s", $row1["rank_id"]);
        
        $q2counter = mysql_query("SELECT time_id from time");
        while ($row2 = mysql_fetch_array($q2counter, MYSQL_BOTH)){
          //printf("time_id: %s", $row2["time_id"]); echo "<br/>";
          $insert_query = mysql_query("SELECT t1.emp_id,t1.work_date, t1.emp_start_time, t1.emp_end_time, t1.all_day, t1.week_num
                        from 
                        (SELECT ea.emp_id,t.start_time as emp_start_time, t.end_time as emp_end_time,
                         null as all_day, week(curdate())+1 as week_num,
                        (case when d.day = 'Monday' then (select makedate(2013, (week(curdate())+1) * 7))
                        when d.day = 'Tuesday' then (select makedate(2013, (week(curdate())+1) * 7.05))
                        when d.day = 'Wednesday' then (select makedate(2013, (week(curdate())+1) * 7.1))
                        when d.day = 'Thursday' then (select makedate(2013, (week(curdate())+1) * 7.15))
                        when d.day = 'Friday' then (select makedate(2013, (week(curdate())+1) * 7.2))
                        else null end) as work_date
                        from emp_availability ea join time_availability ta on ta.time_availability_id = ea.time_availability_id join
                        day d  on ta.day_id = d.day_id join time t on t.time_id = ta.time_id 
                        where ta.time_id = '".$row2['time_id']."' and d.rank_id = '".$row1['rank_id']."' and is_avail = '1' 
                        order by d.day_id) t1
                        where t1.work_date not in (select request_off_date from request_off where emp_id = t1.emp_id)");
          $colnum= mysql_fetch_row($insert_query);
          //echo $colnum[0]."     ".$colnum[1]."     ".$colnum[2]."     ".$colnum[3]."     ".$colnum[4]."     ".$colnum[5]."<br/>"; 
          //echo "&nbsp&nbsp&nbsp colnum output is:".$colnum[1]."     ".$colnum[2]."     ".$colnum[3]."<br/>";
          $q3 = mysql_query("SELECT count(emp_id) as emp_count from schedule group by work_date, emp_start_time, emp_end_time
                             having work_date = (select (case when d.day = 'Monday' then (select makedate(2013, (week(curdate())+1) * 7))
                             when d.day = 'Tuesday' then (select makedate(2013, (week(curdate())+1) * 7.05))
                             when d.day = 'Wednesday' then (select makedate(2013, (week(curdate())+1) * 7.1))
                             when d.day = 'Thursday' then (select makedate(2013, (week(curdate())+1) * 7.15))
                             when d.day = 'Friday' then (select makedate(2013, (week(curdate())+1) * 7.2))
                             else null end) as work_date 
                             from day d where rank_id = '".$row1['rank_id']."') 
                             and emp_start_time = (select start_time from time where time_id = '".$row2['time_id']."')
                             and emp_end_time = (select end_time from time where time_id = '".$row2['time_id']."');");

          //$test= mysql_fetch_assoc($q3);
          unset($q3array);
          $q3array = array();
          while ($q3row = mysql_fetch_assoc($q3)){
            $q3array [] = $q3row['emp_count'];
          }
          if($q3array[0] == ""){
            unset($q3array);
            $q3array = array(0=>'0');
          }
          //echo "&nbsp&nbsp&nbsp number of employees already scheduled is:".$q3array [0]."<br/>";
          //mysql_free_result($q3);
          
            unset($array);
            $array = array();
            while ($row = mysql_fetch_assoc($insert_query)){
              $array[] = $row['emp_id'];
            }  

            shuffle($array);
            //echo "&nbsp&nbsp&nbsp number of employees available is:".sizeof($array)."<br/>";
            $max = sizeof($array);
              //for ($i =0; $i < $max; $i++) {
           
                if (sizeof($array) !== 0){
                unset($counter);
                $counter = 0;
                unset($insertCounter);
                $insertCounter = 0;
                while ($q3array[0] < 2 && $counter <sizeof($array) && $insertCounter < 2){//$q3array[0] <2){
                   
                  //echo "&nbsp&nbsp&nbsp employees that are available are:";
                  //printf($array[$counter]);
                  //echo "<br/>";
                  $q3 = mysql_query("SELECT count(emp_id) from schedule 
                          where emp_id = '".$colnum[0]."' 
                          and work_date = '".$colnum[1]."' 
                          and emp_start_time = '".$colnum[2]."' 
                          and emp_end_time = '".$colnum[3]."'");

                  if (mysql_result($q3, 0) == 0){
                    $q4 = mysql_query("SELECT count(schedule_id) from schedule where emp_id = '".$colnum[0]."' and week_num = '".$colnum[5]."'");
                    if (mysql_result($q4, 0) < 20){
                      $finalINSERTQUERY = mysql_query("SELECT ea.emp_id,(case when d.day = 'Monday' then (select makedate(2013, (week(curdate())+1) * 7))
                                                      when d.day = 'Tuesday' then (select makedate(2013, (week(curdate())+1) * 7.05))
                                                      when d.day = 'Wednesday' then (select makedate(2013, (week(curdate())+1) * 7.1))
                                                      when d.day = 'Thursday' then (select makedate(2013, (week(curdate())+1) * 7.15))
                                                      when d.day = 'Friday' then (select makedate(2013, (week(curdate())+1) * 7.2))
                                                      else null end) as work_date,
                                                      t.start_time as emp_start_time, t.end_time as emp_end_time,
                                                       null as all_day, week(curdate())+1 as week_num
                                                      from emp_availability ea join time_availability ta on ta.time_availability_id = ea.time_availability_id join
                                                      day d  on ta.day_id = d.day_id join time t on t.time_id = ta.time_id 
                                                      where ta.time_id = '".$row2['time_id']."' and d.rank_id = '".$row1['rank_id']."' 
                                                      and is_avail = '1' and ea.emp_id = '".$array[$counter]."'
                                                      order by d.day_id");
                      $finalcol = mysql_fetch_row($finalINSERTQUERY);
                      //echo $finalcol[0]."     ".$finalcol[1]."     ".$finalcol[2]."     ".$finalcol[3]."     ".$finalcol[4]."     ".$finalcol[5]." "."<br/>";
                      $v="INSERT INTO schedule (Emp_ID, work_date, Emp_Start_Time, Emp_End_Time, all_Day, week_num) VALUES
                                  ('".$finalcol[0]."','".$finalcol[1]."','".$finalcol[2]."','".$finalcol[3]."','".$finalcol[4]."','".$finalcol[5]."')";
                      //printf("Last inserted record has id %d\n", mysql_insert_id());
                      mysql_query($v,$connection) or die("Couldn't execute query. ". mysql_error());

                      //echo mysql_result($q4,0)."<br/>";
                      $insertCounter++;
                    }
                  }
                  $counter++; 
                  
              }
            }
          //}
        }
        mysql_free_result($q2comunter);
        mysql_free_result($q3);
        
      }
      mysql_free_result($q1counter);
  header("Location: ./ical.php");
}

/* End Generate Schedule */

/* Manage Employees Start */

$id = addslashes($_REQUEST['id']);
$EditEmployees = mysql_fetch_array(mysql_query('SELECT * FROM `employee` WHERE `Emp_ID` = "'.$id.'"'));
$timesheet = mysql_query("SELECT Date , clock_in_time, clock_out_time, timediff(concat(date, ' ',clock_out_time), concat(date,' ',clock_in_time))as hours FROM time_clock where emp_id = '".$id."'");

$ManageEmployees = mysql_query(" SELECT Image_Location, First_Name, Last_Name,Emp_ID FROM employee ");

if(isset($_POST['AddEmployee'])) {
$AddEmployee = "INSERT INTO employee
                SET Username = '$username', First_Name = '$fname', Last_Name = '$lname', Rank = 'Employee', Start_Date = curdate(), Reference_Code = 'C1', 
                Email = '$email', Image_Location = '/img/default.jpg', Phone_Number = '$phonenumber', Tech_ID = '$techid' ";
$AddEmployeePassword = " INSERT INTO password SET password = '$password', emp_id = (SELECT max(emp_id) FROM employee), Create_Date = curdate() ";
mysql_query($AddEmployee, $connection);
mysql_query($AddEmployeePassword, $connection);
header("Location: ./ManageEmployees.php");

};

/* Manage Employees End */

/* Start Available Shifts Queries */

//current week shifts
$CurWeek = mysql_query (" SELECT * from
                          (select work_date, emp_start_time, emp_end_time
                          from schedule s   
                          where s.week_num = week(curdate())
                          and concat(work_date, ' ', emp_start_time >= curtime()) >= now()
                          group by s.work_date, s.emp_start_time, s.emp_end_time
                          having count(emp_id) = '1'

                          UNION
                          select distinct((case when d.day = 'Monday' then (select makedate(2013, (week(curdate())) * 7))
                                                  when d.day = 'Tuesday' then (select makedate(2013, (week(curdate())) * 7.05))
                                                  when d.day = 'Wednesday' then (select makedate(2013, (week(curdate())) * 7.1))
                                                  when d.day = 'Thursday' then (select makedate(2013, (week(curdate())) * 7.15))
                                                  when d.day = 'Friday' then (select makedate(2013, (week(curdate())) * 7.2))
                                                  else null end)) as work_date, t.start_time, t.end_time
                          from time_availability ta join time t on t.time_id = ta.time_id
                          join day d on d.day_id = ta.day_id 
                          where ((case when d.day = 'Monday' then (select makedate(2013, (week(curdate())) * 7))
                                                  when d.day = 'Tuesday' then (select makedate(2013, (week(curdate())) * 7.05))
                                                  when d.day = 'Wednesday' then (select makedate(2013, (week(curdate())) * 7.1))
                                                  when d.day = 'Thursday' then (select makedate(2013, (week(curdate())) * 7.15))
                                                  when d.day = 'Friday' then (select makedate(2013, (week(curdate())) * 7.2))
                                                  else null end), t.start_time, t.end_time) not in (
                          select work_date, emp_start_time, emp_end_time
                          from schedule s   
                          where s.week_num = week(curdate())
                          group by s.work_date, s.emp_start_time, s.emp_end_time))t1
                          where concat(t1.work_date, ' ', t1.emp_start_time) >=now()
                          order by t1.work_date
                          ");

//next weeks shifts

$NextWeek = mysql_query (" SELECT * from
                          (select work_date, emp_start_time, emp_end_time
                          from schedule s   
                          where s.week_num = week(curdate())+1
                          and concat(work_date, ' ', emp_start_time >= curtime()) >= now()
                          group by s.work_date, s.emp_start_time, s.emp_end_time
                          having count(emp_id) = '1'

                          UNION
                          select distinct((case when d.day = 'Monday' then (select makedate(2013, (week(curdate())+1) * 7))
                                                  when d.day = 'Tuesday' then (select makedate(2013, (week(curdate())+1) * 7.05))
                                                  when d.day = 'Wednesday' then (select makedate(2013, (week(curdate())+1) * 7.1))
                                                  when d.day = 'Thursday' then (select makedate(2013, (week(curdate())+1) * 7.15))
                                                  when d.day = 'Friday' then (select makedate(2013, (week(curdate())+1) * 7.2))
                                                  else null end)) as work_date, t.start_time, t.end_time
                          from time_availability ta join time t on t.time_id = ta.time_id
                          join day d on d.day_id = ta.day_id 
                          where ((case when d.day = 'Monday' then (select makedate(2013, (week(curdate())+1) * 7))
                                                  when d.day = 'Tuesday' then (select makedate(2013, (week(curdate())+1) * 7.05))
                                                  when d.day = 'Wednesday' then (select makedate(2013, (week(curdate())+1) * 7.1))
                                                  when d.day = 'Thursday' then (select makedate(2013, (week(curdate())+1) * 7.15))
                                                  when d.day = 'Friday' then (select makedate(2013, (week(curdate())+1) * 7.2))
                                                  else null end), t.start_time, t.end_time) not in (
                          select work_date, emp_start_time, emp_end_time
                          from schedule s   
                          where s.week_num = week(curdate())+1
                          group by s.work_date, s.emp_start_time, s.emp_end_time))t1
                          where concat(t1.work_date, ' ', t1.emp_start_time) >=now()
                          order by t1.work_date
                          ");


/* End Available Shifts Queries */

/* Edit Schedule Start */

$Schedule = mysql_query(" SELECT s.Emp_ID, e.First_Name, e.Last_Name, s.Work_Date, s.Emp_Start_Time, s.Emp_End_Time, s.Week_Num
                          FROM schedule s join employee e
                          WHERE s.emp_id = e.emp_id
                          AND s.week_num = week(curdate())
                          ORDER BY s.work_date, s.emp_start_time ");

/* Edit Schedule End */

?>
