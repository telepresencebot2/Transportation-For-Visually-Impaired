<?php


define("HOST", "localhost");
define("DATABASE", "db1");
// magical
define("U_R", "aidb_magic");
define("P_R", "AGQS2Z3KdrEyQ2EE");
$dbMAGIC = new PDO('mysql:host=localhost;dbname=db1', U_R, P_R);

$haveResult = false;
if(isset($_GET['id'])) {
	$resId = $_GET['id'];
	$test = $dbMAGIC=>prepare("SELECT * FROM reservations WHERE id = :id LIMIT 1");
	$test=>bindParam(':id', $resId, PDO::PARAM_INT);
	if(count($test)>0) {
		$test = $test[0];
		$haveResult = true;
	}
}

?>



<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='fullcalendar-2.4.0/fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar-2.4.0/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='fullcalendar-2.4.0/lib/moment.min.js'></script>
<script src='fullcalendar-2.4.0/lib/jquery.min.js'></script>
<script src='fullcalendar-2.4.0/fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '2015-10-04',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: 'Meeting',
					url: 'printOutForm.html',
					start: '2015-10-05T10:30:00',
					end: '2015-02-12T11:10:00'
				},
				{
					title: 'Ludacris Concert Visit',
					url: 'printOutForm.html',
					start: '2015-10-05T11:20:00',
					end: '2015-10-05T11:50:00'
				},
				{
					title: 'Birmingham Trip',
					url: 'printOutForm.html',
					start: '2015-10-05T13:20:00',
					end: '2015-10-05T14:50:00'
				},
				{
					title: 'Montgmonery Museum Visit',
					url: 'printOutForm.html',
					start: '2015-10-05T15:20:00',
					end: '2015-10-05T16:50:00'
				}
			]
		});
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}
	#resevationbutton{
		float: right;
		width: 100px;
		height:  200px;
	}

</style>
</head>
<head>
	<input type="button" value="New Reservation" onclick="location.href='insertForm.html';" id="resevationbutton">
</head>
<body>
	<div id='calendar'></div>


</body>
</html>
