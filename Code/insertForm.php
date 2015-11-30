<?php
define ( "HOST", "localhost" );
define ( "DATABASE", "db1" );
// magical
define ( "U_R", "transMAGIC" );
define ( "P_R", "bFYRFWc2jupQ9xbK" );
$dbMAGIC = new PDO ( 'mysql:host=localhost;dbname=db1', U_R, P_R );

$vehicle = $dbMAGIC->prepare ( "SELECT color, vehicleType FROM vehicle" );
$vehicle->execute ();
$vehicle = $vehicle->fetchAll ();

$vehicleDriver = $dbMAGIC->prepare ( "SELECT name FROM driver" );
$vehicleDriver->execute ();
$vehicleDriver = $vehicleDriver->fetchAll ();


function getOverlap($start, $end, $db) {
	$overlap = $db->prepare ( 'SELECT id, ticket, vehicleColor, driverName, pickTimeStamp, destTimeStamp FROM reservations' );
	$overlap->execute ();
	$overlap = $overlap->fetchAll ();
	$taken = array ();
	foreach ( $overlap as $over ) {
		if (($over ['pickTimeStamp'] >= $start && $over ['pickTimeStamp'] <= $end) || ($over ['destTimeStamp'] >= $start && $over ['destTimeStamp'] <= $end) || ($over ['pickTimeStamp'] <= $start && $over ['destTimeStamp'] >= $start) || ($over ['pickTimeStamp'] <= $end && $over ['destTimeStamp'] >= $end)) {
			$taken [] = $over;
		}
	}
	return $taken;
}
function getAvailableVehicles($start, $end, $db) {
	$overLap = getOverlap ( $start, $end, $db );
	$taken = array ();
	foreach ( $overLap as $over ) {
		$taken [] = $over ['vehicleColor'];
	}
	
	$cars = $db->prepare ( "SELECT color FROM vehicle" );
	$cars->execute ();
	$cars = $cars->fetchAll ();
	$available = array ();
	foreach ( $cars as $car ) {
		$available [] = $car ['color'];
	}
	return array_diff ( $available, $taken );
}
function getAvailableDrivers($start, $end, $db) {
	$overLap = getOverlap ( $start, $end, $db );
	$taken = array ();
	foreach ( $overLap as $over ) {
		$taken [] = $over ['driverName'];
	}
	
	$drivers = $db->prepare ( "SELECT name FROM driver" );
	$drivers->execute ();
	$drivers = $drivers->fetchAll ();
	$available = array ();
	foreach ( $drivers as $driver ) {
		$available [] = $driver ['name'];
	}
	return array_diff($available, $taken);
}


