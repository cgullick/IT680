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

            $('#availability').fullCalendar({
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
                contentHeight:422,
                eventClick: function(calEvent, jsEvent, view) { 
                  alert('Event: ' + calEvent.title +'\n Start Time: ' + calEvent.start +'\n End Time: '+ calEvent.end);
                  // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                  // alert('View: ' + view.name);

                  // change the border color just for fun
                  //$(this).css('border-color', 'red');

                },
                events: './EmployeeAvailEvents.php',

                // editable:true
                
            }),
            $('#schedule').fullCalendar({
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
                            contentHeight:422,
                            eventClick: function(calEvent, jsEvent, view) { 
                              alert('Event: ' + calEvent.title +'\n Start Time: ' + calEvent.start +'\n End Time: '+ calEvent.end);
                              // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                              // alert('View: ' + view.name);

                              // change the border color just for fun
                              //$(this).css('border-color', 'red');

                            },
                            events: './myevents.php',

                            // editable:true
                            
                        }),
            $('#availability').fullCalendar('next');
            $('#schedule').fullCalendar('next');



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
                  Schedule  
                <b class="caret"></b>  
                </a>  
                  <ul class="dropdown-menu">
                    <li><a href="./managerschedule.php">View Schedule</a></li>
                    <li><a href="./generateschedule.php">Generate Schedule</a></li>
                  </ul>
              </li>
              <li class="dropdown">  
                <a href="#"  
                  class="dropdown-toggle"  
                  data-toggle="dropdown">  
                  Reports  
                <b class="caret"></b>  
                </a>  
                  <ul class="dropdown-menu">
                    <li><a href="./report.php">Reports</a></li>
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
      <div class="span6">
        <table class="table table-bordered">
          <caption> <h3>General Info</h3></caption>
            <td>
            <table class="table table-bordered">
                <tr>
                    <td><?php echo "<img src='$EditEmployees[Image_Location]' width='100' height='100'>"; ?></td>
                </tr>
                <tr>
                  <p><td style="font-weight:bold">First Name: 
                      <?php echo $EditEmployees['First_Name']; ?></td>
                </tr>
                <tr>
                      <td style="font-weight:bold">Last Name: 
                      <?php echo $EditEmployees['Last_Name']; ?></td>
                </tr>
                 <tr>
                    <td style="font-weight:bold">Email: 
                    <?php echo $EditEmployees['Email']; ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Phone Number: 
                    <?php echo $EditEmployees['Phone_Number']; ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Rank: 
                    <?php echo $EditEmployees['Rank']; ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Address: 
                    <?php echo $EditEmployees['Address']; ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">City: 
                    <?php echo $EditEmployees['City']; ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">State: 
                    <?php echo $EditEmployees['State']; ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Zip: 
                    <?php echo $EditEmployees['Zip']; ?></td>
                  </tr> 
           </table>
            </td>
        </table>
    </div><!--span-->
      <div class="span6">
        <table class="table table-bordered">
          <caption><h3>Availability</h3></caption>
          <thead>
            <tr>
              <td><div id="availability"></div></td>
            </tr>
          </tbody>
        </table>
    </div><!--span-->
</div><!--Row close-->
<div class="row-fluid">
      <div class="span6">
        <table class="table table-bordered">
          <caption><h3>Schedule</h3></caption>
          <thead>
           <tr>
            <td><div id="schedule"></div></td>
            </tr>
          </tbody>
        </table>
    </div><!--span-->
      <div class="span6">
        <table class="table table-bordered">
          <caption><h3>Timesheet</h3></caption>
          <thead>
            <tr>
              <td>
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
              </td>
            </tr>
          </tbody>
        </table>
    </div><!--span-->
</div><!--Row close-->
</div><!--Container close-->

