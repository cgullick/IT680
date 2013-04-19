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
          <a class="brand" href="./employee.php">Maverick EMS</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link"><?php echo $_SESSION['username']."<a href='logout.php'>  Log out</a>"; ?></a>
            </p>
            <ul class="nav">
              <li class="active"><a href="./employee.php?>">Home</a></li>
              <!--Dropdown-->
              <li class="dropdown">  
                <a href="#"  
                  class="dropdown-toggle"  
                  data-toggle="dropdown">  
                  Services  
                <b class="caret"></b>  
                </a>  
                  <ul class="dropdown-menu">  
                    <li><a href="./availability.php">Update Availability</a></li>  
                    <li><a href="./schedule.php">View Schedule</a></li> 
                    <li><a href="./timeclock.php">Clock in and Clock Out</a></li>
                    <li><a href="./requesttimeoff.php">Request Time Off</a></li> 
                    <li><a href="./timesheet.php">View Hours Worked</a></li>   
                  </ul>  
              </li>
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
              <li class="actice"><a href="./profile.php">User Profile</a></li>
              <li><a href="./timeclock.php">Time Clock</a></li>
              <li><a href="./schedule.php">Schedule</a></li>
              <li><a href="./availability.php">Availabilty</a></li>
              <li><a href="./requesttimeoff.php">Request Time Off</a></li>
              <li><a href="./test.php">Image Upload</a></li>
              <li><a href="./Availability Calender.php">Availablity Calendar</a></li>
              <li><a href="./timesheet.php">Timesheet</a></li>

            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <?php echo "<h1>Welcome To Your User Profile ".$First_Name['First_Name']."!</h1>";?>
            <p>Here you can view your information and update it.</p>

            <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
          </div>

          <div class="row-fluid">
            
          <div>
            <table>
              <tr>
                <p><td style="font-weight:bold">First Name: </td>
                <td><?php echo $data2['First_Name']; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Last Name: </td>
                <td><?php echo $data2['Last_Name']; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Email: </td>
                <td><?php echo $data2['Email']; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Phone Number: </td>
                <td><?php echo $data2['Phone_Number']; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Rank: </td>
                <td><?php echo $data2['Rank']; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Address: </td>
                <td><?php echo $data2['Address']; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">City: </td>
                <td><?php echo $data2['City']; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">State: </td>
                <td><?php echo $data2['State']; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Zip: </td>
                <td><?php echo $data2['Zip']; ?></td>
              </tr> 
            </table>
            <p><a href="./editprofile.php" class="btn" type="button">Edit Profile</a>

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
