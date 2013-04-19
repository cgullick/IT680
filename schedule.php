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
                events: './myevents.php',

                // editable:true
                
            })
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
          <a class="brand" href="#">Project name</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link"><?php echo $_SESSION['username']."<a href='logout.php'> Log out </a>"; ?></a>
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
                    <li><a href="#">My Availability Calendar</a></li>
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
                    <li><a href="#">My Schedule</a></li>
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
              <li class="actice"><a href="#">My Schedule</a></li>
              <li><a href="./schedule.php">Whole Schedule</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
        <div class="span9">
          <div class="page-header">
            <h1>Schedule</h1>
            <p>This displays your schedule</p>

            <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
          </div>
          <div id='calendar'></div>


      </div><!--row-fluid-->

            <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
          </div>
          <div class="row-fluid">
          <div class="span12" id='calendar'></div>
          <!--<img src="sav.png" width="150" height="150">-->
          <div class="row-fluid">
            
          <div>


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
