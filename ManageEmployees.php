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
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Navigation Bar</li>
              <li class="actice"><a href="./manager.php">Employees</a></li>
              <li><a href="./managerschedule.php">Schedule</a></li>
              <li><a href="./report.php">Report</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h1>Welcome To Your Manager Profile!</h1>
            <p>Here you can manage your employees.</p>

            <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
          </div>
          
          <div class="row-fluid">

<!--             <table>
              <th>Column One</th>
              <th>column two</th>
              <th>column three</th>
            </table> -->

          <?php
            // print_r($ManageEmployees);
            // exit();
            echo "<table class=table>";
            echo "<tr>";
            $count = "0";
            while($row = mysql_fetch_array($ManageEmployees))
              {
                if ($count == "3") {
                  echo "</tr>";
                  echo "<tr>";
                  $count = "0";
                }
                echo "<td> 
                  <a  href='./EditEmployee1.php?id=$row[Emp_ID]'><img src='$row[Image_Location]' width='100' height='100'> <br>
                  $row[First_Name] $row[Last_Name]
                  </td>";
                $count++;
              }
            echo "</tr>";
            echo "</table>";
          ?>
          <input type="submit" value="Add Employee" href="#AddEmployee" class="btn" data-toggle="modal"></input>

          <!-- Modal -->
            <div id="AddEmployee" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Add Employee</h3>
              </div>
              <div class="modal-body">
                <p>Enter the employee's information here:</p>
                <form method="POST" action="ManageEmployees.php">
                  <table>
                    <tr>
                      <p><td style="font-weight:bold">Username: </td>
                      <td><input type="text" name="username" value=""></td>
                    </tr>
                    <tr>
                      <p><td style="font-weight:bold">Password: </td>
                      <td><input type="password" name="password" value=""></td>
                    </tr>
                    <tr>
                      <p><td style="font-weight:bold">First Name: </td>
                      <td><input type="text" name="fname" value=""></td>
                    </tr>
                    <tr>
                      <p><td style="font-weight:bold">Last Name: </td>
                      <td><input type="text" name="lname" value=""></td>
                    </tr>
                    <tr>
                      <p><td style="font-weight:bold">Email: </td>
                      <td><input type="text" name="email" value=""></td>
                    </tr>
                    <tr>
                      <p><td style="font-weight:bold">Phone Number: </td>
                      <td><input type="text" name="phonenumber" value=""></td>
                    </tr>
                    <tr>
                      <p><td style="font-weight:bold">Rank: </td>
                      <td>              
                        <select>
                          <option name="rank" value="rank">Employee</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <p><td style="font-weight:bold">Tech ID: </td>
                      <td><input type="text" name="techid" value=""></td>
                    </tr>
                  </table>
                  <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button name="AddEmployee" class="btn btn-primary">Add</button>
                  </div>
                </form>
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
    <script src="./js/jquery-1.9.1.js"></script>
    <script src="./js/jquery-1.9.1.min.js"></script> 
    <script src="./js/bootstrap.js"></script>

  </body>
</html>
