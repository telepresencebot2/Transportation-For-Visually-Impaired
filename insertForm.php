<?php

if(isset($_POST['fName'])&&($_POST['fName']!=null)) {
	
	define("HOST", "localhost");
	define("DATABASE", "db1");
	// magical
	define("U_R", "transMAGIC");
	define("P_R", "bFYRFWc2jupQ9xbK");
	$dbMAGIC = new PDO('mysql:host=localhost;dbname=db1', U_R, P_R);

/*
	$time = time();
	$insert = $dbMAGIC=>prepare('INSERT INTO reservations (clientId, location, phone, pickDate, pickTime, pickAddr1, pickAddr2, pickCity, pickZip, destAddr1, destAddr2, destCity, destZip, description, signature, driverId, vehicleId, timestamp) VALUES (:clientId, :location, :phone, :pickDate, :pickTime, :pickAddr1, :pickAddr2, :pickCity, :pickZip, :destAddr1, :destAddr2, :destCity, :destZip, :description, :signature, :driverId, :vehicleId, :timestamp');
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
	
} else if(isset($_POST['appointmentPhone'])&&($_POST['appointmentPhone']!=null)) {
	var_dump($_POST);
} else {

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
/* Generic Label/Text Fields*/
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
#appointmentTimeLabel{
	position: relative;
	top: 10px;
	left: 60px;
}
#appointmentTimeText{
	position: relative;
	top: 10px;
	left: 60px;
	width: 50px;
}


/* Grouping Conventions*/
#intitialInfo {
	position: relative;
	border: 1px solid black;
	height: 100px;
	width: 800px;
	top: 0;
}
#emergencyInfo{
	position: relative;
	border: 1px solid black;
	width: 350px;
	height: 100px;
	/*left: 10px;*/
}
#pickupInfo{
	border: 1px solid black;
	width: 350px;
	height: 130px;
}
#appointmentInfo{
	border: 1px solid black;
	width: 800px;
	height: 200px;
}
#timeLabel{
	position: relative;

}
/* Address Field */
#rightaddressBlock{
	display: inline;
	float: right;
	width: 49%;
	position: relative;
	top: 10px;
}
#leftaddressBlock{
	position: relative;
	top: 10px;
	width: 49%;
	display: inline;
	float: left;
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
	left: 25px;
	width: 100px;
}
#postalCode{
	position: relative;
	left:  92px;
	width: 50px;
}
#postalLabel{
	position: relative;
	left: 80px;
}
/* Driver Section*/
#driverInfo{
	height: 100px;
	border: 1px solid black;
	width: 350px;
}

/* Middle Graphic*/
#leftgraphic{
	position: relative;
	top: 10px;
	width: 49%;
	display: inline;
	float: left;
}
#rightgraphic{
	position: relative;
	top: 50px;
	width: 49%;
	height: 100%;
	display: inline;
	float: right;
	background: url(logo.jpg);
	background-size: contain;
    background-repeat: no-repeat;

}
#middleSection{
	width: 800px;
	height: 350px;
}

/* Headers */
#Typical{
/*	left: 10px; */
	font-size: 16px;
	text-decoration: underline;
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
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
<link rel="stylesheet" type="text/css" href="form.css">
<img src="header2.png">
<h2>Pick Up Registration Form</h2>
</head>

<body>


