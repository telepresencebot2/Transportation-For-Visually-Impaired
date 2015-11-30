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
	function popup(){
  		cuteLittleWindow = window.open("vehicleForm.html", "littleWindow", "location=no,width=700,height=312"); 
	}

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
						echo "end: '".$re['pickDate']."T".$re['destTime']."',";
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
	.newVehicle{
	    height:50px;
	    width: 100%;
	    float: center;
	    background: white;
	    background-size: contain;
	    background-image: url(addButton.png);
	    background-repeat: no-repeat;
	   	background-position: center;

	}
	#newVehicle{
	    height:30px;
	    width: 50%;
	    float: left;
	}
	.newDriver{
	    height: 50px;
	    width: 100%;
	    float: center;
	    background: white;
	    background-size: contain;
	    background-image: url(addButton.png);
	    background-repeat: no-repeat;
	   	background-position: center;
	}
	#newDriver{
	    height: 30px;
	    width: 50%;
	    float: left;
	}
	.newReservationButton{
	    height: 50px;
	    width: 100%;
	    float: left;
	    background: white;
	    background-size: contain;
	    background-image: url(addButton.png);
	    background-repeat: no-repeat;
	   	background-position: center;
	}
	#addFeatures{
		position: relative;
		float: left;
		width: 50%;
		height: 100%;
		display: inline;
	}
	#reservation{
		position: relative;
		float: right;
		width: 50%;
		height: 100%;
		display: inline;
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
	<div id='addFeatures'>
		<div id="newVehicle">
			Add Vehicle
			<button class="newVehicle" onclick="location.href='vehicleForm.php';">	
		</div>
		<div id="newDriver">
			Add Driver
			<button class="newDriver" onclick="location.href='driverForm.php';">	
		</div>
	</div>
	<div id='reservation'>
		Book Reservation
		<button class="newReservationButton" onclick="location.href='insertForm.php';">	
	</div>
</footer>
</html>

