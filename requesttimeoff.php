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
            <h1>Request Time off</h1>
            <p>Here you can request time off.</p>

            <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
          </div>
          <!--<img src="sav.png" width="150" height="150">-->
          <div class="row-fluid">
          <script>
          function Confirm() {
            var r=confirm("Is this correct?");
            if (r==true) {
              x="Yes.";
            } else {
              x="Cancelled.";
            }
          }
          </script>
          <div>
          <form method="post" action="requesttimeoff.php" >
            <table>
              <tr>
              <td>First Name: </td>
              <td><?php echo "<input type=text name=fname value='" . stripslashes($data2["First_Name"]) . "'>"; ?></td>
            </tr>
            <tr>
              <td>Last Name: </td>
              <td><?php echo "<input type=text name=fname value='" . stripslashes($data2["Last_Name"]) . "'>"; ?></td>
            </tr>
            <tr>
              <td>Date: </td>
              <td><?php echo "<input type=date name=requestoffdate>" ?></td>
            </tr>
            <tr>
              <td>Reason: </td>
              <td><input type="text" name="requestoffreason" style="width:400px" maxlength="200"></textarea></td>
            </tr>
            </table>
            <!-- <input class="btn" type="submit" name="RequestOffButton" value="Submit" onclick="Confirm()"> -->
            <a href="#submitModal" role="button" class="btn"  data-toggle="modal">Submit</a>

              <div id="submitModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h3 id="myModalLabel">Request Time Off Confirmation</h3>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure everything is correct?</p>
                    </div>
                    <div class="modal-footer">
                      <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                      <button name="RequestOffButton" class="btn btn-primary">Submit</button>
                    </div>
              </div>
            </form>
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
