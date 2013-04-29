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
   <script>
     $(function(){
        $("#tabs").tabs({
          activate: function(event, ui) {
            $("#Availability").fullCalendar('render');
          }
        });
      })();     
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
          <a class="brand" href="./manager.php">Maverick EMS</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link"><?php echo $_SESSION['username']."<a href='logout.php'>  Log out</a>"; ?></a>
            </p>
            <ul class="nav">
              <li class="active"><a href="./manager.php">Home</a></li>
              <!--Start Top Bar Dropdown-->
              <li class="dropdown">  
                <a href="#"  
                  class="dropdown-toggle"  
                  data-toggle="dropdown">  
                  Employees  
                <b class="caret"></b>  
                </a>  
                  <ul class="dropdown-menu">
                    <li><a href="./ManageEmployees.php">Manage Employees</a></li>
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
                    <li><a href="#">My Availability Calendar</a></li>
                    <li><a href="#">Update Availability</a></li>
                    <li><a href="#">Request Off</a></li>
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
                    <li><a href="#">My Schedule</a></li>
                    <li><a href="#">Full Schedule</a></li>
                    <li><a href="./generateschedule.php">Generate Schedule</a></li>
                    <li><a href="./printableschedule.php">Printable Schedule</a></li>
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
                    <li><a href="#">Time Clock</a></li>
                    <li><a href="#">Timesheet</a></li>
                  </ul>
              </li> 
              <!-- End Top Bar Dropdown -->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="tabbable" id="tabs">
           <ul class="nav nav-tabs" >
             <li class="active"><a href="#GeneralInfo" data-toggle="tab">General Info</a></li>
             <li><a href="#Availability" data-toggle="tab">Availability</a></li>
             <li><a href="#Schedule" data-toggle="tab">Schedule</a></li>
             <li><a href="#Timesheet" data-toggle="tab">Timesheet</a></li>
             <li><a href="#Message" data-toggle="tab">Message</a></li>
           </ul>
           <div class="tab-content">
              <div id="GeneralInfo" class="tab-pane active">

                      <table>
                    <tr>
                      <td><?php echo "<img src='$EditEmployees[Image_Location]' width='200' height='200'>"; ?></td>
                    </tr>
                    <tr>
                      <p><td style="font-weight:bold">First Name: </td>
                      <td><?php echo $EditEmployees['First_Name']; ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Last Name: </td>
                      <td><?php echo $EditEmployees['Last_Name']; ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Email: </td>
                      <td><?php echo $EditEmployees['Email']; ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Phone Number: </td>
                      <td><?php echo $EditEmployees['Phone_Number']; ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Rank: </td>
                      <td><?php echo $EditEmployees['Rank']; ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Address: </td>
                      <td><?php echo $EditEmployees['Address']; ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">City: </td>
                      <td><?php echo $EditEmployees['City']; ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">State: </td>
                      <td><?php echo $EditEmployees['State']; ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Zip: </td>
                      <td><?php echo $EditEmployees['Zip']; ?></td>
                    </tr> 
                  </table>
              </div>
              <div id="Availability" class="tab-pane">
                <div id="calendar"></div>
              </div>
              <div id="Schedule" class="tab-pane">
              </div>
              <div id="Timesheet" class="tab-pane">
                <?php
                  echo "<table class=table>
                  <tr>
                  <th>Date</th>
                  <th>Clock In Time</th>
                  <th>Clock Out Time</th>
                  <th>Hours</th>
                  </tr>";

                  while($row = mysql_fetch_array($timesheet))
                  {
                  echo "<tr>";
                  echo "<td>" . $row['Date'] . "</td>";
                  echo "<td>" . $row['clock_in_time'] . "</td>";
                  echo "<td>" . $row['clock_out_time'] . "</td>";
                  echo "<td>" . $row['hours'] . "</td>";
                  echo "</tr>";
                  }
                  echo "</table>";
                ?>
              </div>
           </div>
    </div>


          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
