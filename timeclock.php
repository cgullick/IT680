<?php

session_start();

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
            <h1>Time Clock</h1>
            <p>Here you can clock in and clock out for your shift</p>

            <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
          </div>
          <!--<img src="sav.png" width="150" height="150">-->
          <div class="row-fluid">
            
          <div>
            <p>
            <button type="submit" class="btn">Clock In</button>	
   			
   			<!-- Clock in clock out -->	
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
			</p>
            
            <button type="submit" class="btn">Clock Out</button>
            <!--<?php
              $username = "root";
              $password = "";
              $database = "emp_management";
              $server = "localhost";

              $db_handle = mysql_connect($server, $username, $password);
              $db_found = mysql_select_db($database, $db_handle)
            ?>
          </div>-->

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