if ( isset( $_POST['getVD'] ) ) {
	$search = $dbMAGIC->prepare("SELECT ticket, driverName, vehicleColor FROM reservations WHERE pickDate = :date");
	$search->bindParam(':date', $_POST['getVD']);
	$search->execute();
	$results = $search->fetchAll();
	for($i = 0; $i < count($results); $i++) {
		$getCar = $dbMAGIC->prepare("SELECT vehicleType FROM vehicle WHERE color = :color LIMIT 1");
		$getCar->bindParam(':color', $results[$i]['vehicleColor']);
		$getCar->execute();
		$car = $getCar->fetchAll();
		$results[$i]['vehicle'] = $car[0]['vehicleType'];
	}
	echo json_encode($results);
} else if (isset ( $_POST ['search'])) {
	$name = '%'.$_POST['search'].'%';
	$search = $dbMAGIC->prepare("SELECT * FROM reservations WHERE name LIKE :name");
	$search->bindParam(':name', $name);
	$search->execute();
	$search = $search->fetchAll();
	$results = array();
	foreach($search as $entry) {
		$skip = false;
		foreach ($results as $result) {
			if($entry['name']==$result['name']) { $skip = true; break; }
		}
		if(!$skip) {
			$results[] = $entry;
		}
	}
	echo json_encode($results);
} else if (isset ( $_POST ['year'] ) && $_POST ['year'] != null) {
	$date = $_POST ['year'] . "-" . $_POST ['month'] . "-" . $_POST ['day'];
	
	if ($_POST ['pickAP'] == 'AM' && $_POST ['pickHour'] == 12) {
		$_POST ['pickHour'] == 00;
	} else if ($_POST ['pickAP'] == 'PM' && $_POST ['pickHour'] != 12) {
		$_POST ['pickHour'] += 12;
	}
	
	if ($_POST ['destAP'] == 'AM' && $_POST ['destHour'] == 12) {
		$_POST ['destHour'] == 00;
	} else if ($_POST ['destAP'] == 'PM' && $_POST ['destHour'] != 12) {
		$_POST ['destHour'] += 12;
	}
	
	$pickTime = sprintf ( "%02d", $_POST ['pickHour'] ) . ":" . sprintf ( "%02d", $_POST ['pickMin'] ) . ':00';
	$destTime = sprintf ( "%02d", $_POST ['destHour'] ) . ":" . sprintf ( "%02d", $_POST ['destMin'] ) . ':00';
	
	$pickTimeStamp = strtotime ( $date . ' ' . $pickTime );
	$destTimeStamp = strtotime ( $date . ' ' . $destTime );
	
	// Reformat date for calendar
	$date = $_POST ['year'] . "-" . sprintf ( "%02d", $_POST ['month'] ) . "-" . sprintf ( "%02d", $_POST ['day'] );
	
	$cars = getAvailableVehicles ( $pickTimeStamp, $destTimeStamp, $dbMAGIC );
	$drivers = getAvailableDrivers ( $pickTimeStamp, $destTimeStamp, $dbMAGIC );
	
	if (in_array ( $_POST ['vehicle'], $cars ) || true) {
		$car = $_POST ['vehicle'];
	} else {
		$car = $cars [array_rand ( $cars )];
	}
	
	if (in_array ( $_POST ['driverName'], $drivers ) || true) {
		$driver = $_POST ['driverName'];
	} else {
		$driver = $drivers [array_rand ( $drivers )];
	}
	
	$insert = $dbMAGIC->prepare ( 'INSERT INTO reservations
			(name, disability, waiver, ticket, newPatient, emergName, emergPhone, phone, 
			pickDate, pickTime, pickAddr1, pickAddr2, pickCity, pickZip, pickPhone, pickDescription,
			destTime, destDescription, destAddr1, destAddr2, destCity, destZip, destPhone,
			assistance, driverName, vehicleColor, pickTimeStamp, destTimeStamp)
			VALUES
			(:name, :disability, :waiver, :ticket, :newPatient, :emergName, :emergPhone, :phone,
			:pickDate, :pickTime, :pickAddr1, :pickAddr2, :pickCity, :pickZip, :pickPhone, :pickDescription,
			:destTime, :destDescription, :destAddr1, :destAddr2, :destCity, :destZip, :destPhone,
			:assistance, :driverName, :vehicleColor, :pickTimeStamp, :destTimeStamp)' );
	
	$insert->bindParam ( ':name', $_POST ['clientname'] );
	$insert->bindParam ( ':disability', $_POST ['disability'] );
	$insert->bindParam ( ':waiver', $_POST ['waiver'] );
	$insert->bindParam ( ':ticket', $_POST ['tickets'], PDO::PARAM_INT );
	$insert->bindParam ( ':newPatient', $_POST ['newPatient'] );
	$insert->bindParam ( ':emergName', $_POST ['emergencyName'] );
	$insert->bindParam ( ':emergPhone', $_POST ['emergencyNumber'] );
	$insert->bindParam ( ':phone', $_POST ['patientNumber'] );
	$insert->bindParam ( ':pickDate', $date );
	$insert->bindParam ( ':pickTime', $pickTime );
	$insert->bindParam ( ':pickAddr1', $_POST ['pickAddress1'] );
	$insert->bindParam ( ':pickAddr2', $_POST ['pickAddress2'] );
	$insert->bindParam ( ':pickCity', $_POST ['pickCity'] );
	$insert->bindParam ( ':pickZip', $_POST ['pickZip'] );
	$insert->bindParam ( ':pickPhone', $_POST ['pickNumber'] );
	$insert->bindParam ( ':pickDescription', $_POST ['pickDesc'] );
	$insert->bindParam ( ':destTime', $destTime );
	$insert->bindParam ( ':destDescription', $_POST ['destName'] );
	$insert->bindParam ( ':destAddr1', $_POST ['destAddress1'] );
	$insert->bindParam ( ':destAddr2', $_POST ['destAddress2'] );
	$insert->bindParam ( ':destCity', $_POST ['destCity'] );
	$insert->bindParam ( ':destZip', $_POST ['destZip'] );
	$insert->bindParam ( ':destPhone', $_POST ['destNumber'] );
	$insert->bindParam ( ':assistance', $_POST ['paperAssistance'] );
	$insert->bindParam ( ':driverName', $driver );
	$insert->bindParam ( ':vehicleColor', $car );
	$insert->bindParam ( ':pickTimeStamp', $pickTimeStamp, PDO::PARAM_INT );
	$insert->bindParam ( ':destTimeStamp', $destTimeStamp, PDO::PARAM_INT );
	
	$insert->execute ();
	header('Location: calendarDemo.php');
	exit ();
	die ();
} else {

?>

<!DOCTYPE html>
<html>
<head>
<style>
h2 {
	position: relative;
	left: 10px;
	font-size: 32px;
	font-family: Zapf Chancery, cursive;
}

img {
	position: absolute;
	left: 8px;
	top: 0px;
	width: 802px;
	height: 105px;
	z-index: -1;
}
</style>
</head>

<body>
	<style>
/* Generic Label/Text Fields*/
#firstLabel {
	position: relative;
	top: 20px;
	left: 10px;
}

#firstField {
	position: absolute;
	margin: 20px;
	left: 170px;
}

