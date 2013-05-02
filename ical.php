<?php
# Connect to the database
$host     = "64.254.188.188";
$dbuser   = "it680";
$dbpasswd = "it680";
$database = "scheduling_database";
$connect  = mysql_connect($host, $dbuser, $dbpasswd) or die(mysql_error());
mysql_select_db($database,$connect) or die(mysql_error());


# Query the database and get the results
$sql      = "SELECT Schedule_ID, work_date, Emp_Start_Time, Emp_End_Time, concat(e.First_Name, ' ', e.Last_Name) as Employee
             from schedule s join employee e on e.emp_id = s.emp_id ";
$result   = mysql_query($sql);
$nresult  = mysql_num_rows($result);



$ics_contents  = "BEGIN:VCALENDAR\n";
$ics_contents .= "VERSION:2.0\n";
$ics_contents .= "PRODID:PHP\n";
$ics_contents .= "METHOD:PUBLISH\n";
$ics_contents .= "X-WR-CALNAME:Schedule\n";
 
# Change the timezone as well daylight settings if need be
$ics_contents .= "X-WR-TIMEZONE:America/Chicago\n";
$ics_contents .= "BEGIN:VTIMEZONE\n";
$ics_contents .= "TZID:America/Chicago\n";
$ics_contents .= "BEGIN:DAYLIGHT\n";
$ics_contents .= "TZOFFSETFROM:-0500\n";
$ics_contents .= "TZOFFSETTO:-0400\n";
$ics_contents .= "DTSTART:20070311T020000\n";
$ics_contents .= "RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=2SU\n";
$ics_contents .= "TZNAME:EDT\n";
$ics_contents .= "END:DAYLIGHT\n";
$ics_contents .= "BEGIN:STANDARD\n";
$ics_contents .= "TZOFFSETFROM:-0400\n";
$ics_contents .= "TZOFFSETTO:-0500\n";
$ics_contents .= "DTSTART:20071104T020000\n";
$ics_contents .= "RRULE:FREQ=YEARLY;BYMONTH=11;BYDAY=1SU\n";
$ics_contents .= "TZNAME:EST\n";
$ics_contents .= "END:STANDARD\n";
$ics_contents .= "END:VTIMEZONE\n";



while ($schedule_details = mysql_fetch_assoc($result)) {
  $id            = $schedule_details['Schedule_ID'];
  $start_date    = $schedule_details['work_date'];
  $start_time    = $schedule_details['Emp_Start_Time'];
  $end_date      = $schedule_details['work_date'];
  $end_time      = $schedule_details['Emp_End_Time'];
  //$category      = $schedule_details['Category'];
  $name          = $schedule_details['Employee'];
  //$location      = $schedule_details['Location'];
  //$description   = $schedule_details['Emp_ID'];
 
  # Remove '-' in $start_date and $end_date
  $estart_date   = str_replace("-", "", $start_date);
  $eend_date     = str_replace("-", "", $end_date);
 
  # Remove ':' in $start_time and $end_time
  $estart_time   = str_replace(":", "", $start_time);
  $eend_time     = str_replace(":", "", $end_time);
 
  # Replace some HTML tags
  $name          = str_replace("<br>", "\\n",   $name);
  $name          = str_replace("&amp;", "&",    $name);
  $name          = str_replace("&rarr;", "-->", $name);
  $name          = str_replace("&larr;", "<--", $name);
  $name          = str_replace(",", "\\,",      $name);
  $name          = str_replace(";", "\\;",      $name);
 
  // $location      = str_replace("<br>", "\\n",   $location);
  // $location      = str_replace("&amp;", "&",    $location);
  // $location      = str_replace("&rarr;", "-->", $location);
  // $location      = str_replace("&larr;", "<--", $location);
  // $location      = str_replace(",", "\\,",      $location);
  // $location      = str_replace(";", "\\;",      $location);
 
  // $description   = str_replace("<br>", "\\n",   $description);
  // $description   = str_replace("&amp;", "&",    $description);
  // $description   = str_replace("&rarr;", "-->", $description);
  // $description   = str_replace("&larr;", "<--", $description);
  // $description   = str_replace("<em>", "",      $description);
  // $description   = str_replace("</em>", "",     $description);
 
  # Change TZID if need be
  $ics_contents .= "BEGIN:VEVENT\n";
  $ics_contents .= "DTSTART:"     . $estart_date . "T". $estart_time . "\n";
  $ics_contents .= "DTEND:"       . $eend_date . "T". $eend_time . "\n";
  $ics_contents .= "DTSTAMP:"     . date('Ymd') . "T". date('His') . "Z\n";
  $ics_contents .= "LOCATION:"    . "Front Desk" . "\n";
  $ics_contents .= "DESCRIPTION:" . "Work" . "\n";
  $ics_contents .= "SUMMARY:"     . $name . "\n";
  $ics_contents .= "UID:"         . $id . "\n";
  $ics_contents .= "SEQUENCE:0\n";
  $ics_contents .= "END:VEVENT\n";
}


$ics_contents .= "END:VCALENDAR\n";
 
# File to write the contents
$ics_file   = 'schedule.ics';
 
if (is_writable($ics_file)) {
  if (!$handle = fopen($ics_file, 'w')) {
     echo "Cannot open file ($ics_file)\n\n";
     exit;
  }
 
  # Write $ics_contents to opened file
  if (fwrite($handle, $ics_contents) === FALSE) {
    echo "Cannot write to file ($ics_file)\n\n";
    exit;
  }
 
   //echo "Success, wrote to <b>schedule.ics</b><br>\n\n";
  header("Location: ./generateschedule.php");

  fclose($handle);
 
} else {
  echo "The file <b>$ics_file</b> is not writable\n\n";
}


?>