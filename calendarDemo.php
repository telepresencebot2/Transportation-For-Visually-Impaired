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
				<?php
					$lastreserve = end($reserve);
					foreach ($reserve as $re)
					{
						echo "{";
						echo "title: '".$re['destDescription']."',";
						echo "url: 'printOutForm.php?id=" . $re['id']. "',";
						echo "start: '".$re['pickDate']."T".$re['pickTime']."',";
						echo "color: '".$re['vehicleColor']."',";
						if ($re == $lastreserve)
						{
							break;
						}
						echo "},";
					}
				 ?>
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
	footer{
	    text-align: center;
	    max-width: 900px;
	    height: 40px;
	    margin-left: auto;
	    margin-right: auto;
	}
	#reservationButton{
		width: 100%;
		height: 100%;
		margin: 0 auto;
	}
</style>
</head>
<body>
	<div id='calendar'></div>


</body>

<footer>
	<input type="button" id='reservationButton' value="New Reservation" onclick="location.href='insertForm.php';">	
</footer>
</html>

