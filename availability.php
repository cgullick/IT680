<?php

session_start();

include 'dbconnect.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Maverick EMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
    
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tab.js"></script>

    <script src="./js/jquery-1.9.1.js"></script>
    <script src="./js/jquery-1.9.1.min.js"></script> 
    <script src="./js/bootstrap.js"></script>

    <!-- Full Calender -->
    <link rel='stylesheet' type='text/css' href='/js/fullcalendar-1.6.0/fullcalendar/fullcalendar.css' />
    <script type='text/javascript' src='/js/fullcalendar-1.6.0/jquery/jquery-1.9.1.min.js'></script>
    <script type='text/javascript' src='/js/fullcalendar-1.6.0/jquery/jquery-ui-1.10.2.custom.min.js'></script>
    <script type='text/javascript' src='/js/fullcalendar-1.6.0/fullcalendar/fullcalendar.min.js'></script>
    <script>
            $(document).ready(function() {

              /* initialize the external events
    -----------------------------------------------------------------*/
  
            $('#external-events div.external-event').each(function() {
            
              // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
              // it doesn't need to have a start or end
              var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
              };
              
              // store the Event Object in the DOM element so we can get to it later
              $(this).data('eventObject', eventObject);
              
              // make the event draggable using jQuery UI
              $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
              });
              
            });


            // page is now ready, initialize the calendar...

            $('#calendar').fullCalendar({
                // put your options and callbacks here
                header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay'
                },
                defaultView:'agendaWeek',
                minTime:'08:00',
                maxTime:'17:00',
                weekends:false,
                allDaySlot:false,
                weekNumbers:true,
                contentHeight:490,
                eventClick: function(calEvent, jsEvent, view) { 
                  alert('Event: ' + calEvent.title +'\n Start Time: ' + calEvent.start +'\n End Time: '+ calEvent.end);
                  // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                  // alert('View: ' + view.name);

                  // change the border color just for fun
                  //$(this).css('border-color', 'red');

                },
                events: './myavailabilityevents.php',

                // editable:true
                
            }),
            $('#calendar').fullCalendar('next');

        });
    </script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Maverick EMS</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link"><?php echo $_SESSION['username']."<a href='logout.php'>  Log out</a>"; ?></a>
            </p>
            <ul class="nav">
              <li class="active"><a href="./employeenews.php">Home</a></li>
              <!--Start Top Bar Dropdown-->
              <li class="dropdown">  
                <a href="#"  
                  class="dropdown-toggle"  
                  data-toggle="dropdown">  
                  Profile  
                <b class="caret"></b>  
                </a>  
                  <ul class="dropdown-menu">  
                    <li><a href="./employee.php">Profile</a></li> 
                    <li><a href="./editprofile.php">Edit Profile</a></li>   
                  </ul>  
              </li>
              <li class="dropdown">  
                <a href="#"  
                  class="dropdown-toggle"  
                  data-toggle="dropdown">  
                  Availability  
                <b class="caret"></b>  
                </a>  
                  <ul class="dropdown-menu">
                    <li><a href="./MyAvailabilityCalendar.php">My Availability Calendar</a></li>
                    <li><a href="./availability.php">Update Availability</a></li>
                    <li><a href="./requesttimeoff.php">Request Off</a></li>
                  </ul>
              </li> 
              <li class="dropdown">  
                <a href="#"  
                  class="dropdown-toggle"  
                  data-toggle="dropdown">  
                  Schedule  
                <b class="caret"></b>  
                </a>  
                  <ul class="dropdown-menu">
                    <li><a href="./myschedule.php">My Schedule</a></li>
                    <li><a href="./schedule.php">Whole Schedule</a></li>
                  </ul>
              </li>
              <li class="dropdown">  
                <a href="#"  
                  class="dropdown-toggle"  
                  data-toggle="dropdown">  
                  Time  
                <b class="caret"></b>  
                </a>  
                  <ul class="dropdown-menu">
                    <li><a href="./timeclock.php">Time Clock</a></li>
                    <li><a href="./timesheet.php">Timesheet</a></li>
                  </ul>
              </li> 
              <!-- End Top Bar Dropdown -->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Navigation Bar</li>
              <li class="actice"><a href="#">My Availability Calendar</a></li>
              <li><a href="./availability.php">Update Availabilty</a></li>
              <li><a href="./requesttimeoff.php">Request Off</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h1>Availability</h1>
            <p>Here you can update your availability</p>

            <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
          </div>

          <div class="row-fluid">

          <form action="availability.php" method="POST">

        <div class="tabbable">
           <ul class="nav nav-tabs">
             <li class="active"><a href="#Monday" data-toggle="tab">Monday</a></li>
             <li><a href="#Tuesday" data-toggle="tab">Tuesday</a></li>
             <li><a href="#Wednesday" data-toggle="tab">Wednesday</a></li>
             <li><a href="#Thursday" data-toggle="tab">Thursday</a></li>
             <li><a href="#Friday" data-toggle="tab">Friday</a></li>
           </ul>
           <div class="tab-content">
               <div id="Monday" class="tab-pane active">

              <!-- Toggle All Javascript -->
              <script language="JavaScript">
              function toggleMonday(source) {
                for (var x=1; x<10; x++) {
                  checkboxes = document.getElementsByName('UpdateAvailability'+x);
                  for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = source.checked;
                  }
                }
              }
              function toggleTuesday(source) {
                for (var x=10; x<19; x++) {
                  checkboxes = document.getElementsByName('UpdateAvailability'+x);
                  for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = source.checked;
                  }
                }
              }
              function toggleWednesday(source) {
                for (var x=19; x<28; x++) {
                  checkboxes = document.getElementsByName('UpdateAvailability'+x);
                  for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = source.checked;
                  }
                }
              }
              function toggleThursday(source) {
                for (var x=28; x<37; x++) {
                  checkboxes = document.getElementsByName('UpdateAvailability'+x);
                  for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = source.checked;
                  }
                }
              }
              function toggleFriday(source) {
                for (var x=37; x<46; x++) {
                  checkboxes = document.getElementsByName('UpdateAvailability'+x);
                  for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = source.checked;
                  }
                }
              }
              </script>

               <pre><table>
              <tr>
                <th>Start Time&nbsp</th>
                <th>&nbspEnd Time&nbsp</th>
                <th>Check All<input type="checkbox" onClick="toggleMonday(this)" /></th>
              
              </tr>
              <tr>
                <td>8:00am</td>
                <td>9:00am</td>
                <td><input type="checkbox" name="UpdateAvailability1" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 0) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>9:00am</td>
                <td>10:00am</td>
                <td><input type="checkbox" name="UpdateAvailability2" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 1) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>10:00am</td>
                <td>11:00am</td>
                <td><input type="checkbox" name="UpdateAvailability3" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 2) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>11:00am</td>
                <td>12:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability4" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 3) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>12:00pm</td>
                <td>1:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability5" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 4) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>1:00pm</td>
                <td>2:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability6" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 5) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>2:00pm</td>
                <td>3:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability7" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 6) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>3:00pm</td>
                <td>4:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability8" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 7) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>4:00pm</td>
                <td>5:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability9" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 8) == '1') echo "checked='checked'"; ?>></td>
              </tr>
            </table></pre>
              </div>

               <div id="Tuesday" class="tab-pane">

               <pre><table>
              <tr>
                <th>Start Time&nbsp</th>
                <th>&nbspEnd Time&nbsp</th>
                <th>Check All<input type="checkbox" onClick="toggleTuesday(this)" /></th>
              </tr>
              <tr>
                <td>8:00am</td>
                <td>9:00am</td>
                <td><input type="checkbox" name="UpdateAvailability10" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 9) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>9:00am</td>
                <td>10:00am</td>
                <td><input type="checkbox" name="UpdateAvailability11" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 10) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>10:00am</td>
                <td>11:00am</td>
                <td><input type="checkbox" name="UpdateAvailability12" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 11) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>11:00am</td>
                <td>12:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability13" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 12) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>12:00pm</td>
                <td>1:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability14" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 13) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>1:00pm</td>
                <td>2:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability15" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 14) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>2:00pm</td>
                <td>3:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability16" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 15) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>3:00pm</td>
                <td>4:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability17" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 16) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>4:00pm</td>
                <td>5:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability18" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 17) == '1') echo "checked='checked'"; ?>></td>
              </tr>
            </table></pre>
              </div>

              <div id="Wednesday" class="tab-pane">
               <pre><table>
              <tr>
                <th>Start Time&nbsp</th>
                <th>&nbspEnd Time&nbsp</th>
                <th>Check All<input type="checkbox" onClick="toggleWednesday(this)" /></th>
              </tr>
              <tr>
                <td>8:00am</td>
                <td>9:00am</td>
                <td><input type="checkbox" name="UpdateAvailability19" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 18) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>9:00am</td>
                <td>10:00am</td>
                <td><input type="checkbox" name="UpdateAvailability20" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 19) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>10:00am</td>
                <td>11:00am</td>
                <td><input type="checkbox" name="UpdateAvailability21" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 20) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>11:00am</td>
                <td>12:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability22" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 21) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>12:00pm</td>
                <td>1:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability23" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 22) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>1:00pm</td>
                <td>2:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability24" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 23) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>2:00pm</td>
                <td>3:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability25" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 24) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>3:00pm</td>
                <td>4:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability26" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 25) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>4:00pm</td>
                <td>5:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability27" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 26) == '1') echo "checked='checked'"; ?>></td>
              </tr>
            </table></pre>
              </div>

              <div id="Thursday" class="tab-pane">
               <pre><table>
              <tr>
                <th>Start Time&nbsp</th>
                <th>&nbspEnd Time&nbsp</th>
                <th>Check All<input type="checkbox" onClick="toggleThursday(this)" /></th>
              </tr>
              <tr>
                <td>8:00am</td>
                <td>9:00am</td>
                <td><input type="checkbox" name="UpdateAvailability28" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 27) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>9:00am</td>
                <td>10:00am</td>
                <td><input type="checkbox" name="UpdateAvailability29" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 28) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>10:00am</td>
                <td>11:00am</td>
                <td><input type="checkbox" name="UpdateAvailability30" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 29) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>11:00am</td>
                <td>12:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability31" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 30) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>12:00pm</td>
                <td>1:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability32" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 31) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>1:00pm</td>
                <td>2:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability33" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 32) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>2:00pm</td>
                <td>3:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability34" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 33) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>3:00pm</td>
                <td>4:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability35" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 34) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>4:00pm</td>
                <td>5:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability36" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 35) == '1') echo "checked='checked'"; ?>></td>
              </tr>
            </table></pre>
              </div>

              <div id="Friday" class="tab-pane">
               <pre><table>
              <tr>
                <th>Start Time&nbsp</th>
                <th>&nbspEnd Time&nbsp</th>
                <th>Check All<input type="checkbox" onClick="toggleFriday(this)" /></th>
              </tr>
              <tr>
                <td>8:00am</td>
                <td>9:00am</td>
                <td><input type="checkbox" name="UpdateAvailability37" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 36) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>9:00am</td>
                <td>10:00am</td>
                <td><input type="checkbox" name="UpdateAvailability38" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 37) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>10:00am</td>
                <td>11:00am</td>
                <td><input type="checkbox" name="UpdateAvailability39" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 38) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>11:00am</td>
                <td>12:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability40" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 39) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>12:00pm</td>
                <td>1:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability41" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 40) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>1:00pm</td>
                <td>2:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability42" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 41) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>2:00pm</td>
                <td>3:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability43" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 42) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>3:00pm</td>
                <td>4:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability44" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 43) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>4:00pm</td>
                <td>5:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability45" value="true"<?php if(mysql_result($UpdateAvailabilityQuery, 44) == '1') echo "checked='checked'"; ?>></td>
              </tr>
            </table></pre>
              </div>

           </div>
        </div>

          </div>
            
            <input class="btn" type="submit" name="UpdateAvailabilityButton" value="Submit">

            <div class="row-fluid">
          <div class="span12" id='calendar'></div>
          <!--<img src="sav.png" width="150" height="150">-->
          <div class="row-fluid">
            
          <div>

          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->
    </form>

      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery-1.9.1.js"></script>
    <script src="./js/jquery-1.9.1.min.js"></script> 
    <script src="./js/bootstrap.js"></script>

  </body>
</html>