<form action="insertForm.php" method="post">
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
				<input type="text" name="emergencyname" id="firstField">
				<p>
				<label for="emergencynumber" id="firstLabel">Phone Number:</label>	
				<input type="text" name="emergencynumber" id="firstField">
			</div>
		
		    <p id="Typical">PICKUP INFORMATION:</p>
		    
		    <div id="pickupInfo">
				<label for="pickupName" id="firstLabel">Location Name:</label>	
				<input type="text" name="pickupName" id="firstField">
				<p>
				<label for="pickupNumber" id="firstLabel">Phone Number:</label>	
				<input type="text" name="pickupNumber" id="firstField">
				<p>
				<label for="pickupTime" id="firstLabel">Pickup Time:</label>	
				<input name="pickupTime" id="firstField">
			</div>
		</div>
		<div id="rightgraphic">
		</div>
	</div>
	
	
	
	
	
  	<p id="Typical">APPOINTMENT INFORMATION:</p>
  	
  	<div id="appointmentInfo">
		<label for="day" id="dayLabel">Day:</label>
		<select name="day" id="day" class="day">
			<option value="1">1st</option>
			<option value="2">2nd</option>
			<option value="3">3rd</option>
			<option value="4">4th</option>
			<option value="5">5th</option>
			<option value="6">6th</option>
			<option value="7">7th</option>
			<option value="8">8th</option>
			<option value="9">9th</option>
			<option value="10">10th</option>
			<option value="11">11th</option>
			<option value="12">12th</option>
			<option value="13">13th</option>
			<option value="14">14th</option>
			<option value="15">15th</option>
			<option value="16">16th</option>
			<option value="17">17th</option>
			<option value="18">18th</option>
			<option value="19">19th</option>
			<option value="20">20th</option>
			<option value="21">21st</option>
			<option value="22">22nd</option>
			<option value="23">23rd</option>
			<option value="24">24th</option>
			<option value="25">25th</option>
			<option value="26">26th</option>
			<option value="27">27th</option>
			<option value="28">28th</option>
			<option value="29">29th</option>
			<option value="30">30th</option>
			<option value="31">31st</option>
		</select>
		<label for="month" id="monthLabel">Month:</label>
		<select name="month" id="month" class="month">
			<option value="1">January</option>
			<option value="2">February</option>
			<option value="3">March</option>
			<option value="4">April</option>
			<option value="5">May</option>
			<option value="6">June</option>
			<option value="7">July</option>
			<option value="8">August</option>
			<option value="9">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
		</select>
		<label for="year" id="yearLabel">Year:</label>
		<select name="year" id="year" class="year">
			<option value="2020">2020</option>
			<option value="2019">2019</option>
			<option value="2018">2018</option>
			<option value="2017">2017</option>
			<option value="2016">2016</option>
			<option value="2015">2015</option>
			<option value="2014">2014</option>
			<option value="2013">2013</option>
			<option value="2012">2012</option>
			<option value="2011">2011</option>
		</select>
		<script>
			$("#day").val((new Date()).getDate());
			$("#year").val((new Date()).getYear()+1900);
			$("#month").val((new Date()).getMonth()+1);
		</script>
		<label for="appointmentTime" id="appointmentTimeLabel">Time:</label>	
		<input type="text" name="appointmentTime" id="appointmentTimeText">
		<p>
			
		<!--Address Block-->
		<div id="leftaddressBlock">
			<label id="addressTitle">Patient Information:</label>
			<p>
			<label for="appointmentPhone">Phone:</label>	
			<input type="text" name="appointmentPhone">	
			<p>		    	
		    <label for="newPatient">New Patient:</label>	
		  	<select name="newPatient">
		    	<option value="NULL"></option>
		    	<option value="YES">YES</option>
		    	<option value="NO">NO</option>
		 	 </select>
		 	<p>
		 	<label for="paperAssistance" id=>Paper Work Assistance Needed:</label>	
		  	<select name="paperAssistance">
		    	<option value="NULL"></option>
		    	<option value="YES">YES</option>
		    	<option value="NO">NO</option>
		 	 </select>

	    </div>
	    
	    <!--Location Block-->
		<div id="rightaddressBlock">
			<label id="destinationName">Location:</label>
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
		<input type="text" name="vehicle" id="firstField">
	</div>
	
    <p id="Typical">REASON FOR APPOINTMENT:</p>
	<textarea name="message" rows="10" cols="55">
	</textarea>
  

    <p id="Typical">PLEASE INITAL AND DATE BELOW:</p>
  <textarea name="signature" rows="1" cols="15">
  </textarea>
	<br>
	<br>
	<input type="submit" value="Save Reservation">
	<input type="button" value="Cancel" onclick="location.href='calendarDemo.html';">


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
