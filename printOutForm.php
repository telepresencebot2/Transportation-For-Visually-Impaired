<?php


define("HOST", "localhost");
define("DATABASE", "db1");
// magical
define("U_R", "transMAGIC");
define("P_R", "bFYRFWc2jupQ9xbK");
$dbMAGIC = new PDO('mysql:host=localhost;dbname=db1', U_R, P_R);

$haveResult = false;
if(isset($_GET['id'])) {
	$resId = $_GET['id'];
	$reserve = $dbMAGIC->prepare("SELECT * FROM reservations WHERE id = :id LIMIT 1");
	$reserve->bindParam(':id', $resId, PDO::PARAM_INT);
	$reserve->execute();
	$reserve = $reserve->fetchAll();
	if(count($reserve)>0) {
		$reserve = $reserve[0];
		$haveResult = true;
	}
}

?>



<!DOCTYPE html>
<html>
<head>
<style>
h2{
	position: relative;
	left: 150px;
	font-size: 32px;
	font-family: Zapf Chancery;
	height: 35px;
}
</style>
</head>

<body>
<style>
	#textfield{
		display: inline;
		float: right;
		width: 49%;
		height: 50%;
		position: relative;
		top: 10px;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#labels{
		display: inline;
		float: left;
		width: 49%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#newField{
		position: relative;
		width: 100%;
		height: 30px;
		top: 1px;
	}
	#firstBlock{
		position: relative;
		height: 100px;
		width: 100%;
	}
	#printOutForm{
		width: 670px;
	}
	#firstFourLabels{
		display: inline;
		float: left;
		width: 20%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#firstFourText{
		display: inline;
		float: right;
		width: 80%;
		position: relative;
		height: 100%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#emerContactLabels{
		display: inline;
		float: left;
		width: 30%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#emerContactText{
		display: inline;
		float: right;
		width: 70%;
		position: relative;
		height: 100%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#emerContactPhoneLabels{
		display: inline;
		float: left;
		width: 49%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#emerContactPhoneText{
		display: inline;
		float: right;
		width: 50%;
		position: relative;
		height: 100%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#pickUpBlock{
		position: relative;
		height: 50px;
		width: 100%;
	}
	#pickUpLocLabels{
		display: inline;
		float: left;
		width: 30%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#pickUpLocText{
		display: inline;
		float: right;
		width: 70%;
		position: relative;
		height: 100%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>;
	}
	#pickUpNumLabels{
		display: inline;
		float: left;
		width: 45%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#pickUpNumText{
		display: inline;
		float: right;
		width: 55%;
		position: relative;
		height: 100%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>;
	}
	#pickUpTimeLabels{
		display: inline;
		float: left;
		width: 25%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#pickUpTimeText{
		display: inline;
		float: right;
		width: 75%;
		position: relative;
		height: 100%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>;
	}
	#appointmentLabels{
		display: inline;
		float: left;
		width: 30%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#appointmentText{
		display: inline;
		float: right;
		width: 70%;
		position: relative;
		height: 100%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>;
	}
	#appAddressBlock{
		position: relative;
		height: 35px;
		width: 100%;
		margin-bottom: 1px;
	}
	#appAddressLabels{
		display: inline;
		float: left;
		width: 40%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#appAddressText{
		display: inline;
		float: right;
		width: 60%;
		position: relative;
		height: 100%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>;
	}
	#phoneNumLabel{
		display: inline;
		float: left;
		width: 50%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#phoneNumText{
		display: inline;
		float: right;
		width: 50%;
		position: relative;
		height: 100%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>;
	}
	#reasonLabel{
		display: inline;
		float: left;
		width: 40%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#reasonText{
		display: inline;
		float: right;
		width: 60%;
		position: relative;
		height: 100%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>;
	}
	#newPatientLabel{
		float: left;
		width: 40%;
		position: relative;
		font-size: 24px;
		top: 10px;
	}
	#needAssistanceLabel{
		float: left;
		width: 70%;
		position: relative;
		font-size: 24px;
		top: 10px;
	}
	#needAssistanceText{
		float: left;
		width: 30%;
		position: relative;
		font-size: 24px;
		top: 10px;	
		height: 100%;
	}
	#driverBlock{
		position: absolute;
		width: 670px;
		height: 30px;
		top: 738px;
	}
	#driverLabel{
		display: inline;
		float: left;
		width: 12%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#driverText{
		display: inline;
		float: left;
		width: 30%;
		position: relative;
		top: 10px;
		height: 100%;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>;
	}
	#vehicleText{
		display: inline;
		width: 35%;
		float: right;
		position: relative;
		top: 10px;
		height: 100%;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#vehicleLabel{
		display: inline;
		float: right;
		width: 15%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#notesBlock{
		position: absolute;
		width: 670px;
		height: 30px;
		top: 735px;
	}
	#notesLabel{
		display: inline;
		float: left;
		width: 15%;
		position: relative;
		top: 10px;
		font-size: 24px;	
	}
	#notestopText{
		display: inline;
		float: right;
		width: 85%;
		position: relative;
		top: 10px;
		font-size: 24px;
		height: 80%;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 	
	}
	#notesbotText{
		display: inline;
		float: left;
		width: 100%;
		position: relative;
		top: 10px;
		font-size: 24px;
		height: 90%;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#verifyBlock{
		position: absolute;
		width: 670px;
		height: 30px;
		top: 820px;
	}
	#sigLabel{
		display: inline;
		float: left;
		width: 30%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
	#sigText{
		display: inline;
		float: left;
		width: 18%;
		position: relative;
		top: 10px;
		height: 75%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#dateText{
		display: inline;
		width: 35%;
		float: right;
		position: relative;
		top: 10px;
		height: 75%;
		font-size: 24px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#dateLabel{
		display: inline;
		float: right;
		width: 10%;
		position: relative;
		top: 10px;
		font-size: 24px;
	}
