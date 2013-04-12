<?php
?>
<html>
<head>
  <link rel="stylesheet" href="/js/fullcalendar-1.6.0/fullcalendar/fullcalendar.css" type="text/css" media="screen" title="no title" charset="utf-8">
  <script src="/js/fullcalendar-1.6.0/jquery/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="/js/fullcalendar-1.6.0/fullcalendar/fullcalendar.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="/js/fullcalendar-1.6.0/jquery/jquery-ui-1.10.2.custom.min.js" type="text/javascript" charset="utf-8"></script>
  <script type='text/javascript'>
$(document).ready(function() {
  $('#calendar').fullCalendar({
  	defaultView:'agendaWeek',
  	events:'./myevents.php'
    //eventSources: ['./myevents.php']
  });
});
</script>
</head>
<body>
  <div id='calendar'></div>
</body>
</html>