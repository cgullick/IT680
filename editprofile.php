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
          <a class="brand" href="./employeenews.php">Maverick EMS</a>
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
              <li class="actice"><a href="./employee.php">Profile</a></li>
              <li><a href="./editprofile.php">Edit Profile</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h1>Edit your User Profile</h1>
            <p>Here you can edit your update user profile</p>

            <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
          </div>
          <!--<img src="sav.png" width="150" height="150">-->
          <div class="row-fluid">
            
          <div>
            <form action="editprofile.php" method="POST" enctype="multipart/form-data">
            <table>
              <tr>
                File: <input type="file" name="myfile">
                <td><?php echo "<img src='$data2[Image_Location]' width='200' height='200'>"; ?></td>
              </tr>
              <tr>
                <p><td style="font-weight:bold">First Name: </td>
                <td><?php echo "<input type=text name=fname value='" . stripslashes($data2["First_Name"]) . "'>"; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Last Name: </td>
                <td><?php echo "<input type=text name=lname value='" . stripslashes($data2['Last_Name']) . "'>"; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Email: </td>
                <td><?php echo "<input type=text name=email value=" . $data2['Email'] . " >"; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Phone Number: </td>
                <td><?php echo "<input type=text name=phonenumber value=" . $data2['Phone_Number'] . " >"; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Rank: </td>
                <td><?php echo "$data2[Rank]"; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Address: </td>
                <td><?php echo "<input type=text name=address value='" . stripslashes($data2["Address"]) . "'>"; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">City: </td>
                <td><?php echo "<input type=text name=city value='" . stripslashes($data2['City']) . "'>"; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">State: </td>
                <td><?php echo "<input type=text name=state value=" . $data2['State'] . ">"; ?></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Zip: </td>
                <td><?php echo "<input type=text name=zip value=" . $data2['Zip'] . ">"; ?></td>
              </tr>
            </table>
            <input class="btn" type="submit" name="UpdateProfileButton" value="Submit">
          </form>

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
    <script src="./js/jquery-1.9.1.js"></script>
    <script src="./js/jquery-1.9.1.min.js"></script> 
    <script src="./js/bootstrap.js"></script>

  </body>
</html>
