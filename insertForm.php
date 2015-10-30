<?php
	define("HOST", "localhost");
	define("DATABASE", "db1");
	// magical
	define("U_R", "transMAGIC");
	define("P_R", "bFYRFWc2jupQ9xbK");
	$dbMAGIC = new PDO('mysql:host=localhost;dbname=db1', U_R, P_R);
	if ($dbMagic->connect_error){
		die("Connection failed: ". $dbMagic->connect_error);
	}
	$vehicle = $dbMAGIC->prepare("SELECT * FROM vehicle");
	$vehicle->bindParam(':id', $resId, PDO::PARAM_INT);
	$vehicle->execute();
	$vehicle = $vehicle->fetchAll();
//if(isset($_POST['fName'])&&($_POST['fName']!=null)) {
	if (isset($_POST['submit'])){
		// prepare date
		$date = $_POST[year]."-".$_POST[month]."-".$_POST[day];
		//prepare pickup time
		if ($_POST[pickUpAP] == '2'){
			$_POST[pickUpHour] = $_POST[pickUpHour] + 12;
		} else{
			if ($_POST[pickUpHour] < 10){
				$_POST[pickUpHour] = '0'.$_POST[pickUpHour];
			}
		}
		if ($_POST[pickUpMin] == 0){
			$_POST[pickUpMin] = '00';	
		} elseif ($_POST[pickUpMin] == 5){
			$_POST[pickUpMin] = '05';	
		}
		$pickTime = $_POST[pickUpHour].":".$_POST[pickUpMin].":00";
		//prepare destination Time
		if ($_POST[destAP] == '2'){
			$_POST[destHour] = $_POST[pickUpHour] + 12;
		} else{
			if ($_POST[destHour] < 10){
				$_POST[destHour] = '0'.$_POST[pickUpHour];
			}
		}
		if ($_POST[destMin] == 0){
			$_POST[destMin] = '00';	
		} elseif ($_POST[destMin] == 5){
			$_POST[destMin] = '05';	
		}
		$destTime = $_POST[destHour].":".$_POST[destMin].":00";
	
		
		$sql = "INSERT INTO reservations 
		(name, disability, waiver, ticket, newPatient, emergName, emergPhone, phone, 
		pickDate, pickTime, pickAddr1, pickAddr2, pickCity, pickZip, pickPhone, pickDescription,
		destTime, destDescription, destAddr1, destAddr2, destCity, destZip, destPhone, assistance, driverName, vehicleColor, reason)
		VALUES 
		('$_POST[clientname]', '$_POST[disability]','$_POST[waiver]','$_POST[tickets]', '$_POST[newPatient]',
		'$_POST[emergencyName]', '$_POST[emergencyNumber]', '$_POST[patientNumber]',  
		'$date', '$pickTime', '$_POST[pickUpAddress1]', '$_POST[pickUpAddress2]', '$_POST[pickUpCity]','$_POST[pickUpZip]',
		'$_POST[pickNumber]', '$_POST[pickUpDesc]', '$destTime', 
		'$_POST[destName]','$_POST[destAddress1]','$_POST[destAddress2]','$_POST[destCity]','$_POST[destZip]',
		'$_POST[destNumber]', '$_POST[paperAssistance]', '$_POST[driverName]','$_POST[vehicle]'), '$_POST[notes]')";
		$dbMAGIC->query($sql);
		
		
		// $testsql = $dbMagic->prepare($sql);
		// $reserve->execute();
		 // if ($dbMagic->query($sql) == TRUE){
			 // echo "New Record created successfully";
		 // } else {
			 // echo "Error: " .$sql. "<br>" . $dbMagic->error;
		// }
	}
