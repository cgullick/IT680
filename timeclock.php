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
                    <li><a href="./MyAvailability.php">My Availability Calendar</a></li>
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
                    <li><a href="./schedule.php">Full Schedule</a></li>
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
              <li class="actice"><a href="./timeclock.php">Time Clock</a></li>
              <li><a href="./timesheet.php">Timesheet</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h1>Time Clock</h1>
            <p>Here you can clock in and clock out for your shift</p>

            <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
          </div>
          <!--<img src="sav.png" width="150" height="150">-->
          <div class="row-fluid">
            
          <div>
            <!-- Ticker --> 
      <span id=tick2>
      </span>

      <script>
      <!--

      /*By JavaScript Kit
      http://javascriptkit.com
      Credit MUST stay intact for use
      */

      function show2(){
      if (!document.all&&!document.getElementById)
      return
      thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
      var Digital=new Date()
      var hours=Digital.getHours()
      var minutes=Digital.getMinutes()
      var seconds=Digital.getSeconds()
      var dn="PM"
      if (hours<12)
      dn="AM"
      if (hours>12)
      hours=hours-12
      if (hours==0)
      hours=12
      if (minutes<=9)
      minutes="0"+minutes
      if (seconds<=9)
      seconds="0"+seconds
      var ctime=hours+":"+minutes+":"+seconds+" "+dn
      thelement.innerHTML="<b style='font-size:14;color:black;'>"+ctime+"</b>"
      setTimeout("show2()",1000)
      }
      window.onload=show2
      //-->
      </script>

      <script>
          function ConfirmclockIn() {
            var r=confirm("Are you sure you wish to Clock In?");
            if (r==true) {
              x="Yes.";
            } else {
              x="Cancelled.";
            }
          }
          function ConfirmclockOut() {
            var r=confirm("Are you sure you wish to Clock Out?");
            if (r==true) {
              x="Yes.";
            } else {
              x="Cancelled.";
            }
          }
          </script>
            <p>
            <?php 
            
            if ($checkifclockedin == 0){
              echo "<form action=timeclock.php method=post>";
              echo "<input type=hidden name=hidden value=" . $data2['User_ID'] . ">";
              //echo "<input type='submit' class='btn' name='ClockIn' value='Clock In' onclick=ConfirmclockIn() style= 'width:100px'></input> <br/>";?>
              <input type="submit" value="Clock In" href="#clockinModal" style ="width:100px" class="btn" data-toggle="modal"></input><br/><br/>
              <?php
              echo "<form action=timeclock.php method=post>";
              echo "<input type=submit value='Clock Out' disabled style =width:100px class=btn data-toggle=modal></input><br/><br/>";
            }
            else if($checkifclockedin != 0){
              echo "You clocked in at " . $clockintimedisplay['Clock_in_Time'];
              echo "<form action=timeclock.php method=post>";
              echo "<input type=hidden name=hidden value=" . $data2['User_ID'] . ">";
              echo "<input type=submit value='Clock In' disabled style =width:100px class=btn data-toggle=modal></input><br/><br/>";

              echo "<form action=timeclock.php method=post>";
              //echo "<input type='submit' class='btn' name='ClockOut' value='Clock Out' onclick=ConfirmclockOut() style= 'width:100px'></input>";?>
              <input type="submit" value="Clock Out" href="#clockoutModal" style ="width:100px" class="btn" data-toggle="modal"></input><br/><br/>
              <?php
              }
              ?>

              <!-- Clock In Modal -->
              <div id="clockinModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 id="myModalLabel">Clock In Confirmation</h3>
                </div>
                <div class="modal-body">
                  <p>Are you sure you wish to Clock In?</p>
                </div>
                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                  <button name="ClockIn" class="btn btn-primary">Submit</button>
                </div>
              </div>

              <!-- Clock Out Modal -->
              <div id="clockoutModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 id="myModalLabel">Clock Out Confirmation</h3>
                </div>
                <div class="modal-body">
                  <p>Are you sure you wish to Clock Out?</p>
                </div>
                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                  <button name="ClockOut" class="btn btn-primary">Submit</button>
                </div>
              </div>
      </p>
      

          

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
    <script src="./js/jquery-1.9.1.js"></script>
    <script src="./js/jquery-1.9.1.min.js"></script> 
    <script src="./js/bootstrap.js"></script>
    

  </body>
</html>