#secondLabel {
	position: absolute;
	margin: 20px;
	left: 400px;
}

#secondField {
	position: absolute;
	margin: 20px;
	left: 520px;
}

/* Date Fields*/
#day {
	position: relative;
	top: 10px;
	left: 10px;
}

#dayLabel {
	position: relative;
	top: 10px;
	left: 10px;
}

#month {
	position: relative;
	top: 10px;
	left: 10px;
}

#monthLabel {
	position: relative;
	top: 10px;
	left: 10px;
}

#year {
	position: relative;
	top: 10px;
	left: 10px;
}

#yearLabel {
	position: relative;
	top: 10px;
	left: 10px;
}

/* Form Sections In Order*/
#intitialInfo {
	position: relative;
	border: 1px solid black;
	height: 100px;
	width: 800px;
	top: 0;
}

#middleSection {
	width: 800px;
	height: 370px;
}

#patientInfo {
	border: 1px solid black;
	width: 350px;
	height: 160px;
}

#emergencyInfo {
	position: relative;
	border: 1px solid black;
	width: 350px;
	height: 100px;
	/*left: 10px;*/
}

#appointmentInfo {
	border: 1px solid black;
	width: 800px;
	height: 285px;
}

#driverInfo {
	height: 100px;
	border: 1px solid black;
	width: 350px;
}

/* MiddleSection BreakDown*/
#leftgraphic {
	position: relative;
	top: 10px;
	width: 49%;
	display: inline;
	float: left;
}

#rightgraphic {
	position: relative;
	top: 64px;
	width: 49%;
	height: 100%;
	display: inline;
	float: right;
	background: url(logo.jpg);
	background-size: contain;
	background-repeat: no-repeat;
}

/* appointmentInfo Breakdown */
#date {
	margin-left: 200px;
	margin-right: 200px;
	height: 20px;
}

#dropOffBlock {
	position: relative;
	display: inline;
	float: right;
	top: 10px;
	width: 49%;
}

#pickBlock {
	position: relative;
	display: inline;
	float: left;
	top: 10px;
	left: 10px;
	width: 49%;
}

#addressTitle {
	alignment-baseline: left;
	font-size: 18px;
	text-decoration: underline;
}

#street1 {
	width: 300px;
	left: 400px;
}

#street2 {
	position: relative;
	width: 300px;
	top: 1px;
	left: 60px;
}

#city {
	position: relative;
	left: 24px;
	width: 150px;
}

#destZip {
	position: relative;
	left: 40px;
	width: 50px;
}

#destZipLabel {
	position: relative;
	left: 30px;
}

