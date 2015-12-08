<?php
define ( "HOST", "localhost" );
define ( "DATABASE", "db1" );
// magical
define ( "U_R", "transMAGIC" );
define ( "P_R", "bFYRFWc2jupQ9xbK" );
$dbMAGIC = new PDO ( 'mysql:host=localhost;dbname=db1', U_R, P_R );
if (isset ( $_POST ['driverName'] )) {
	$insert = $dbMAGIC->prepare ( 'INSERT INTO driver (name) VALUES
		(:driverName)' );
	$insert->bindParam ( ':driverName', $_POST ['driverName'] );
	$insert->execute ();
	header('Location: calendarDemo.php');
} else if(isset($_POST["remove"])) {
	$id = (int)$_POST['remove'];
	$dbMAGIC = new PDO('mysql:host=localhost;dbname=db1', U_R, P_R);
	$remove = $dbMAGIC->prepare('DELETE FROM driver WHERE id = :id LIMIT 1');
	$remove->bindParam(':id', $id, PDO::PARAM_INT);
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
	html {
		height: 100%;
	}
	body{
		height: 100%;
		width: 100%;
	}
	.button{
	    background:white;
	    height:50%;
	    width: 100%;
	    font-size: 50px;
		font-family: Zapf Chancery, cursive;	
	}
	#driverInfo {
		position: relative;
		float: left;
		width: 50%;
		height: 100%;
		display: inline;
	}
	#driverSave {
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
	<img src="header2.png">
	<h2>Driver Insertion Form</h2>

	<form name = "driverForm" action="driverForm.php" method="post">
		<div id="driverInfo">
			<label for="driverName" id="firstLabel">Name:</label>	
			<input type="text" name="driverName"  id="firstField">
		</div>
		<br>
		<div id="driverSave">
			<button id="save" name="save" class="saveButton" onclick="alert('New driver added');" type="submit"></button>
			<button id="cancel" name="cancel" class="cancelButton" onclick="location.href='calendarDemo.php';" type="button"></button>
		</div>
	</form>
	<form name="vehicleDeletion" action="driverForm.php" method="post">
		<br>
		<br>
		<br>
		<br>
		<br>
		<h2>Remove Driver:</h2>
		<select id="remove" name="remove"> 
			<?php
			$vehicleDriver = $dbMAGIC->prepare ( "SELECT id, name FROM driver" );
			$vehicleDriver->execute ();
			$vehicleDriver = $vehicleDriver->fetchAll ();
			foreach ( $vehicleDriver as $guy ) {
				echo "<option dataName=\"".$got['name']."\" value=\"".$guy['id']."\">".$guy['name']."</option>";
			}
			?>
		</select>
		<button id="Remove" name="Remove" class="del" onclick="alert('Driver removed');" type="submit">Remove</button>
	</form>
</body>
</html>