</style>	
</body>

<head>
	<h2>Appointment and Travel Info</h2>
</head>

<body>
	<div id="printOutForm">
		<div id = "firstBlock">
			<div id = "newField">
				<div id ="firstFourLabels">Client Name: </div>	
				<div id="firstFourText"><?php if($haveResult){echo($reserve['name']);} ?></div>
			</div>
			
			<div id = "newField">
				<label id ="firstFourLabels">Disability: </label>	
				<label id="firstFourText"><?php if($haveResult){echo($reserve['disability']);} ?></label>
			</div>
			
			<div id = "newField">
				<label id ="firstFourLabels">Waiver: </label>	
				<label id="firstFourText"><?php if($haveResult){echo($reserve['waiver']);} ?></label>
			</div>
			
			<div id = "newField">
				<label id ="firstFourLabels">Tickets: </label>	
				<label id="firstFourText"><?php if($haveResult){echo($reserve['ticket']);} ?></label>
			</div>
		</div>
		
		<div id = "newField">
			<label id ="emerContactLabels">Emergency Contact: </label>	
			<label id="emerContactText"></label>
		</div>

		<div id = "newField">
			<label id ="emerContactPhoneLabels">Emergency Contact's Phone #: </label>	
			<label id="emerContactPhoneText"><?php if($haveResult){echo($reserve['phone']);} ?></label>
		</div>
		<div id = "pickUpBlock">
			<div id="newField">
				<label id ="pickUpLocLabels">Pick-up Location: </label>	
				<label id="pickUpLocText"><?php if($haveResult){echo($reserve['pickAddr1']);} ?></label>
				<div id = "newField">
					<label id="pickUpLocText"><?php if($haveResult){echo $reserve['pickAddr1'].' '.$reserve['pickAddr2'];} ?></label>
				</div>
				<div id = "newField">
					<label id="pickUpLocText"><?php if($haveResult){echo $reserve['pickCity'].", ".$reserve['pickZip'];} ?></label>
				</div>
			</div>
		</div>

		<div id = "newField">
				<label id ="pickUpNumLabels">Phone # at Pick-up Location: </label>	
				<label id="pickUpNumText"></label>
		</div>
		
		<div id = "newField">
			<label id ="pickUpTimeLabels">Pick-up Time: </label>	
			<label id="pickUpTimeText"><?php if($haveResult){echo($reserve['pickTime']);} ?></label>
		</div>
		
		<div id = "newField">
			<label id ="appointmentLabels">Appointment Date: </label>	
			<label id="appointmentText"><?php if($haveResult){echo($reserve['pickDate']);} ?></label>
		</div>
		
		<div id = "newField">
			<label id ="appointmentLabels">Appointment Time: </label>	
			<label id="appointmentText"></label>
		</div>
		
		<div id = "appAddressBlock">
			<label id ="appAddressLabels">Address of Appointment: </label>	
			<label id="appAddressText"><?php if($haveResult){echo($reserve['location']);} ?></label>
			<div id = "newField">
				<label id="appAddressText"><?php if($haveResult){echo $reserve['destAddr1'].' '.$reserve['destAddr2'];} ?></label>
			</div>
			<div id = "newField">
				<label id="appAddressText"><?php if($haveResult){echo $reserve['destCity'].", ".$reserve['destZip'];} ?></label>
			</div>
		</div>

		<div id = "newField">
			<label id ="phoneNumLabel">Phone # at Destination: </label>	
			<label id="phoneNumText"></label>
		</div>
		
		<div id = "newField">
			<label id ="reasonLabel">Reason for Appointment: </label>	
			<label id="reasonText"></label>
		</div>

		<div id = "newField">
			<label id ="newPatientLabel">New Patient: </label>	
		</div>

		<div id = "newField">
			<label id ="needAssistanceLabel">Needs Assistance with Paperwork: </label>	
			<label id="needAssistanceText"><?php if($haveResult){echo($reserve['assistance']);} ?></label>
		</div>

		<div id = "newField">
			<label id ="driverLabel">Driver: </label>	
			<label id="driverText"><?php if($haveResult){echo($reserve['driverName']);} ?></label>
			<label id="vehicleText"><?php if($haveResult){echo($reserve['vehicleColor']);} ?></label>
			<label id ="vehicleLabel">Vehicle: </label>	
		</div>
		
		<div id = "notesBlock">
			<label id ="notesLabel">Notes: </label>	
			<label id="notestopText"><?php if($haveResult){echo($reserve['description']);} ?></label>
			<label id="notesbotText"></label>
			<label id="notesbotText"></label>
		</div>
		
		<div id = "verifyBlock">
			<label id ="sigLabel">(Driver's Initials): </label>	
			<label id="sigText"></label>
			<label id="dateText"></label>
			<label id ="dateLabel">Date: </label>	
		</div>
	</div>
</body>

	
</html>