/* Headers */
#Typical {
	/*	left: 10px; */
	font-size: 16px;
	text-decoration: underline;
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
}

#appLabels {
	text-decoration: underline;
}
</style>
</body>


<head>
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Submit and Date scripts-->
<script type="text/javascript">
	function monthChange(){
		var str1 = "0";
		var select = document.forms['insertForm'].elements['month'];
		var day = document.forms['insertForm'].elements['day'];
		var length = day.options.length;
		var numDays = daysInMonth(month.value, 2015);
		day.value = numDays;
		for (i=day.options.length-1; i>= 0; i--)
		{
				day.remove(i);
		}
		for (i =0 ; i < numDays; i++){
			var opt = i + 1;
			var el = document.createElement("option");
			if (i < 9){
				el.text = str1.concat(opt);
				el.value = str1.concat(opt);
			} else{
				el.text = opt;
				el.value = opt;
			}
			day.appendChild(el);
		}
	}
	function daysInMonth(month,year){
		return new Date(year, month, 0).getDate();
	}

	var clients = [];
	function searchNames() {
		var name = document.getElementById('firstField').value;
		//reset clients[]
		clients = [];
		var options = "";
		//ajax for names
		$.post("insertForm.php", {search: name}, function(data) {
			//fill clients[]
			clients = JSON.parse(data);
			//populate list of options
			for( var i = 0; i < clients.length; i++ ) {
				options += '<option value="'+clients[i]['name']+'"/>';
			}
			document.getElementById('searchResults').innerHTML = options;
			if(clients.length > 0 && name == clients[0]['name']) {
				selectName(clients[0]);
			}
		});
	}

	function selectName(client) {
		//prefill client info from selected name and clients[]
		document.getElementsByName('patientNumber')[0].value = client['phone'];
		document.getElementsByName('newPatient')[0].options[1].selected = true;
		if(client['assistance']=='YES') {
			document.getElementsByName('paperAssistance')[0].options[0].selected = true;
		} else {
			document.getElementsByName('paperAssistance')[0].options[1].selected = true;
		}
		switch (client['disability']) {
			case "Blind":
				document.getElementsByName('disability')[0].options[1].selected = true;
			case "LV":
				document.getElementsByName('disability')[0].options[2].selected = true;
			case "Deaf":
				document.getElementsByName('disability')[0].options[3].selected = true;
			case "HOH":
				document.getElementsByName('disability')[0].options[4].selected = true;
			case "DB":
				document.getElementsByName('disability')[0].options[5].selected = true;
		}
		document.getElementsByName('emergencyName')[0].value = client['emergName'];
		document.getElementsByName('emergencyNumber')[0].value = client['emergPhone'];
		
	}

	function updateVD() {
		var date = document.getElementsByName('year')[0].value + "-" + 
			document.getElementsByName('month')[0].value + "-" +
			document.getElementsByName('day')[0].value;
		$.post('insertForm.php', {getVD: date}, function(data) {
			var results = JSON.parse(data);
			var tickets = [];
			if(results.length > 0) {
				for(var i = 0; i < results.length; i++) {
					//vehicle
					var cars = document.getElementsByName('vehicle')[0].options;
					for( var j = 0; j<cars.length; j++ ) {
						if(results[i]['vehicleColor']==cars[j].value) {
							if(tickets[j] == null) {tickets[j] = parseInt(results[i]['ticket']);}
							else {tickets[j] += parseInt(results[i]['ticket']);}
							cars[j].innerHTML = cars[j].getAttribute('dataname') + ' - ' + tickets[j] + ' tickets already';
						}
					}
					//driverName
					var drivers = document.getElementsByName('driverName')[0].options;
					for( var j = 0; j<drivers.length; j++ ) {
						if(results[i]['driverName']==drivers[j].value && drivers[j].innerHTML.indexOf('-')==-1) {
							drivers[j].innerHTML = drivers[j].innerHTML + ' - driving ' + results[i]['vehicle'];
						}
					}
				}
			}
		});
	}
</script>
<!-- Date Change script-->


<link rel="stylesheet" type="text/css" href="form.css">
<img src="header2.png">
<h2>Pick Up Registration Form</h2>
</head>

