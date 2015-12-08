<?php
define ( "HOST", "localhost" );
define ( "DATABASE", "db1" );
// magical
define ( "U_R", "transMAGIC" );
define ( "P_R", "bFYRFWc2jupQ9xbK" );
$dbMAGIC = new PDO ( 'mysql:host=localhost;dbname=db1', U_R, P_R );
if (isset ( $_POST ['vehicleType'] )) {
	$dbMAGIC = new PDO ( 'mysql:host=localhost;dbname=db1', U_R, P_R );
	$insert = $dbMAGIC->prepare ( 'INSERT INTO vehicle (vehicleType, seats, color) VALUES
		(:vehicleType, :vehicleSeats, :vehicleColor)' );
	$insert->bindParam ( ':vehicleType', $_POST ['vehicleType'] );
	$insert->bindParam ( ':vehicleSeats', $_POST ['vehicleSeats'] );
	$insert->bindParam ( ':vehicleColor', $_POST ['vehicleColor'] );
	$insert->execute ();
	header('Location: calendarDemo.php');
	
} else if(isset($_POST["remove"])) {
	$dbMAGIC = new PDO('mysql:host=localhost;dbname=db1', U_R, P_R);
	$remove = $dbMAGIC->prepare('DELETE FROM vehicle WHERE color = :color LIMIT 1');
	$remove->bindParam(':color', $_POST ['remove']);
	$remove->execute();
	header('Location: calendarDemo.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<script src="jscolor-2.0.4/jscolor.js"></script>
	<link rel="stylesheet" type="text/css" href="form.css">
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
</head>

<body>
	<img src="header2.png">
	<h2>Vehicle Insertion Form</h2>
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
		<br>
		<div id="vehicleSave">
			<button id="save" name="save" class="saveButton" onclick="alert('New vehicle added');" type="submit"></button>
			<button id="cancel" name="cancel" class="cancelButton" onclick="location.href='calendarDemo.php';" type="button"></button>
		</div>
	</form>
	<form name="vehicleDeletion" action="vehicleForm.php" method="post">
		<br>
		<br>
		<br>
		<br>
		<br>
		<h2>Remove Vehicle:</h2>
		<select id="remove" name="remove"> 
			<?php
			$vehicle = $dbMAGIC->prepare ( "SELECT color, vehicleType FROM vehicle" );
			$vehicle->execute ();
			$vehicle = $vehicle->fetchAll ();
			foreach ( $vehicle as $car ) {
				echo "<option dataName='".$car ['vehicleType']."' value=\"" . $car ['color'] . "\">" . $car ['vehicleType'] . "</option>";
			}
			?>
		</select>
		<button id="Remove" name="Remove" class="del" onclick="alert('vehicle removed');" type="submit">Remove</button>
	</form>
</body>
</html>
