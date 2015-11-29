<?php
if (isset ( $_POST ['vehicleType'] )) {
	define ( "HOST", "localhost" );
	define ( "DATABASE", "db1" );
	// magical
	define ( "U_R", "transMAGIC" );
	define ( "P_R", "bFYRFWc2jupQ9xbK" );
	$dbMAGIC = new PDO ( 'mysql:host=localhost;dbname=db1', U_R, P_R );
	$insert = $dbMAGIC->prepare ( 'INSERT INTO vehicle (vehicleType, seats, color) VALUES
		(:vehicleType, :vehicleSeats, :vehicleColor)' );
	$insert->bindParam ( ':vehicleType', $_POST ['vehicleType'] );
	$insert->bindParam ( ':vehicleSeats', $_POST ['vehicleSeats'] );
	$insert->bindParam ( ':vehicleColor', $_POST ['vehicleColor'] );
	$insert->execute ();
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="jscolor-2.0.4/jscolor.js"></script>

<style>
	h2{
		position: relative;
		left: 10px;
		right: 10px;
		font-size: 32px;
		font-family: Zapf Chancery, cursive;	
	}
	img{
		position: absolute;
		top: 0px;
		width: 100%;
		height: 105px;
		z-index: -1;
	}
</style>
</head>
<body>
<style>
	html {
		height: 100%;
	}
	body{
		height: 100%;
		width: 100%;
	}
	.saveButton{
	    height:150px;
	    width: 50%;
	    float: left;
	    background: white;
	    background-size: contain;
	    background-repeat: no-repeat;
	    background-image: url(saveButton.png);
	}
	.cancelButton{
	    height: 150px;
	    width: 50%;
	    float: left;
	    background: white;
	    background-size: contain;
	    background-repeat: no-repeat;
	    background-image: url(cancelButton.png);
	}
	#vehicleInfo {
		position: relative;
		float: left;
		width: 50%;
		height: 100%;
		display: inline;
	}
	#vehicleSave {
		position: relative;
		float: right;
		width: 50%;
		height: 100%;
		display: inline;
	}
	#saveButton{
		width: 100%;
		height: inherit;
	}

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
</style>
</body>

<head>
	<link rel="stylesheet" type="text/css" href="form.css">
	<img src="header2.png">
	<h2>Vehicle Insertion Form</h2>
</head>

<body>
	<form name = "vehicleForm" action="vehicleForm.php" method="post">
		<div id="vehicleInfo">
			<label for="vehicleType" id="firstLabel">Vehicle ID:</label>	
			<input type="text" name="vehicleType"  id="firstField">
			<p></p>
			<label for="vehicleSeats" id="firstLabel">Seats:</label>	
			<input type="text" name="vehicleSeats"  id="firstField">
			<p></p>
			<label for="vehicleColor" id="firstLabel">Vehicle Color:</label>	
			<input name="vehicleColor" class="jscolor jscolor-active" id="firstField"value="ab2567" autocomplete="off" style="color: 
			rgb(255, 255, 255); background-image: none; background-color: rgb(171, 37, 103);">
		</div>
		<div id="vehicleSave">
			<button class="saveButton" onclick="alert('New vehicle added');" type="submit"></button>
			<button class="cancelButton" onclick="location.href='calendarDemo.php';" type="button"></button>
		</div>
	</form>
</body>
</html>