<body onload="updateVD();">


	<form name="insertForm" action="insertForm.php" method="post" autocomplete="off">
		<!-- Initial Client Info -->
		<div id="intitialInfo">
			<label for="clientname" id="firstLabel">Client Name: </label> 
			<input type="text" name="clientname" id="firstField" list="searchResults" onchange="searchNames();" onkeypress="searchNames();">
			<datalist id="searchResults"></datalist> 
			<label for="disability" id="secondLabel">Disability Type:</label> 
			<select name="disability" id="secondField">
				<option value="NULL"></option>
				<option value="Blind">Blind</option>
				<option value="LV">Low Vision</option>
				<option value="Deaf">Deaf</option>
				<option value="HOF">HOH</option>
				<option value="DB">Deaf/Blind</option>
			</select>
			<p>
				<label for="waiver" id="firstLabel">Waiver:</label> <input
					type="text" name="waiver" id="firstField"> <label for="tickets"
					id="secondLabel">Tickets:</label> <select name="tickets"
					id="secondField">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="1">3</option>
					<option value="2">4</option>
					<option value="1">5</option>
					<option value="2">6</option>
				</select>
		
		</div>

		<div id="middleSection">
			<div id="leftgraphic">
				<p id="Typical">EMERGENCY CONTACT INFORMATION:</p>
				<div id="emergencyInfo">
					<label for="emergencyname" id="firstLabel">Contact Name:</label> <input
						type="text" name="emergencyName" id="firstField">
					<p>
						<label for="emergencynumber" id="firstLabel">Phone Number:</label>
						<input type="text" name="emergencyNumber" id="firstField">
				
				</div>

				<p id="Typical">PATIENT INFORMATION:</p>

				<div id="patientInfo">
					<label for="pickNumber" id="firstLabel">Phone Number:</label> <input
						type="text" name="patientNumber" id="firstField">
					<p>
						<label for="pickTime" id="firstLabel">New Patient:</label> 
						<select	name="newPatient" id="firstField">
							<option value="YES">YES</option>
							<option value="NO">NO</option>
						</select>
					
					
					<p>
						<label for="paperAssistance" id="firstLabel">P/W Assistance Needed:</label> 
						<select name="paperAssistance" id="firstField">
							<option value="YES">YES</option>
							<option value="NO">NO</option>
						</select>
				
				</div>
			</div>
			<div id="rightgraphic"></div>
		</div>





		<p id="Typical">APPOINTMENT INFORMATION:</p>

		<div id="appointmentInfo">
			<div id="date">
				<!-- Creates and fills month drop down-->
				<label for="day" id="dayLabel">Day:</label> 
				<select name="day" id="day" class="day" onchange="updateVD();">
				<?php
				$number = cal_days_in_month ( CAL_GREGORIAN, date ( 'm' ), date ( 'Y' ) );
				for($x = 1; $x <= $number; $x ++) {
					echo "<option value=\"" . $x . "\">" . $x . "</option>";
				}
				?>
			</select>

				<!-- Creates and fills month drop down-->
				<label for="month" id="monthLabel">Month:</label> 
				<select	name="month" id="month" class="month" onchange="monthChange(); updateVD();">
					<option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>

				<!-- Creates and fills year drop down with current year through 10 years-->
				<label for="year" id="yearLabel">Year:</label> 
				<select name="year" id="year" class="year" onchange="updateVD();">
				<?php
				$y = date ( 'Y' );
				for($x = 0; $x <= 10; $x ++) {
					echo "<option value=\"" . $y . "\">" . $y . "</option>";
					$y ++;
				}
				?>
			</select>
				<!--Calculatates current date and sets for reservation-->
				<!--SPECIAL NOTE-->
				<!--Date is not calculated from calendar current day on calendar doesn't matter-->
				<script>
				$("#day").val((new Date()).getDate());
				$("#year").val((new Date()).getYear()+1900);
				$("#month").val((new Date()).getMonth()+1);
			</script>
			</div>

			<!--Pick Up Block-->
			<div id="pickBlock">
				<p id="appLabels">Pick-up Information:</p>

				<label>Time:</label> 
				<select name="pickHour" id="hour">
				<?php
				for($x = 1; $x <= 12; $x ++) {
					echo "<option value=\"" . $x . "\">" . $x . "</option>";
				}
				?>
				</select>
				<select name="pickMin" id="minutes">
				<?php
				$min = 0;
				for($x = 0; $x <= 11; $x ++) {
					echo "<option value=\"" . $min . "\">" . $min . "</option>";
					$min = $min + 5;
				}
				?>
			</select> 
			<select name="pickAP" id="amOrPm">
					<option value="AM">AM</option>
					<option value="PM">PM</option>
				</select>
				<p></p>
				<label id="destinationName">Description:</label> 
				<input type="text" name="pickDesc" id="pickDesc">
				<p>
					<label for="pickNumber">Phone Number:</label> <input type="text"
						name="pickNumber" id="pickDesc">
				
				
				<p>
					<label for="pickAddress1">Address:</label> <input type="text"
						name="pickAddress1" id="street1">
				
				
				<p>
					<input type="text" name="pickAddress2" id="street2">
				
				
				<p>
					<label for="pickCity" id="cityLabel">City:</label> <input
						type="text" name="pickCity" id="city"> <label for="destZip"
						id="destZipLabel">Zip-Code:</label> <input type="text"
						name="pickZip" id="destZip">
			
			</div>

			<!--Destination Block-->
			<div id="dropOffBlock">
				<p id="appLabels">Destination Information:</p>
				<label for="appointmentTime">Time:</label> <select name="destHour"
					id="hour">
				<?php
				for($x = 1; $x <= 12; $x ++) {
					echo "<option value=\"" . $x . "\">" . $x . "</option>";
				}
				?>
			</select> <select name="destMin" id="minutes">
				<?php
				$min = 0;
				for($x = 0; $x <= 12; $x ++) {
					echo "<option value=\"" . $min . "\">" . $min . "</option>";
					$min = $min + 5;
				}
				?>
			</select> <select name="destAP" id="amOrPm">
					<option value="AM">AM</option>
					<option value="PM">PM</option>
				</select>
				<p>
					<label id="destName">Description:</label> <input type="text"
						name="destName" id="pickDesc">
				
				
				<p>
					<label for="destNumber">Phone Number:</label> <input type="text"
						name="destNumber" id="pickDesc">
				
				
				<p>
					<label for="destAddress1">Address:</label> <input type="text"
						name="destAddress1" id="street1">
				
				
				<p>
					<input type="text" name="destAddress2" id="street2">
				
				
				<p>
					<label for="destCity" id="cityLabel">City:</label> <input
						type="text" name="destCity" id="city"> <label for="destZip"
						id="destZipLabel">Zip-Code:</label> <input type="text"
						name="destZip" id="destZip">
			
			</div>
		</div>

		<p id="Typical">DRIVER/VEHICLE:</p>
		<div id="driverInfo">
			<label for="driverName" id="firstLabel">Driver Name:</label> 
			<select name="driverName" id="firstField">
			<?php
			foreach ( $vehicleDriver as $guy ) {
				echo "<option value=\"" . $guy ['name'] . "\">" . $guy ['name'] . "</option>";
			}
			?>
		</select>
			<p>
				<label for="vehicle" id="firstLabel">Vehicle:</label> 
				<select name="vehicle" id="firstField">
			<?php
			foreach ( $vehicle as $car ) {
				echo "<option dataName='".$car ['vehicleType']."' value=\"" . $car ['color'] . "\">" . $car ['vehicleType'] . "</option>";
			}
			?>
		</select>
		
		</div>

		<p id="Typical">REASON FOR APPOINTMENT:</p>
		<textarea name="notes" rows="10" cols="55"></textarea>


		<p id="Typical">PLEASE INITAL AND DATE BELOW:</p>
		<textarea name="signature" rows="1" cols="15"></textarea>
		<br> <br> <input name="submit" type="submit"
			onclick="alert('Reservation added.');" value="Save Reservation"> <input
			type="button" value="Cancel"
			onclick="location.href='calendarDemo.php';">


	</form>
</body>

<!-- <footer
	<div id= "expo">
		<footer>hfhgjkv</footer>
	</div>
</footer> -->

</html>

<?php
}
?>