/*
	$insert = $dbMAGIC->prepare('INSERT INTO reservations (clientId) VALUES (:clientname)');
	$insert->bindParam(':clientname', $_POST['']);
	$insert->execute();
*/
/*
	$time = time();
	$insert = $dbMAGIC=>prepare('INSERT INTO reservations (clientId, location, phone, pickDate, pickTime, pickAddr1, pickAddr2, pickCity, pickZip, destAddr1, destAddr2, destCity, destZip, description, signature, driverId, vehicleId, timestamp) 
 * VALUES (:clientId, :location, :phone, :pickDate, :pickTime, :pickAddr1, :pickAddr2, :pickCity, :pickZip, :destAddr1, :destAddr2, :destCity, :destZip, :description, :signature, :driverId, :vehicleId, :timestamp');
	$insert=>bindParam(':clientID', $_POST['']);
	$insert=>bindParam(':location', $_POST['']);
	$insert=>bindParam(':phone', $_POST['']);
	$insert=>bindParam(':pickDate', $_POST['']);
	$insert=>bindParam(':pickTime', $_POST['']);
	$insert=>bindParam(':pickAddr1', $_POST['']);
	$insert=>bindParam(':pickAddr2', $_POST['']);
	$insert=>bindParam(':pickCity', $_POST['']);
	$insert=>bindParam(':pickZip', $_POST['']);
	$insert=>bindParam(':destAddr1', $_POST['destAddress1']);
	$insert=>bindParam(':destAddr2', $_POST['destAddress2']);
	$insert=>bindParam(':destCity', $_POST['destCity']);
	$insert=>bindParam(':destZip', $_POST['destZip']);
	$insert=>bindParam(':description', $_POST['message']);
	$insert=>bindParam(':signature', $_POST['signature']);
	$insert=>bindParam(':driverId', 0);
	$insert=>bindParam(':vehicleId', 0);
	$insert=>bindParam(':timestamp', $time);
*/
	//array(24) { ["clientname"]=> string(1) "a" ["disability"]=> string(5) "Blind" ["waiver"]=> string(1) "a" ["tickets"]=> string(1) "1" ["emergencyname"]=> string(1) "a" ["emergencynumber"]=> string(1) "a" ["pickupName"]=> string(1) "a" ["pickupNumber"]=> string(1) "a" ["pickupTime"]=> string(1) "a" ["day"]=> string(2) "13" ["month"]=> string(2) "10" ["year"]=> string(4) "2015" ["appointmentTime"]=> string(1) "a" ["appointmentPhone"]=> string(1) "a" ["newPatient"]=> string(3) "YES" ["paperAssistance"]=> string(3) "YES" ["destAddress1"]=> string(1) "a" ["destAddress2"]=> string(1) "a" ["destCity"]=> string(1) "a" ["destZip"]=> string(1) "a" ["driverName"]=> string(1) "a" ["vehicle"]=> string(1) "a" ["message"]=> string(2) "	a" ["signature"]=> string(3) " a" }
	
// } else if(isset($_POST['appointmentPhone'])&&($_POST['appointmentPhone']!=null)) {
	// var_dump($_POST);
// } else {

?>

<!DOCTYPE html>
<html>
<head>
<style>
h2{
	position: relative;
	left: 10px;
	font-size: 32px;
	font-family: Zapf Chancery, cursive;
	
}
img{
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
	#day{
		position: relative;
		top: 10px;
		left: 10px;
	}
	#dayLabel{
		position: relative;
		top: 10px;
		left: 10px;
	}
	#month{
		position: relative;
		top: 10px;
		left: 10px;
	}
	#monthLabel{
		position: relative;
		top: 10px;
		left: 10px;
	}
	#year{
		position: relative;
		top: 10px;
		left: 10px;
	}
	#yearLabel{
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
	#middleSection{
		width: 800px;
		height: 370px;
	}
	
	#patientInfo{
		border: 1px solid black;
		width: 350px;
		height: 160px;
	}
	#emergencyInfo{
		position: relative;
		border: 1px solid black;
		width: 350px;
		height: 100px;
		/*left: 10px;*/
	}
	
	#appointmentInfo{
		border: 1px solid black;
		width: 800px;
		height: 285px;
	}
	
	#driverInfo{
		height: 100px;
		border: 1px solid black;
		width: 350px;
	}
	
	/* MiddleSection BreakDown*/
	#leftgraphic{
		position: relative;
		top: 10px;
		width: 49%;
		display: inline;
		float: left;
	}
	#rightgraphic{
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
	#date{
		margin-left: 200px;
		margin-right: 200px;
		height: 20px;
	}
	
	#dropOffBlock{
		position: relative;
		display: inline;
		float: right;
		top: 10px;
		width: 49%;
	}
	#pickUpBlock{
		position: relative;
		display: inline;
		float: left;
		top: 10px;
		left: 10px;
		width: 49%;
	
	}
	#addressTitle{
		alignment-baseline: left;
		font-size: 18px;
		text-decoration: underline;
	}
	#street1{
		width: 300px;
		left: 400px;
	}
	#street2{
		position: relative;
		width: 300px;
		top: 1px;
		left: 60px;
	}
	#city{
		position: relative;
		left: 24px;
		width: 150px;
	}
	#destZip{
		position: relative;
		left:  40px;
		width: 50px;
	}
	#destZipLabel{
		position: relative;
		left: 30px;
	}
	
	/* Headers */
	#Typical{
	/*	left: 10px; */
		font-size: 16px;
		text-decoration: underline;
		font-family: "Times New Roman", Times, serif;
		font-weight: bold;
	}
	#appLabels{
		text-decoration: underline;
	}
