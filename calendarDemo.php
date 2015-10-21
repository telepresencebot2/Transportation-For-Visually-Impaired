<?php


define("HOST", "localhost");
define("DATABASE", "db1");
// magical
define("U_R", "transMAGIC");
define("P_R", "bFYRFWc2jupQ9xbK");
$dbMAGIC = new PDO('mysql:host=localhost;dbname=db1', U_R, P_R);

$reserve = $dbMAGIC->prepare("SELECT * FROM reservations");
$reserve->execute();
$reserve = $reserve->fetchAll();
// if(count($reserve)>0) {
	// $reserve = $reserve[0];
	// $haveResult = true;
// }

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
			defaultDate: '<?php echo date("Y-m-d") ?>',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: '<?php echo $reserve[0]['location'] ?>',
					url: '<?php echo "printOutForm.php?id=" . $reserve[0]['id']; ?>',
					start: '<?php echo $reserve[0]['pickDate']."T".$reserve[0]['pickTime']; ?>',
					color: '<?php echo $reserve[0]['vehicleColor'] ?>'
				},
				{
					title: '<?php echo $reserve[1]['location'] ?>',
					url: '<?php echo "printOutForm.php?id=" . $reserve[1]['id']; ?>',
					start: '<?php echo $reserve[1]['pickDate']."T".$reserve[1]['pickTime']; ?>',
					color: '<?php echo $reserve[1]['vehicleColor'] ?>'
				},
				{
					title: 'Birmingham Trip',
					url: 'printOutForm.php?id=1',
					start: '2015-10-05T13:20:00',
					end: '2015-10-05T14:50:00'
				},
				{
					title: 'Montgmonery Museum Visit',
					url: 'printOutForm.php?id=4',
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
	<input type="button" value="New Reservation" onclick="location.href='insertForm.php';" id="resevationbutton">
</head>
<body>
	<div id='calendar'></div>


</body>
</html>

