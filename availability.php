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
              Logged in as <a href="#" class="navbar-link"><?php echo $_SESSION['username']."<a href='logout.php'>  Log out</a>"; ?></a>
            </p>
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
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
              <li class="actice"><a href="./employee.php">User Profile</a></li>
              <li><a href="./timeclock.php">Time Clock</a></li>
              <li><a href="./schedule.php">Schedule</a></li>
              <li><a href="./availability.php">Availabilty</a></li>
              <li><a href="./requesttimeoff.php">Request Time Off</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h1>Availability</h1>
            <p>Here you can update your availability</p>

            <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
          </div>
          <!--<img src="sav.png" width="150" height="150">-->
          <div class="row-fluid">

          <div>
            <form action="availability.php" method="POST">
            <?php 
              $emp_id = mysql_fetch_assoc(mysql_query("SELECT emp_id FROM user_profile WHERE username = '". $search ."'"));
              $q4 = mysql_fetch_assoc(mysql_query("SELECT is_avail from emp_availability where emp_id = '".$emp_id['emp_id']."' and time_availability_id = '1'")); 
              $q5 = mysql_query("SELECT is_avail FROM emp_availability WHERE emp_id = '".$emp_id['emp_id']."' ORDER BY time_availability_id ");
              // echo "0=".mysql_data_seek($q5, 0);
              // echo "1=".$q5[1];
              // echo "2=".$q5[2];
              // echo "3=".$q5[3];
              //echo mysql_result($q5, 1);
            ?>
            <table>
              <tr>
                <th>Day&nbsp</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Available?</th>
              </tr>
              <tr>
                <td>Monday&nbsp</td>
                <td>8:00am</td>
                <td>9:00am</td>
                <td><input type="checkbox" name="UpdateAvailability1" value="true"<?php if(mysql_result($q5, 0) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>Monday</td>
                <td>9:00am</td>
                <td>10:00am</td>
<!--                 <?php echo "name". $data2['First_Name']; ?>
                <?php echo "test1". $q3['time_availability_id']; ?>
                <?php echo "test2". $q3['time_availability_id']; ?> -->
                <td><input type="checkbox" name="UpdateAvailability2" value="true"<?php if(mysql_result($q5, 1) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>Monday</td>
                <td>10:00am</td>
                <td>11:00am</td>
                <td><input type="checkbox" name="UpdateAvailability3" value="true"<?php if(mysql_result($q5, 2) == '1') echo "checked='checked'"; ?>></td>
              </tr>
              <tr>
                <td>Monday</td>
                <td>11:00am</td>
                <td>12:00pm</td>
                <td><input type="checkbox" name="UpdateAvailability4" value="true"<?php if(mysql_result($q5, 3) == '1') echo "checked='checked'"; ?>></td>
              </tr>
            </table>
            <input class=btn type="submit" name="UpdateAvailabilityButton" value="Submit">

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