</style>	
</body>
<!-- <footer>
<style>
	
	footer{
		display: block;
		alignment-baseline: bottom;
		float: right;
		color: white;
		font-size: 8px;
	}
	#expo{
		left: 0px;
		bottom: 0px;
		width: 802px;
		height: 80px;
		z-index: -1;	
		background: black;
	}
</style>
</footer> -->


<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Submit and Date scripts-->
<script type="text/javascript">
	function clicked(){
		if (confirm('Are your sure?')){
			location.href = 'calendarDemo.php';
		}
	}
	function monthChange(){
		var str1 = "0";
		var select = document.forms['insertForm'].elements['month'];
		var day = document.forms['insertForm'].elements['day'];
		var length = day.options.length;
		// for (i = 0; i < length; i++){
			// day.options[i] = null;
		// }
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
</script>
<!-- Date Change script-->


<link rel="stylesheet" type="text/css" href="form.css">
<img src="header2.png">
<h2>Pick Up Registration Form</h2>
</head>

<body>


<form name = "insertForm" action="insertForm.php" method="post">
	<!-- Initial Client Info -->
	<div id="intitialInfo">
		<label for="clientname" id ="firstLabel">Client Name: </label>	
		<input type="text" name="clientname" id="firstField">
	
	
		<label for="disability" id="secondLabel">Disability Type:</label>	
		<select name="disability" id = "secondField">
	    	<option value="NULL"></option>
	    	<option value="Blind">Blind</option>
	    	<option value="LV">Low Vision</option>
	    	<option value="Deaf">Deaf</option>
	    	<option value="HOF">HOH</option>
	    	<option value="DB">Deaf/Blind</option>
	  	</select>
		<p>
		<label for="waiver" id="firstLabel">Waiver:</label>	
		<input type="text" name="waiver" id="firstField">
	
		<label for="tickets" id="secondLabel">Tickets:</label>
			<select name="tickets" id="secondField">
	    	<option value="NULL"></option>
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
				<label for="emergencyname" id="firstLabel">Contact Name:</label>	
				<input type="text" name="emergencyName" id="firstField">
				<p>
				<label for="emergencynumber" id="firstLabel">Phone Number:</label>	
				<input type="text" name="emergencyNumber" id="firstField">
			</div>
		
		    <p id="Typical">PATIENT INFORMATION:</p>
		    
		    <div id="patientInfo">
				<label for="pickupNumber" id="firstLabel">Phone Number:</label>	
				<input type="text" name="patientNumber" id="firstField">
				<p>
				<label for="pickupTime" id="firstLabel">New Patient:</label>	
		  		<select name="newPatient" id="firstField">
		    		<option value="NULL"></option>
		    		<option value="YES">YES</option>
		    		<option value="NO">NO</option>
		 	 	</select>
		 	 	<p>
		 		<label for="paperAssistance" id="firstLabel">P/W Assistance Needed:</label>	
		  		<select name="paperAssistance" id="firstField">
		    		<option id="firstField" value="NULL"></option>
		    		<option value="YES">YES</option>
		    		<option value="NO">NO</option>
		 	 	</select>
			</div>
		</div>
		<div id="rightgraphic">
		</div>
	</div>
	
	
	
	
	
  	<p id="Typical">APPOINTMENT INFORMATION:</p>
  	
  	<div id="appointmentInfo">
  		<div id="date">
	  		<!-- Creates and fills month drop down-->
			<label for="day" id="dayLabel">Day:</label>
			<select name="day" id="day" class="day">
				<?php
					$number = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
					for ($x=1; $x <= $number; $x++){
						echo "<option value=\"".$x."\">".$x."</option>";
					}
				?>
			</select>
			
			<!-- Creates and fills month drop down-->
			<label for="month" id="monthLabel">Month:</label>
			<select name="month" id="month" class="month" onchange="monthChange();">
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
			<select name="year" id="year" class="year">
				<?php
					$y = date('Y');
					for ($x=0; $x <= 10; $x++){
						echo "<option value=\"".$y."\">".$y."</option>";
						$y++;
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
		<div id="pickUpBlock">
			<p id="appLabels">Pick-up Information:</p>
			
			<label>Time:</label>	
			<select name="pickUpHour" id="hour">
				<?php
					for ($x=1; $x <= 12; $x++){
						echo "<option value=\"".$x."\">".$x."</option>";
					}
				?>
			</select> 
			<select name="pickUpMin" id="minutes">
				<?php
					$min = 0;
					for ($x=0; $x <= 11; $x++){
						echo "<option value=\"".$min."\">".$min."</option>";
						$min = $min + 5;
					}
				?>
			</select> 
			<select name="pickUpAP" id="amOrPm">
				<option value="1">AM</option>
				<option value="2">PM</option>
			</select> 
			<p></p>
			<label id="destinationName">Description:</label>
			<input type="text" name="pickUpDesc" id="pickUpDesc">
			<p>
			<label for="pickNumber">Phone Number:</label>
			<input type="text" name="pickNumber" id="pickUpDesc">
			<p>
			<label for="pickUpAddress1">Address:</label>	
			<input type="text" name="pickUpAddress1" id="street1">
			<p>
			<input type="text" name="pickUpAddress2" id="street2">
			<p>
			<label for="pickUpCity" id="cityLabel">City:</label>
			<input type="text" name="pickUpCity" id="city">
			<label for="destZip" id="destZipLabel">Zip-Code:</label>
			<input type="text" name="pickUpZip" id="destZip">

	    </div>
	    
	    <!--Destination Block-->
		<div id="dropOffBlock">
			<p id="appLabels">Destination Information:</p>
			<label for="appointmentTime">Time:</label>	
			<select name="destHour" id="hour">
				<?php
					for ($x=1; $x <= 12; $x++){
						echo "<option value=\"".$x."\">".$x."</option>";
					}
				?>
			</select> 
			<select name="destMin" id="minutes">
				<?php
					$min = 0;
					for ($x=0; $x <= 12; $x++){
						echo "<option value=\"".$min."\">".$min."</option>";
						$min = $min + 5;
					}
				?>
			</select> 
			<select name="destAP" id="amOrPm">
				<option value="1">AM</option>
				<option value="1">PM</option>
			</select> 
			<p>
			<label id="destName">Description:</label>
			<input type="text" name="destName" id="pickUpDesc">
			<p>
			<label for="destNumber">Phone Number:</label>
			<input type="text" name="destNumber" id="pickUpDesc">
			<p>
			<label for="destAddress1">Address:</label>	
			<input type="text" name="destAddress1" id="street1">
			<p>
			<input type="text" name="destAddress2" id="street2">
			<p>
			<label for="destCity" id="cityLabel">City:</label>
			<input type="text" name="destCity" id="city">
			<label for="destZip" id="destZipLabel">Zip-Code:</label>
			<input type="text" name="destZip" id="destZip">
		</div>
	</div>
	
	<p id="Typical">DRIVER/VEHICLE:</p>
	<div id="driverInfo">
		<label for="driverName" id="firstLabel">Driver Name:</label>	
		<input type="text" name="driverName" id="firstField">
		<p>
		<label for="vehicle" id="firstLabel">Vehicle:</label>	
		<select name="vehicle" id="firstField">
			<?php
				foreach ($vehicle as $car)
				{
					echo "<option value=\"".$car['color']."\">".$car['color']."</option>";
				}
			?>
		</select>
	</div>
	
    <p id="Typical">REASON FOR APPOINTMENT:</p>
	<textarea name="notes" rows="10" cols="55">
	</textarea>
  

    <p id="Typical">PLEASE INITAL AND DATE BELOW:</p>
  <textarea name="signature" rows="1" cols="15">
  </textarea>
	<br>
	<br>
	<input name="submit" type="submit" onclick="clicked();" value="Save Reservation">
	<input type="button" value="Cancel" onclick="location.href='calendarDemo.php';">


</form>
</body>

<!-- <footer
	<div id= "expo">
		<footer>hfhgjkv</footer>
	</div>
</footer> -->

</html>

<?php

?>
